<?php

return [
    // https://developer.xero.com/documentation/oauth2/scopes
    'scope' => 'openid email profile accounting.settings accounting.transactions offline_access',

    'redirect_after_authorization_url' => '/home',
    'redirect_url' => env('XERO_REDIRECT_URL'),
    'client_id' => env('XERO_CLIENT_ID'),
    'client_secret' => env('XERO_CLIENT_SECRET'),
];
