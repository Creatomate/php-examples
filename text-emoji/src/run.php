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
      'text' => 'All Facebook, Google, Twitter and Apple emoji are supported. 😀 😃 😄 😁 😆 😅 😂 🤣  ☺️ 😊 😇 🙂 ' .
        '🙃 😉 😌 😍 🥰 😘 😗 😙 😚 😋 😛 😝 😜 🤪 🤨 🧐 🤓 😎  🤩 🥳 😏 😒 😞 😔 😟 😕 🙁 ☹️ 😣 😖 😫 😩 ' .
        '🥺 😢 😭 😮‍💨 😤 😠 😡 🤬 🤯 😳 🥵 🥶 😱 😨 😰 😥 😓  🤗  🤔  🤭 🤫 🤥 😶 😶‍🌫️ 😐 😑 😬  🙄 😯 😦 ' .
        '😧 😮 😲 🥱 😴 🤤 😪 😵 😵‍💫  🤐 🥴 🤢 🤮 🤧 😷 🤒 🤕 🤑 🤠 😈 👿 👹 👺 🤡 💩 👻 💀 ☠️ 👽 👾 🤖 ' .
        '🎃 😺 😸 😹 😻 😼 😽 🙀 😿 😾 (...and 10.000 more)',
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
