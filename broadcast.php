<?php

require 'vendor/autoload.php';
require 'config.php';

$basic  = new \Nexmo\Client\Credentials\Basic($config['api_key'], $config['api_secret']);
$keypair = new \Nexmo\Client\Credentials\Keypair(
    file_get_contents(__DIR__ . '/private.key'),
    $config['application_id']
);

$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic, $keypair));

$contacts = $config['contacts'];

foreach ($contacts as $name => $number) {
    $client->calls()->create([
        'to' => [[
            'type' => 'phone',
            'number' => $number
        ]],
        'from' => [
            'type' => 'phone',
            'number' => $config['from_number']
        ],
        'answer_url' => [$config['base_url'] . '/answer.php'],
        'event_url' => [$config['base_url'] . '/event.php'],
        'machine_detection' => 'continue'
    ]);

    // Sleep for half a second
    usleep(500000);
}
