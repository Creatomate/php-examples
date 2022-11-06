<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
    die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$filters = [
    ['color_filter' => null, 'color_filter_value' => '0%'],
    ['color_filter' => 'brighten', 'color_filter_value' => '20%'],
    ['color_filter' => 'contrast', 'color_filter_value' => '50%'],
    ['color_filter' => 'invert', 'color_filter_value' => '100%'],
    ['color_filter' => 'grayscale', 'color_filter_value' => '100%'],
    ['color_filter' => 'sepia', 'color_filter_value' => '100%'],
];

$videoElements = [];
for ($i = 0; $i < count($filters); $i++) {
    $videoElements[] = new Creatomate\Elements\Video([
        'track' => 1,
        'time' => $i * 3,
        'duration' => 3,
        'trim_start' => $i * 3,
        'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video5.mp4',
        'color_filter' => $filters[$i]['color_filter'],
        'color_filter_value' => $filters[$i]['color_filter_value'],
    ]);
}

$textElements = [];
for ($i = 0; $i < count($filters); $i++) {
    $videoElements[] = new Creatomate\Elements\Text([
        'track' => 2,
        'time' => $i * 3,
        'duration' => 3,
        'x' => '50%',
        'y' => '95%',
        'y_anchor' => '100%',
        'x_alignment' => '50%',
        'text' => $filters[$i]['color_filter'] ? $filters[$i]['color_filter'] : 'original',
        'font_size' => 25,
        'fill_color' => '#000',
        'background_color' => '#fff',
    ]);
}

$source = new Creatomate\Source([
    'output_format' => 'mp4',
    'frame_rate' => 30,
    'width' => 1280,
    'height' => 720,
    'elements' => array_merge($videoElements, $textElements),
]);

echo 'Please wait while your video is being rendered...' . PHP_EOL;

try {
    $renders = $client->render(['source' => $source]);

    echo 'Completed: ' . json_encode($renders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (Exception $ex) {
    echo 'Error: ' . $ex->getMessage();
}
