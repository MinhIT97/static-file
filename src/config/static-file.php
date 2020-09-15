<?php

return [

    'namespace'       => env('FILE_COMPONENT_NAMESPACE', ''),
    'auth_middleware' => [
        'admin'    => [
            'middleware' => '',
            'except'     => [],
        ],
        'frontend' => [
            'middleware' => '',
            'except'     => [],
        ],
    ],

];
