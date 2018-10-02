<?php

// This is the phone number being called
$to = $_REQUEST['to'];

// This is the caller's phone number
$from = $_REQUEST['from'];

// Nexmo provide a unique ID for all calls
$uuid = $_REQUEST['conversation_uuid'];

// For more advanced Conversations you use the above parameters to
// dynamically create the NCCO and provide a personalised experience

$ncco = [
    [
        "action" => "talk",
        "voiceName" => "Jennifer",
        "text" => "Hello, here is your message. I hope you have a nice day."
    ],
    // We skip the stream action here as we don't provide an MP3 for people
    // to test with
    [
        "action" => "talk",
        "voiceName" => "Jennifer",
        "text" => "To confirm receipt of this message, please press 1 followed by the pound sign"
    ],
    [
        "action" => "input",
        "submitOnHash" => "true",
        "timeout" => 10
    ],
    [
        "action" => "talk",
        "voiceName" => "Jennifer",
        "text" => "Thank you, you may now hang up."
    ]
];

// Nexmo expect you to return JSON with the correct headers
header('Content-Type: application/json');
echo json_encode($ncco);
