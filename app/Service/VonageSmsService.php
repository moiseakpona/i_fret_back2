<?php

namespace App\Service;

use Vonage\Client;
use Vonage\SMS\Message\SMS;

class VonageSmsService{

    protected $client;
    

    public function __construct()
    {
        $basic  = new \Vonage\Client\Credentials\Basic("bbf2fc27", "t1IyLxXkqpybv9TX");
        $this->client = new Client($basic);
    }
    public function sendSms($to, $message) {

        $response = $this->client->sms()->send(
            new SMS($to, env('BRAND_NAME'), $message)
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

    }
}

