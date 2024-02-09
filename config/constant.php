<?php


use Illuminate\Support\Facades\URL;

return [
    'routes' => [
        'STORAGE_HOME' => 'public/home/',
        'STORAGE_SLIDER' => 'public/slider/',
        'HOME_PAGE' => 'admin.settings.pages.home-page',
        'DASHBOARD' => 'admin.dashboard',
        'HOME_FRONTED' => 'frontend.Home',
        'IMG_COLLECTIONS' => '/images/collections/',
        'PUBLIC_IMAGES' => '/images/',
        'GET_STORAGE_HOME' => '/storage/home/',
        'STORAGE_FOLDER_HOME' => '/storage/home/',
    ],
    'images_name' => [
        'home' =>[
            'section_one' => [
                'IMAGE_LEFT' => 'image_left',
                'IMAGE_TOP_LEFT' => 'image_top_left',
                'IMAGE_TOP_RIGHT' => 'image_top_right',
                'IMAGE_BOTTOM' => 'image_bottom'
            ],
            'section_two'=>[
                'IMAGE_RIGHT' => 'image_right'
            ]
        ]
    ],
];
