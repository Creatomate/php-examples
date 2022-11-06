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
  'duration' => 8,

  'elements' => [

    new Creatomate\Elements\Composition([

      // This example demonstrates how to loop a composition. To loop video or audio clips, use the 'loop' property of
      // the video or audio element instead.

      // By setting the duration of this composition to 2 seconds and setting 'loop' to true, the composition and its
      // content is looped for the total length (8 seconds)
      'duration' => 2,
      'loop' => true,

      // If you want to limit the number of loops, uncomment the following line:
      // 'plays' => 2,

      'elements' => [

        new Creatomate\Elements\Rectangle([

          'width' => '24%',
          'height' => '42%',

          // Animate x position in 2 seconds
          'x' => [
            ['value' => '20%', 'time' => 0],
            ['value' => '80%', 'time' => 1],
            ['value' => '20%', 'time' => 2],
          ],

          // Animate from blue -> gray -> red -> gray -> blue in 2 seconds
          'fill_color' => [
            ['value' => '#0079ff', 'time' => 0],
            ['value' => '#333333', 'time' => 0.5],
            ['value' => '#ff5454', 'time' => 1],
            ['value' => '#333333', 'time' => 1.5],
            ['value' => '#0079ff', 'time' => 2],
          ],

        ]),
      ],
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
