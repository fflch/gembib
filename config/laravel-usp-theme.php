<?php

$right_menu = [
    [
        'text'   => '<i class="fas fa-cog"></i>',
        'title'  => 'logs',
        'target' => '_blank',
        'url'    => config('app.url') . '/logs',
        'align'  => 'right',
        'can'    => 'admin',
    ],
];


return [
    'title' => '',
    'app_url' => config('app.url'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'logout_method' => 'POST',
    'logout_url' => config('app.url') . '/logout',
    'login_url' => config('app.url') . '/login',
    'right_menu' => $right_menu,
    'menu' => [
        [
            'text' => 'Sugestão',
            'url'  => '/sugestao',
            'can'  => 'logado'
        ],
        [
            'text' => 'Cadastrar novo tombamento',
            'url'  => '/item/create',
            'can'  => 'sai',
        ],
        [
            'text' => 'Busca',
            'url'  => '/item',
            'can'  => 'sai',
        ],
        [
            'text' => 'Relatório SAI',
            'url'  => '/relatorios',
            'can'  => 'sai',
        ],
        [
            'text' => 'Relatório STL',
            'url'  => '/controle',
            'can'  => 'sai',
        ],
        [
            'text' => 'Etiquetas',
            'url'  => '/etiquetas',
            'can'  => 'sai',
        ],
        [
            'text' => 'Pedir',
            'url'  => '/pedido/create',
            'can'  => 'logado',
        ],
    ]
];
