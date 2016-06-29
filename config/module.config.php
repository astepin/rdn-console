<?php

return [
    'console' => [
        'router' => [
            'routes' => [
                'rdn-console' => [
                    'type' => 'catchall',
                    'options' => [
                        'defaults' => [
							'controller' => 'RdnConsole:Index',
							'action' => 'index',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
			'RdnConsole:Index' => 'RdnConsole\Factory\Controller\Index',
        ],
    ],

    'rdn_console' => [
        'application' => [
			'name' => 'RdnConsole',
			'version' => '1.2.0',
        ],

        'commands' => [
			//'RdnConsole:CacheClear',
        ],

        'config' => [
            'cache_clear' => [
				'directory' => 'data/cache',
            ],
        ],
    ],

    'rdn_console_commands' => [
        'factories' => [
			'RdnConsole:CacheClear' => 'RdnConsole\Factory\Command\CacheClear',
        ],
    ],

    'service_manager' => [
        'factories' => [
			'RdnConsole\Application' => 'RdnConsole\Factory\Application',
			'RdnConsole\Command\CommandManager' => 'RdnConsole\Factory\Command\CommandManager',
        ],
    ],
];
