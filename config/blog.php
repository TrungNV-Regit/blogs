<?php

return [

    'constants' => [
        'AVATAR_DEFAULT' => 'https://st3.depositphotos.com/1767687/16607/v/450/depositphotos_166074422-stock-illustration-default-avatar-profile-icon-grey.jpg'
    ],

    'valid_token_duration' => env('VALID_TOKEN_DURATION', 30),

    'storage_path' => env('STORAGE_PATH', 'public/images'),

    'per_page' => env('PER_PAGE', 9),

    'statuses' => [
        1 => 'Active',
        2 => 'Pending',
    ],

    'image_path_prefix' => '/storage/images',

    'related_blog_limit' => 4,

    'per_page_comment' => env('PER_PAGE_COMMENT', 20),
];
