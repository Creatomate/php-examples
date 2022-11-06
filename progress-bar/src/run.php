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

        new Creatomate\Elements\Rectangle([
            'x' => '0%',
            'y' => '0%',
            'width' => '100%',
            'height' => '3%',
            'x_anchor' => '0%',
            'y_anchor' => '0%',
            'fill_color' => 'rgba(224,241,59,0.88)',
            'animations' => [
                new Creatomate\Animations\Wipe([
                    'x_anchor' => '0%',
                    'fade' => false,
                    'easing' => 'linear',
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
