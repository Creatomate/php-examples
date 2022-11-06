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

    new Creatomate\Elements\Image([
      'x' => '50%',
      'y' => '16.6667%',
      'width' => '33.3333%',
      'height' => '33.3333%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image1.jpg',

      // Rotate on the Z axis
      'z_rotation' => [
        ['value' => 0, 'time' => 'start'],
        ['value' => 360, 'time' => 'end'],
      ],

    ]),

    new Creatomate\Elements\Image([
      'x' => '16.6667%',
      'y' => '50%',
      'width' => '33.3333%',
      'height' => '33.3333%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image1.jpg',

      // Rotate on the X axis
      'x_rotation' => [
        ['value' => 0, 'time' => 'start'],
        ['value' => 360, 'time' => 'end'],
      ],
    ]),

    new Creatomate\Elements\Image([
      'x' => '83.3333%',
      'y' => '50%',
      'width' => '33.3333%',
      'height' => '33.3333%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image1.jpg',

      // Rotate on the Y axis
      'y_rotation' => [
        ['value' => 0, 'time' => 'start'],
        ['value' => 360, 'time' => 'end'],
      ],
    ]),

    new Creatomate\Elements\Image([
      'x' => '50%',
      'y' => '83.3333%',
      'width' => '33.3333%',
      'height' => '33.3333%',
      'source' => 'https://creatomate-static.s3.amazonaws.com/demo/image1.jpg',

      // Rotate on the Y axis
      'y_rotation' => [
        ['value' => 0, 'time' => 'start'],
        ['value' => 360, 'time' => 'end'],
      ],

      // Don't render the backface
      'backface_visible' => false,
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
