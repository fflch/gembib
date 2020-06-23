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
    'transitions' => [
        'enviar_para_licitacao' => [
            'metadata' => [
                'label' => "Enviar para licitação"
            ],
            'from' => 'Sugestão',
            'to' => 'Em Licitação'
        ],

    ],
];

return [
    'workflow_itens' => $workflow_itens
];
