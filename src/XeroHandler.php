<?php

namespace AylesSoftware\XeroLaravel;

class XeroHandler
{
    public function __call($name, $arguments)
    {
        $credentials = app(XeroOAuth::class)->credentials;

        $xero = new Xero($credentials->token, $credentials->tenant_id);

        return $xero->{$name}(...$arguments);
    }
}
