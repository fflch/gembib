<?php

$workflow_itens = [
    'type' => 'workflow',
    'marking_store' => [
        'type'     => 'single_state',
        'property' => 'status'
    ],
    'supports' => [\App\Item::class],
    'initial_places' => 'Sugestão',
    'places' => App\Item::status,
    $negar = ['Sugestão', 'Em Cotação'],
    'transitions' => [
        'enviar_para_negar' => [
            'metadata' => [
                'label' => "Negar"
            ],
            'from' => $negar,
            'to' => 'Negado'
        ],
        'enviar_para_cotacao' => [
            'metadata' => [
                'label' => "Enviar para cotação"
            ],
            'from' => 'Sugestão',
            'to' => 'Em Cotação'
        ],
        'enviar_para_licitacao' => [
            'metadata' => [
                'label' => "Enviar para licitação"
            ],
            'from' => 'Em Cotação',
            'to' => 'Em Licitação'
        ],
        'enviar_para_tombamento' => [
            'metadata' => [
                'label' => "Enviar para Tombamento"
            ],
            'from' => 'Em Licitação',
            'to' => 'Em Tombamento'
        ],
        'tombar' => [
            'metadata' => [
                'label' => "Tombar"
            ],
            'from' => 'Em Tombamento',
            'to' => 'Tombado'
        ],
        'enviar_para_processamento_tecnico' => [
            'metadata' => [
                'label' => "Enviar para Processamento Técnico"
            ],
            'from' => 'Tombado',
            'to' => 'Em Processamento Técnico'
        ],
        'processar' => [
            'metadata' => [
                'label' => "Processar"
            ],
            'from' => 'Em Processamento Técnico',
            'to' => 'Processado'
        ],      

    ],
];

return [
    'workflow_itens' => $workflow_itens
];
