<?php

namespace Sessoes;

return [
    'router' => [
        'routes' => [

            'sessoes' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route' => '/painel/sessoes[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\SessoesController::class,
                        'action' => 'index',
                    ],
                ],
            ],

        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'sessoes' => __DIR__ . '/../view',
        ],
    ],
    'db' => [
        'driver' => 'Pdo_Mysql',
        'hostname' => 'localhost',
        'port' => '3307',
        'database' => 'painel',
        'username' => 'root',
        'password' => '@Mcd345715',
    ],
];