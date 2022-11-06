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

     // First row

     new Creatomate\Elements\Video([
       'x' => '16.6667%',
       'y' => '16.6667%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
     ]),

     new Creatomate\Elements\Video([
       'x' => '50%',
       'y' => '16.6667%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video2.mp4',
     ]),

     new Creatomate\Elements\Video([
       'x' => '83.3333%',
       'y' => '16.6667%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video3.mp4',
     ]),

     // Second row

     new Creatomate\Elements\Video([
       'x' => '16.6667%',
       'y' => '50%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video3.mp4',
     ]),

     new Creatomate\Elements\Video([
       'x' => '50%',
       'y' => '50%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video1.mp4',
     ]),

     new Creatomate\Elements\Video([
       'x' => '83.3333%',
       'y' => '50%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video2.mp4',
     ]),

     // Third row

     new Creatomate\Elements\Video([
       'x' => '16.6667%',
       'y' => '83.3333%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video2.mp4',
     ]),

     new Creatomate\Elements\Video([
       'x' => '50%',
       'y' => '83.3333%',
       'width' => '33.3333%',
       'height' => '33.3333%',
       'source' => 'https://creatomate-static.s3.amazonaws.com/demo/video3.mp4',
     ]),

     new Creatomate\Elements\Video([
       'x' => '83.3333%',
       'y' => '83.3333%',
       'width' => '33.3333%',
       'height' => '33.3333%',
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
