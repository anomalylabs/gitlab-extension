<?php

return [
    'token' => [
        'required' => true,
        'env'      => 'GITLAB_TOKEN',
        'type'     => 'anomaly.field_type.encrypted',
        'bind'     => 'anomaly.extension.gitlab::gitlab.token',
    ],
    'url'   => [
        'required' => true,
        'env'      => 'GITLAB_URL',
        'type'     => 'anomaly.field_type.url',
        'bind'     => 'anomaly.extension.gitlab::gitlab.url',
        'config'   => [
            'default_value' => 'https://gitlab.com',
        ],
    ],
];
