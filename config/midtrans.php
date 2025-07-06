<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-client-vFQ0WUBv8RYLf0T2'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-server-RItptIFdLyfVFBQ7rNm_F4Rd'),
    'is_production' => false,
    'is_sanitized' => true,
    'is_3ds' => true,
];
