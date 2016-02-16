<?php

namespace Learner\Services\Layouts;

class Navigation
{
    public $menus = [
        [
            'display_name' => '系列',
            'route' => 'series'
        ],
        [
            'display_name' => '视频',
            'route' => 'videos'
        ],
        [
            'display_name' => '博客',
            'route' => 'blogs'
        ],
        [
            'display_name' => 'Newletter',
            'route' => 'newsletters'
        ]
    ];
}
