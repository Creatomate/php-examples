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

            'elements' => [
                new Creatomate\Elements\Image([
                    'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image1.jpg',
                ]),
                new Creatomate\Elements\Text([
                    'width' => '100%',
                    'height' => '10%',
                    'text' => 'Place elements in the same composition to group them',
                    'background_color' => '#fff',
                    'background_border_radius' => '20%',
                    'background_align_threshold' => '0%',
                    'x_alignment' => '50%',
                ]),
            ],

            'width' => [
                ['value' => '100%', 'time' => 1],
                ['value' => '50%', 'time' => 3],
            ],

            'height' => [
                ['value' => '100%', 'time' => 3],
                ['value' => '50%', 'time' => 4],
            ],

            'y_rotation' => [
                ['value' => 0, 'time' => 4],
                ['value' => 360, 'time' => 5],
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
