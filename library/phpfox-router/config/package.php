<?php

namespace Phpfox\Router {
    return [
        'psr4'  => [
            'Phpfox\\Router\\' => [
                'library/phpfox-router/src',
                'library/phpfox-router/test',
            ],
        ],
        'router.groups'  => [
            '@admincp' => [
                'route'    => '{admincp}',
                'defaults' => [],
            ],
            '@rest'    => [
                'route'    => '{rest}',
                'defaults' => [],
            ],
            '@ajax'    => [
                'route' => '{ajax}',
            ],
            '@'        => [
                'route' => '',
            ],
        ],
        'router.filters' => [
            '@profile' => [null, ProfileNameFilter::class],
        ],
        'router.phrases' => [],
        'router.routes'  => [],
        'service.map'    => [
            'router'         => [null, Router::class,],
            'router.filters' => [null, FilterContainer::class],
        ],
    ];
}
