<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
    die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format'=> 'png',
  'width'=> 1920,
  'height'=> 1080,
  'fill_color'=> '#ffffff',
  'elements'=> [
    new Creatomate\Elements\Text([
      'width'=> '75%',
      'text'=> 'Creatomate ให้คุณใช้ข้อความภาษาไทยได้',
      'font_family'=> 'IBM Plex Sans Thai',
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
