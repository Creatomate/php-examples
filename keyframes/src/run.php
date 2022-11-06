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
    'duration' => 4,

    'elements' => [

        new Creatomate\Elements\Shape([

            'width' => '23.5227%',
            'height' => '41.8179%',

            'x_scale' => [
                ['value' => '20%', 'time' => 0],
                ['value' => '100%', 'time' => 2, 'easing' => 'elastic-out'],
            ],

            'y_scale' => [
                ['value' => '20%', 'time' => 0],
                ['value' => '100%', 'time' => 2, 'easing' => 'elastic-out'],
            ],

            'z_rotation' => [
                ['value' => -90, 'time' => 0],
                ['value' => 0, 'time' => 2, 'easing' => 'elastic-out'],
            ],

            'fill_color' => [
                ['value' => '#333333', 'time' => 0],
                ['value' => '#0079ff', 'time' => 0.94],
                ['value' => '#0079ff', 'time' => 2],
                ['value' => 'rgba(0,121,255,0)', 'time' => 2.5],
            ],

            'stroke_color' => 'rgba(0,121,255,1)',

            'stroke_width' => [
                ['value' => '0 vmin', 'time' => 2],
                ['value' => '4.3 vmin', 'time' => 2.5],
                ['value' => '0 vmin', 'time' => 3.5],
            ],

            'stroke_start' => [
                ['value' => '0%', 'time' => 2.5],
                ['value' => '100%', 'time' => 3.5],
            ],

            'stroke_offset' => [
                ['value' => '0%', 'time' => 2.5],
                ['value' => '50%', 'time' => 3.5],
            ],

            'path' => [
                ['value' => 'M 0 0 L 100 0 L 100 100 L 0 100 L 0 0 Z', 'time' => 0.94],
                ['value' => 'M -20 -20 C 15 -55 85 -55 120 -20 C 155 15 155 85 120 120 C 85 155 15 155 -20 120 C -55 85 -55 15 -20 -20 Z', 'time' => 2.5, 'easing' => 'elastic-out'],
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
