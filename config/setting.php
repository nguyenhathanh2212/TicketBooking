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
            'super_manager' => 2,
            'manager' => 3,
            'user' => 4,
        ],
    ],
    'number_hours_preset' => 3,
];
