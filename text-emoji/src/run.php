<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format' => 'png',
  'emoji_style' => 'apple', // Choose between 'facebook', 'google', 'twitter', or 'apple'
  'width' => 1920,
  'height' => 1080,
  'fill_color' => '#ffffff',
  'elements' => [

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 2,
      'width' => '90%',
      'height' => '90%',
      'y_alignment' => '50%',
      'text' => 'All Facebook, Google, Twitter and Apple emoji are supported. ๐ ๐ ๐ ๐ ๐ ๐ ๐ ๐คฃ  โบ๏ธ ๐ ๐ ๐ ' .
        '๐ ๐ ๐ ๐ ๐ฅฐ ๐ ๐ ๐ ๐ ๐ ๐ ๐ ๐ ๐คช ๐คจ ๐ง ๐ค ๐  ๐คฉ ๐ฅณ ๐ ๐ ๐ ๐ ๐ ๐ ๐ โน๏ธ ๐ฃ ๐ ๐ซ ๐ฉ ' .
        '๐ฅบ ๐ข ๐ญ ๐ฎโ๐จ ๐ค ๐  ๐ก ๐คฌ ๐คฏ ๐ณ ๐ฅต ๐ฅถ ๐ฑ ๐จ ๐ฐ ๐ฅ ๐  ๐ค  ๐ค  ๐คญ ๐คซ ๐คฅ ๐ถ ๐ถโ๐ซ๏ธ ๐ ๐ ๐ฌ  ๐ ๐ฏ ๐ฆ ' .
        '๐ง ๐ฎ ๐ฒ ๐ฅฑ ๐ด ๐คค ๐ช ๐ต ๐ตโ๐ซ  ๐ค ๐ฅด ๐คข ๐คฎ ๐คง ๐ท ๐ค ๐ค ๐ค ๐ค  ๐ ๐ฟ ๐น ๐บ ๐คก ๐ฉ ๐ป ๐ โ ๏ธ ๐ฝ ๐พ ๐ค ' .
        '๐ ๐บ ๐ธ ๐น ๐ป ๐ผ ๐ฝ ๐ ๐ฟ ๐พ (...and 10.000 more)',
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
