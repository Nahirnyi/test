<?php

return [
    'migrations' => [
        'container' => [
            'loading' => 1,
            'departure' => 2,
            'delivered' =>3
        ],
        'ship' => [
            'standing' => 1,
            'departure' => 2,
            'arrived' => 3
        ]
    ],
    'messages' => [
        'message' => 'message',
        'error' => 'error'
    ],
    'controllers' => [
        'gpx' => [
            'statuses' => [
                'created' => 'Successfully created gpx!',
                'deleted' => 'Successfully deleted gpx!',
                'parse' => 'Successfully parse gpx!'
            ]
        ],
        'container' => [
            'statuses' => [
                'created' => 'Successfully created container!',
                'updated' => 'Successfully updated container!',
                'deleted' => 'Successfully deleted container!'
            ]
        ],
        'route' => [
            'statuses' => [
                'created' => 'Successfully created route!',
                'deleted' => 'Successfully deleted route!',
                'end' => 'Successfully updated route!'
            ]
        ],
        'track' => [
            'statuses' => [
                'created' => 'Successfully created track!'
            ]
        ],
        'ship' => [
            'statuses' => [
                'created' => 'Successfully created ship!',
                'updated' => 'Successfully updated ship!',
                'deleted' => 'Successfully deleted ship!'
            ]
        ],
        'company' => [
            'statuses' => [
                'created' => 'Successfully created company!',
                'updated' => 'Successfully updated company!',
                'deleted' => 'Successfully deleted company!'
            ]
        ],
        'user' => [
            'statuses' => [
                'created' => 'Successfully created user!'
            ],
            'errors' => [
                'invalidCredentials' => 'Invalid Credentials',
                'couldNotCreateToken' => 'Could not create token'
            ]
        ]

    ]
];
