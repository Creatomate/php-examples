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

    // Add logo to the upper right corner
    new Creatomate\Elements\Image([
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/logoipsum.png',
      'fit' => 'contain',
      'width' => '60 vmin',
      'height' => '60 vmin',
      'x' => '100%',
      'y' => '0%',
      'x_anchor' => '100%',
      'y_anchor' => '0%',
      'x_alignment' => '100%',
      'y_alignment' => '0%',
      'x_padding' => '7 vmin',
      'y_padding' => '7 vmin',
      'shadow_color' => 'rgba(0,0,0,0.66)',
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
