<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([

  // Encodes to H.264 by default, a widely supported video format
  'output_format' => 'mp4',

  // Constant rate factor – a higher value means a higher compression
  'crf' => 27,

  'elements' => [
    new Creatomate\Elements\Video([

      // Provide any video file here. The video in this example is of HEVC (H.265), a format used by
      // iPhones but not supported by many video players.
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/h265.mov',
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
