<?php

return [
    'filter' => [
        'size' => 10,
        'sort_type' => 'desc',
        'sort_field' => 'created_at',
    ],
    'image_company_default' => '/images/image_company_default.jpg',
    'image_station_default' => '/images/image_station_default.jpg',
    'avatar_default' => '/images/avatar_default.png',
    'user' => [
        'role' => [
            'all' => 0,
            'super_admin' => 1,
            'admin' => 2,
            'user' => 3,
        ],
        'role_company' => [
            'super_manager' => 1,
            'manager' => 2,
        ],
    ],
    'number_hours_preset' => 3,
    'ticket' => [
        'status' => [
            'all' => 0,
            'active' => 1,
            'finish' => 2,
            'cancel' => 3,
        ],
        'payment_method' => [
            'direct' => 1,
        ],
    ],
    'reservation' => [
        'disallow' => 0,
        'allow' => 1,
    ],
    'direct_payment' => [
        'disallow' => 0,
        'allow' => 1,
    ],
    'number_of_records_pagination' => [
        '10' => 10,
        '25' => 25,
        '50' => 50,
    ],
    'status' => [
        'all' => 0,
        'active' => 1,
        'block' => 2,
    ]
];
