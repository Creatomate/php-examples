<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([

  'output_format' => 'mp4',

  // At 2 seconds in, a screenshot is taken and stored alongside the video in 'snapshotUrl' in the render result
  // If you only want to create a screenshot and don't care about the video, refer to the 'video-screenshot' example
  'snapshot_time' => 2,

  'elements' => [
    new Creatomate\Elements\Video([
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
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
