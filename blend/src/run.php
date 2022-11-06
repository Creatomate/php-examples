<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
    die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
    'output_format' => 'mp4',
    'duration' => 3,

    'elements' => [

        new Creatomate\Elements\Video([
            'x' => '40%',
            'y' => '40%',
            'width' => '50%',
            'height' => '50%',
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
        ]),

        new Creatomate\Elements\Video([
            'x' => '60%',
            'y' => '60%',
            'width' => '50%',
            'height' => '50%',
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video2.mp4',

            // Choose between 'multiply', 'screen', 'overlay', 'darken', 'lighten', 'color-dodge', 'color-burn', 'hard-light',
            // 'soft-light', 'lighter', 'difference', 'exclusion', 'hue', 'saturation', 'color', 'luminosity';
            'blend_mode' => 'difference',
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
