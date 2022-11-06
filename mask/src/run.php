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
  'duration' => 4,
  'elements' => [

    // First video
    new Creatomate\Elements\Video([
      'time' => 0,
      'duration' => 3,
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video4.mp4',
    ]),

    // Second video
    new Creatomate\Elements\Video([
      'time' => 1,
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video5.mp4',
    ]),

    // Apply a luma mask to the video above
    new Creatomate\Elements\Video([
      'time' => 1,
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/mask.mp4',
      'mask_mode' => 'luma',
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
