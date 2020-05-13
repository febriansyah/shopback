<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Constant Variables
    |--------------------------------------------------------------------------
    |
    | This value is the global variables to your app, 
    | so you can retrieve common value without over and over.
    |
    */

    'default' => [
        'sort_order'       => 'desc',
        'img_quality'      => 100,
        'img_thumb_width'  => 400,
        'img_thumb_height' => 400,
        'timeout' => 3600,
    ],
    'enums' => [
        'page_menu_types' => [
            'static_page',
            'module',
            'external_link',
        ],
        'gallery_types' => [
            'video',
            'gif',
            'ootd',
        ],
        'slideshow_types' => [
            'video',
            'image',
        ],
        'slideshow_layouts' => [
            'default',
            'landscape',
        ],
        'main_type' => [
            'mondial',
            'miss_mondial',
        ],
    ],
    'location' => [
        'upload'        => 'uploads',
        'backend_path'  => 'dashboard',
        'backend_url'   => 'xms',
        'frontend_path' => 'frontend',
    ],
    'backend' => [
        'guard' => 'backend',
        'limit_data' => 25,
        'allowed_url' => [
            'login',
            'logout',
            'home',
            'dashboard',
            'profile',
            'me',
        ],
    ],
    'frontend' => [
        'guard' => 'web',
        'limit_data' => 12,
    ],
    'images'=>[
        'thumb' => [
            'width' => 29,
            'height' => 29,
        ],
        'small' => [
            'width' => 200,
            'height' => 200,
        ],
        'medium' => [
            'width' => 450,
            'height' => 450,
        ],
        'big' => [
            'width' => 1000,
            'height' => 1000,
        ],
		'bigSlider' => [
            'width' => 700,
            'height' => 700,
        ],
		 'icon' => [
            'width' => 30,
            'height' => 30,  
        ]
    ]
];
