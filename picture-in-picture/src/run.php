<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
    die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
    'output_format' => 'mp4',
    'frame_rate' => 30,
    'duration' => 8,
    'elements' => [

        new Creatomate\Elements\Video([
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video5.mp4',
            'color_overlay' => 'rgba(0,0,0,0.3)',
        ]),

        new Creatomate\Elements\Video([
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/vertical.mp4',
            'x_anchor' => '0%',
            'y_anchor' => '0%',
            'width' => '40%',
            'height' => '40%',
            'x' => [
                ['value' => '5%', 'time' => 0],
                ['value' => '55%', 'time' => 2, 'easing' => 'steps(1)'],
                ['value' => '5%', 'time' => 4, 'easing' => 'steps(1)'],
                ['value' => '55%', 'time' => 6, 'easing' => 'steps(1)'],
            ],
            'y' => [
                ['value' => '5%', 'time' => 0],
                ['value' => '5%', 'time' => 2, 'easing' => 'steps(1)'],
                ['value' => '55%', 'time' => 4, 'easing' => 'steps(1)'],
                ['value' => '55%', 'time' => 6, 'easing' => 'steps(1)'],
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
