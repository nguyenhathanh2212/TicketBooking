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
            'super_admin' => 0,
            'admin' => 1,
            'user' => 2,
        ],
        'role_company' => [
            'super_manager' => 0,
            'manager' => 1,
        ],
    ],
    'number_hours_preset' => 3,
    'number_of_records_pagination' => [
        '10' => 10,
        '25' => 25,
        '50' => 50,
    ],
];
