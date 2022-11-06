<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
    die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
    'output_format' => 'mp4',

    'elements' => [

        new Creatomate\Elements\Video([
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video4.mp4',
        ]),

        new Creatomate\Elements\Audio([
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/music1.mp3',
            // Make the audio track as long as the output
            'duration' => null,
            // Fade out for 2 seconds
            'audio_fade_out' => 2,
        ]),
    ],
]);

echo 'Please wait while your video is being rendered...' . PHP_EOL;

try {
    $renders = $client->render(['source' => $source]);

    echo 'Completed: ' . json_encode($renders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (Exception $ex) {
    echo 'Error: ' . $ex->getMessage();
}
