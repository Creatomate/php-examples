<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
    die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
    'output_format' => 'mp4',
    'width' => 1280,
    'height' => 720,
    'duration' => 5,

    'elements' => [

        new Creatomate\Elements\Composition([

            'width' => [
                ['value' => '100%', 'time' => 1],
                ['value' => '10%', 'time' => 3],
            ],

            'height' => [
                ['value' => '100%', 'time' => 1],
                ['value' => '10%', 'time' => 3],
            ],

            'z_rotation' => [
                ['value' => 0, 'time' => 2],
                ['value' => 45, 'time' => 3],
            ],

            'repeat' => true,

            'elements' => [
                new Creatomate\Elements\Video([
                    'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video4.mp4',
                ]),
            ],

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
