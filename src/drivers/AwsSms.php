<?php

namespace codexten\yii\sms\aws\drivers;

use codexten\yii\aws\components\Aws;
use codexten\yii\sms\Driver;
use Yii;

class AwsSms extends Driver
{
    public $sender;
    public $applicationId;

    /**
     * {@inheritDoc}
     */
    public function send()
    {
//        $sms = Yii::$app->aws->sns();
//
//       echo "<pre>";
//       var_dump( $sms->publish([
//           'Message' => 'Hello, This is just a test Message',
//           'PhoneNumber' => '+917736609397',
//           'MessageAttributes' => [
//               'AWS.SNS.SMS.SMSType' => [
//                   'DataType' => 'String',
//                   'StringValue' => 'Transactional',
//               ],
//           ],
//       ]));
//       echo "<pre>";
//       exit();

        $addresses = [];
        foreach ($this->recipients as $recipient) {
            $addresses[$recipient] = [
                'ChannelType' => 'SMS',
            ];
        }


        Yii::$app->aws->pinpoint()->sendMessages([
            'ApplicationId' => $this->applicationId, // REQUIRED
            'MessageRequest' => [ // REQUIRED
                'Addresses' => $addresses,
                'MessageConfiguration' => [
                    'SMSMessage' => [
                        'Body' => $this->body,
                        'MessageType' => 'TRANSACTIONAL',
//                        'OriginationNumber' => 'originationNumber',
                        'SenderId' => $this->sender,
                    ],
                ],
            ],
        ]);

    }
}