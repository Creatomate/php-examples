<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format' => 'mp4',
  'duration' => 3,

  'elements' => [

    new Creatomate\Elements\Video([
      'x' => '25%',
      'y' => '25%',
      'width' => '50%',
      'height' => '50%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
    ]),

    new Creatomate\Elements\Video([
      'x' => '75%',
      'y' => '25%',
      'width' => '50%',
      'height' => '50%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video2.mp4',
    ]),

    new Creatomate\Elements\Video([
      'x' => '25%',
      'y' => '75%',
      'width' => '50%',
      'height' => '50%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video3.mp4',
    ]),

    new Creatomate\Elements\Video([
      'x' => '75%',
      'y' => '75%',
      'width' => '50%',
      'height' => '50%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video4.mp4',
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
