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
            'can'  => 'logado'
        ],
        [
            'text' => 'Processar Sugestão',
            'url'  => '/suggestions',
            'can'  => 'sai',
        ],
        [
            'text' => 'Processar Aquisição',
            'url'  => '/suggestions/lista_aquisicao',
            'can'  => 'sai',
        ],
        [
            'text' => 'Consulta',
            'url'  => '/suggestions/consulta',
        ],
    ]
];
