<?php

$right_menu = [
    [
        'key' => 'senhaunica-socialite',
    ],
    [
        'text'   => '<i class="fas fa-cog"></i>',
        'title'  => 'logs',
        'target' => '_blank',
        'url'    => config('app.url') . '/logs',
        'align'  => 'right',
        'can'    => 'admin',
    ],
];

$sai = [
    [
        'text' => 'Pesquisa',
        'url'  => '/sai',
        'can'  => 'sai',
    ],
    [
        'text' => 'Cadastrar novo tombamento',
        'url'  => '/item/create',
        'can'  => 'sai',
    ],
    [
        'text' => 'Relatório SAI',
        'url'  => '/relatorios',
        'can'  => 'sai',
    ],
];

$stl = [
    [
        'text' => 'Pesquisa',
        'url'  => '/stl',
        'can'  => 'stl',
    ],
    [
        'text' => 'Relatório STL',
        'url'  => '/controle',
        'can'  => 'stl',
    ],
];

$sugestao = [
    [
        'text' => 'Pesquisa',
        'url'  => '/sugestao/pesquisa',
        'can'  => 'logado',
    ],
    [
        'text' => 'Criar Sugestão',
        'url'  => '/sugestao',
        'can'  => 'logado',
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
            'submenu'  => $sugestao,
            'can'  => 'logado'
        ],

        [
            'text' => 'Aquisição',
            'submenu'  => $sai,
            'can'  => 'sai'
        ],

        [
            'text' => 'Processamento Técnico',
            'submenu'  => $stl,
            'can'  => 'stl'
        ],

        [
            'text' => 'Etiquetas',
            'url'  => '/etiquetas',
            'can'  => 'sai',
        ],
        [
            'text' => 'Items em Prioridade',
            'url' => '/prioridades',
            'can' => 'ambos',
        ],
    ]
];
