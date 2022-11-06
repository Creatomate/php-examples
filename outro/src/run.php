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

    // By default, the output frame rate is adjusted to the input material. That means if your input video is 30 fps,
    // your output will be 30 fps too. In this case, we're going to enforce 60 fps for a more smooth transition animation
    'frame_rate' => 60,

    'elements' => [

        // Main video
        new Creatomate\Elements\Video([
            'track' => 1,
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
        ]),

        // Outro
        new Creatomate\Elements\Composition([

            // Having the outro composition on the same track as the video makes it play after it
            'track' => 1,

            'duration' => 2.5,
            'elements' => [

                new Creatomate\Elements\Text([
                    'width' => '90%',
                    'height' => '10%',
                    'text' => 'Your outro here',
                    'font_family' => 'Cabin',
                    'font_weight' => '700',
                    'x_alignment' => '50%',
                    'y_alignment' => '50%',
                    'fill_color' => '#fff',
                ]),

                // Place any other element here
            ],

            // Transition between the previous element (the video) and this one
            'transition' => new Creatomate\Animations\CircularWipe([
                'duration' => 0.5,
            ]),
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
