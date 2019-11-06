<?php

return [
    'title'=> 'GEMBIB',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'menu' => [
        [
            'text' => 'Fazer Sugestão',
            'url'  => '/suggestions/create',
        ],
        [
            'text' => 'Processar Sugestão',
            'url'  => '/suggestions/processar_sugestao',
            'can'  => '',
        ],
        [
            'text' => 'Processar Aquisição',
            'url'  => '/item3',
            'can'  => '',
        ],
    ]
];
