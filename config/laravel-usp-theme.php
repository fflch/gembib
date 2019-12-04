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
            'url'  => '/itens/create',
            'can'  => 'logado'
        ],
        [
            'text' => 'Processar Sugestão',
            'url'  => '/itens',
            'can'  => 'sai',
        ],
        [
            'text' => 'Processar Tombamento',
            'url'  => '/itens/lista_aquisicao',
            'can'  => 'sai',
        ],
        [
            'text' => 'Consulta',
            'url'  => '/itens/consulta',
        ],
        [
            'text' => 'Inserção direta',
            'url'  => '/itens/insercao',
            'can'  => 'sai',
        ],
    ]
];
