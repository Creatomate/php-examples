<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format' => 'png',
  'width' => 1280,
  'height' => 720,
  'fill_color' => '#ffffff',

  'elements' => [

    new Creatomate\Elements\Text([
      'y' => '21.5767%',
      'text' => 'Default shadow',
      'font_weight' => 700,
      'fontsize' => '13 vmin',
      'shadow_color' => 'rgba(0,0,0,0.39)',
    ]),

    new Creatomate\Elements\Text([
      'y' => '40.526%',
      'text' => 'Drop shadow',
      'font_weight' => 700,
      'font_size' => '13 vmin',
      'shadow_color' => 'rgba(0,0,0,0.5)',
      'shadow_blur' => '3 vmin',
      'shadow_x' => '0 vmin',
      'shadow_y' => '2.8 vmin',
    ]),

    new Creatomate\Elements\Text([
      'y' => '59.3515%',
      'text' => 'Color shadow',
      'font_weight' => 700,
      'font_size' => '13 vmin',
      'shadow_color' => '#00eeff',
      'shadow_blur' => '1.6 vmin',
    ]),

    new Creatomate\Elements\Text([
      'y' => '78.4236%',
      'text' => 'Flat shadow',
      'font_weight' => 700,
      'font_size' => '13 vmin',
      'shadow_color' => '#00eeff',
      'shadow_blur' => '0 vmin',
      'shadow_x' => '1 vmin',
      'shadow_y' => '1 vmin',
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
