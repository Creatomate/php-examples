<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([

  'output_format' => 'gif',

  // Set to 'fast' or 'best' depending on your preference
  'gif_quality' => 'best',

  // Compression level ranging from 0 to 200 (0 means no compression, 200 means heavy compression)
  'gif_compression' => 30,

  // Frame rate of the GIF
  'frame_rate' => 15,

  // GIF width
  'width' => 480,

  // GIF height
  'height' => 272,

  'elements' => [
    new Creatomate\Elements\Video([
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
    ]),
  ],
]);

echo 'Please wait while your GIF is being rendered...' . PHP_EOL;

try {
  $renders = $client->render(['source' => $source]);

  echo 'Completed: ' . json_encode($renders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (Exception $ex) {
  echo 'Error: ' . $ex->getMessage();
}
