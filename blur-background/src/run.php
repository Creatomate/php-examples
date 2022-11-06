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
    'elements' => [
        new Creatomate\Elements\Video([
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/vertical.mp4',
            'muted' => true,
            'fit' => 'cover',
            'color_overlay' => 'rgba(0,0,0,0.15)',
            'blur_radius' => 57,
            'clip' => true,
        ]),
        new Creatomate\Elements\Video([
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/vertical.mp4',
            'fit' => 'contain',
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
