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
            'user' => 'c,r,u,d',
            'payment' => 'c,r,u,d',
            'profile' => 'r,u',
            'settnig' => 'c,r,u,d',
            'role' => 'c,r,u,d',
        ],
        'Admin' => [
            'user' => 'c,r,u,d',
            'profile' => 'r,u',
            'role' => 'c,r',
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
