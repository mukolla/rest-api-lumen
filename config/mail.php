<?php

return [
    'default' => env('MAIL_MAILER', 'smtp'),
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => 'mailhog',
            'port' => 1025,
            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'admin@restfullapi.com'),
                'name' => env('MAIL_FROM_NAME', 'Lumen RESTFull API'),
            ],
        ],
    ],
];
