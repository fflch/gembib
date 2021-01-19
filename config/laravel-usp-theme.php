<?php

return [
    'title' => config('app.name'),
    'app_url' => config('app.url'),
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
