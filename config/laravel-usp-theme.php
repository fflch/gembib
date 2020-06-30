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
            'text' => 'Estatística',
            'url'  => '/estatisticas',
            'can'  => 'sai',
        ],
    ]
];
