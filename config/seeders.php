<?php

return [
    'roles' => [
        [
            'name' => 'user',
            'display_name' => 'Learner User',
            'description' => 'general user'
        ],
        [
            'name' => 'admin',
            'display_name' => 'Learner Admin',
            'description' => 'manage administration privileges'
        ],
        [
            'name' => 'boss',
            'display_name' => 'Learner Boos',
            'description' => 'the creater of site'
        ],
    ],
    'permissions' => [
        [
            'name' => 'create_user',
            'display_name' => 'Create New User',
            'description' => 'create a new user for learner on the backend'
        ],
        [
            'name' => 'edit_user',
            'display_name' => 'Edit User',
            'description' => 'edit user\'s some infomation'
        ],
        [
            'name' => 'delete_user',
            'display_name' => 'Delete User',
            'description' => 'delete user from learner'
        ],
        [
            'name' => 'ban_user',
            'display_name' => 'Ban User',
            'description' => 'ban user to login'
        ]
    ]
];
