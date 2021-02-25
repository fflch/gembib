<?php

return [
    'title' => '',
    'app_url' => config('app.url'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'logout_method' => 'POST',
    'logout_url' => config('app.url') . '/logout',
    'login_url' => config('app.url') . '/login',
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
            'text' => 'Relatórios',
            'url'  => '/relatorios',
            'can'  => 'sai',
        ],
        [
            'text' => 'Etiquetas',
            'url'  => '/etiquetas',
            'can'  => 'sai',
        ],
    ]
];
