<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format' => 'mp4',
  'frame_rate' => 60,
  'emoji_style' => 'apple', // Choose between 'facebook', 'google', 'twitter' and 'apple'

  'elements' => [

    new Creatomate\Elements\Video([
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video4.mp4',
    ]),

    new Creatomate\Elements\Text([
      'text' => 'This text adjusts automatically to the size of the video. 🔥',
      'y' => '75%',
      'width' => '100%',
      'height' => '50%',
      'x_padding' => '5 vw',
      'y_padding' => '5 vh',
      'y_alignment' => '100%',
      'font_family' => 'Open Sans',
      'font_weight' => 700,
      'font_size_maximum' => '10.4 vmin',
      'background_color' => 'rgba(255,255,255,0.69)',
      'background_x_padding' => '23%',
      'background_y_padding' => '8%',
      'background_align_threshold' => '0%',
      'fill_color' => '#333333',
      'enter' => new Creatomate\Animations\TextSlide([
        'duration' => '2 s',
        'easing' => 'quadratic-out',
        'split' => 'line',
        'scope' => 'element',
        'background_effect' => 'scaling-clip'
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
