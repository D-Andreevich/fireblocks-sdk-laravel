<?php

return [
    //*** GENERAL SETTINGS ***

    //path of your private key (in PEM format)
    'private_key_path' => env('FIREBLOCKS_PRIVATE_KEY_PATH', null),

    //Your api key. This is a uuid you received from Fireblocks
    'api_key' => env('FIREBLOCKS_API_KEY', ''),

    //The fireblocks server URL. Leave empty to use the public functionault server
    'api_base_url' => env('FIREBLOCKS_API_BASE_URL', 'https://api.fireblocks.io'),

    //Timeout for http requests in seconds
    'timeout' => env('FIREBLOCKS_TIMEOUT', 10),


    //*** WEBHOOK SETTINGS ***

    //Public key for verifying the signature, file link https://docs.fireblocks.com/api/docs/webhook_sig.pub
    'public_api_key_path' => env('FIREBLOCKS_API_PUBLIC_KEY_PATH', null),

    //Secret Key for notifications webhook
    'x_webhook_secret' => env('FIREBLOCKS_X_WEBHOOK_SECRET', 'secret'),
];
