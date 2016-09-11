<?php

return [
    'multi' => [
        'user' => [
            'driver' => 'eloquent',
            'model'  => 'App\User',
            'table'  => 'users'
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model'  => 'App\Models\Admin',
            'table'  => 'tbladmin'
        ],
        'dokter' => [
            'driver' => 'eloquent',
            'model'  => 'App\Models\Dokter',
            'table'  => 'tbldokter'
        ],
    ],
];
