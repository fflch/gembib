<?php

return [
    'title'=> 'GEMBIB',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'menu' => [
        [
            'text' => 'Fazer sugestões',
            'url'  => '/item1',
        ],
        [
            'text' => 'Consultar',
            'url'  => '/item2',
            'can'  => '',
        ],
        [
            'text' => 'Aquisição',
            'url'  => '/item3',
            'can'  => 'admin',
        ],
        [
            'text' => 'Processamento técnico',
            'url'  => '/item3',
            'can'  => 'admin',
        ],
    ]
];
