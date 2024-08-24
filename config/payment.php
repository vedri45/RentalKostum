<?php

return [
    'midtrans' => [
        'server_key' => env('MIDTRANS_SERVER_KEY'),
        'client_key' => env('MIDTRANS_CLIENT_KEY'),
        'is_production' => false, // Set to true for live environment
        'is_sanitized' => true,
        'is_3ds' => true,
    ],
];