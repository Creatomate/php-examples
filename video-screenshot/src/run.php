<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

// This example shows how to take a screenshot from a video
// Look at the 'video-snapshot' example if you want to make a screenshot alongside a video render

$source = new Creatomate\Source([

  'output_format' => 'jpg',

  'elements' => [
    new Creatomate\Elements\Video([
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',

      // By default, the screenshot is taken at the beginning. To screenshot at 2 seconds, uncomment the following:
      'trim_start' => 2,
    ]),
  ],
]);

echo 'Please wait while your image is being rendered...' . PHP_EOL;

try {
  $renders = $client->render(['source' => $source]);

  echo 'Completed: ' . json_encode($renders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (Exception $ex) {
  echo 'Error: ' . $ex->getMessage();
}
