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
    'width' => 1280,
    'height' => 720,

    'elements' => [

        // Image 1
        new Creatomate\Elements\Image([
            'track' => 1,
            'duration' => 5,
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image1.jpg',
            'animations' => [
                new Creatomate\Animations\PanCenter([
                    'start_scale' => '100%',
                    'end_scale' => '120%',
                    'easing' => 'linear',
                ]),
            ],
        ]),

        // Image 2
        new Creatomate\Elements\Image([
            'track' => 1,
            'duration' => 5,
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image2.jpg',
            'animations' => [
                new Creatomate\Animations\PanLeftWithZoom([
                    'start_scale' => '100%',
                    'end_scale' => '120%',
                    'easing' => 'linear',
                ]),
            ],
            'transition' => new Creatomate\Animations\Fade(),
        ]),

        // Image 3
        new Creatomate\Elements\Image([
            'track' => 1,
            'duration' => 5,
            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image3.jpg',
            'animations' => [
                new Creatomate\Animations\PanRightWithZoom([
                    'start_scale' => '100%',
                    'end_scale' => '120%',
                    'easing' => 'linear',
                ]),
            ],
            'transition' => new Creatomate\Animations\Fade(),
        ]),

        // Background music
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
