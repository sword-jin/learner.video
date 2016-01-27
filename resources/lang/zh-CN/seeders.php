<?php

return [
    'roles' => [
        [
            'name' => 'user',
            'display_name' => 'Learner用户',
            'description' => '普通用户'
        ],
        [
            'name' => 'admin',
            'display_name' => 'Learner管理员',
            'description' => '管理Learner日常'
        ],
        [
            'name' => 'boss',
            'display_name' => 'Learner站长',
            'description' => '享有Learner一切权利'
        ],
    ],
    'permissions' => [
        [
            'name' => 'edit_user',
            'display_name' => '编辑用户'
        ],
        [
            'name' => '删除用户',
            'display_name' => '删除用户'
        ],
        [
            'name' => 'ban_user',
            'display_name' => '冻结用户',
        ]
    ]
];
