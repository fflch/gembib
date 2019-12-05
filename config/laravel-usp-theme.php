<?php

return [
    'title'=> 'GEMBIB',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text' => 'Fazer Sugestão',
            'url'  => '/sugestao',
            'can'  => 'logado'
        ],
        [
            'text' => 'Inserção direta',
            'url'  => '/item',
            'can'  => 'sai',
        ],
        [
            'text' => 'Processar',
            'url'  => '/processar',
            'can'  => 'sai',
        ],
    ]
];
