<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format' =>  'mp4',
  'emoji_style' =>  'apple', // Choose between 'facebook', 'google', 'twitter' and 'apple'

  'elements' =>  [

    new Creatomate\Elements\Video([
      'source' =>  'https://creatomate-static.s3.amazonaws.com/demo/video4.mp4',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  'This text adjusts automatically to the resolution of the video. 🎉',
      'y' =>  '86%',
      'width' =>  '92%',
      'height' =>  '16%',
      'fill_color' =>  '#000',
      'font_family' =>  'Dosis',
      'font_weight' =>  '600',
      'font_sizeminimum' =>  '4.8 vmin',
      'x_alignment' =>  '50%',
      'y_alignment' =>  '50%',
      'background_color' => '#fff',
      'background_border_radius' => '20%',
      'background_align_threshold' => '0%',
      'enter' =>  new Creatomate\Animations\TextTypewriter([
        'duration' =>  3,
        'easing' =>  'quadratic-out',
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
