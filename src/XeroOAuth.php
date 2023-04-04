<?php

namespace AylesSoftware\XeroLaravel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AylesSoftware\XeroLaravel\Entities\XeroAccess;
use Calcinai\OAuth2\Client\Provider\Xero as XeroOAuthClient;

class XeroOAuth
{
    public $request;

    public $token;

    public $tenants;

    public $credentials;

    protected $provider;

    public function __construct(Request $request, bool $autoRefresh = true)
    {
        $this->request = $request;
        $this->credentials = XeroAccess::latest();

        $this->provider = new XeroOAuthClient([
            'clientId' => config('xero-laravel.client_id'),
            'clientSecret' => config('xero-laravel.client_secret'),
            'redirectUri' => config('xero-laravel.redirect_url'),
        ]);
        
        if ($autoRefresh) {
            $this->refresh();    
        }
    }

    public function flow()
    {
        if ($this->request->has('code')) {
            $this->generate('authorization_code', ['code' => $this->request->input('code')]);

            return redirect(config('xero-laravel.redirect_after_authorization_url'));
        }

        return redirect(
            $this->provider->getAuthorizationUrl([
                'scope' => [config('xero-laravel.scope')],
            ])
        );
    }

    public function refresh()
    {
        if ($this->credentials && $this->credentials->has_expired) {
            $this->generate('refresh_token', ['refresh_token' => $this->credentials->refresh_token]);
        }
    }

    protected function generate($type, $data)
    {
        $this->token = $this->provider->getAccessToken($type, $data);

        $this->tenants = $this->provider->getTenants($this->token);

        $this->saveCredentials();
    }

    protected function saveCredentials()
    {
        DB::transaction(function () {
            XeroAccess::setAllObsolete();

            $this->credentials = XeroAccess::create([
                'refresh_token' => $this->token->getRefreshToken(),
                'token' => $this->token->getToken(),
                'tenant_id' => collect($this->tenants)->pluck('tenantId')->first(),
                'expires_at' => now()->addMinutes(29),
            ]);
        });
    }
}
