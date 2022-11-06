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
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
        ]),

        new Creatomate\Elements\Text([
            'text' => 'This is a text with transparency.',

            // Opacity ranging from 0% (opaque) to 100% (fully transparent)
            'opacity' => '50%',
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
