<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'SuperAdmin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            'settnigs' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
        ],
        'Admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'roles' => 'c,r',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
       
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
