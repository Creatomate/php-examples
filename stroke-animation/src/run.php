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
  'duration' => 5,

  'elements' => [

    // Rectangle with border radius
    new Creatomate\Elements\Rectangle([
      'width' => '80%',
      'height' => '80%',
      'stroke_color' => '#ffffff',
      'stroke_width' => '3.1 vmin',
      'stroke_end' => [
        ['value' => '0%', 'time' => 'start'],
        ['value' => '100%', 'time' => 'end'],
      ],
      'stroke_offset' => [
        ['value' => '0%', 'time' => 'start'],
        ['value' => '50%', 'time' => 'end'],
      ],
      'border_radius' => '17.6 vmin',
    ]),

    // Bézier curve
    new Creatomate\Elements\Shape([
      'time' => 0,
      'x' => 640,
      'y' => 360,
      'stroke_color' => '#ffffff',
      'stroke_width' => '2.6 vmin',
      'stroke_end' => [
        ['value' => '0%', 'time' => 0],
        ['value' => '100%', 'time' => 3],
      ],
      'path' => 'M -393.6568 154.7581 C -393.6568 154.7581 -26.0129 266.9806 55.5918 169.7829 C 137.1971 72.5862 -161.4926 -83.7996 -63.0777 -179.9604 C 35.3371 -276.1202 297.4396 -139.9921 297.4396 -139.9921',
    ]),

    // Arrow
    new Creatomate\Elements\Shape([
      'time' => 3,
      'x' => 908.8047,
      'y' => 206.6498,
      'width' => '4.4742%',
      'height' => '13.0843%',
      'stroke_color' => '#ffffff',
      'stroke_width' => '2.6 vmin',
      'stroke_end' => [
        ['value' => '0%', 'time' => 0],
        ['value' => '100%', 'time' => 1],
      ],
      'path' => 'M 57.8803 0 L 100 63.7958 L -3.6107 90.1225',
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
