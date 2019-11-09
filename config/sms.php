<?php

use codexten\yii\sms\aws\drivers\AwsSms;

return [
    'components' => [
        'sms' => [
            'drivers' => [
                'awsSms' => [
                    'class' => AwsSms::class,
                    'sender' => $params['aws.sms.sender'],
                    'applicationId' => $params['aws.sms.applicationId'],
                ],
            ],
        ],
    ],
];