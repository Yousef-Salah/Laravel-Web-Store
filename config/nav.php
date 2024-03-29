<?php

return [
    'dashboard' => [
        'title' => 'Dashboard',
        'icon' => 'far fa-circle nav-icon',
        'route.active' => 'dashboard.index',
        'route' => function () {
            return route('dashboard.index');
        },
    ],
    'categories' => [
        'title' => 'Categories',
        'icon' => 'far fa-circle nav-icon',
        'route.active' => 'dashboard.categories.*',
        'route' => fn() => route('dashboard.categories.index'),
    ],
    'products' => [
        'title' => 'Products',
        'icon' => 'far fa-circle nav-icon',
        'route.active' => 'dashboard.products.*',
        'route' => fn() => route('dashboard.products.index'),
    ],
    'orders' => [
        'title' => 'Orders',
        'icon' => 'far fa-circle nav-icon',
        'route.active' => 'dashboard.orders.*',
        'route' => '/dashboard/orders',
        'badge' => [
            'class' => 'primary',
            'label' => 'New'
        ]
    ],
    'settings' => [
        'title' => 'Settings',
        'icon' => 'far fa-circle nav-icon',
        'route.active' => 'dashboard.settings.*',
        'route' => '/dashboard/settings',
        'badge' => null,
    ]
];