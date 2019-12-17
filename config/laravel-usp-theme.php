<?php

return [
    'title'=> 'GEMBIB',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text' => 'Sugestão',
            'url'  => '/sugestao',
            'can'  => 'logado'
        ],
        [
            'text' => 'Tombamento',
            'url'  => '/item',
            'can'  => 'sai',
        ],
        [
            'text' => 'Análise',
            'url'  => '/processar',
            'can'  => 'sai',
        ],
    ]
];
