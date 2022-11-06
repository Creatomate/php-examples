<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$options = [

  // Add the attached template (template.json in this directory) to your account and specify its ID here.
  // You can do this by creating a new blank template in the template editor, then pressing F12 to open the source editor and pasting the JSON document inside.
  // For more information, see https://creatomate.com/docs/template-editor/source-editor
  'template_id' => '2e8bccbf-e40a-41d5-a815-f58518ed9835',

  // Modifications that you want to apply to the template.
  // For more information, see https://creatomate.com/docs/api/rest-api/the-modifications-object
  'modifications' => [
    'Title' => 'Insert your news headline or announcement here',
    'Text 1' => 'Add a small snippet from your article here. This is just an example text to show how this template can be used.',
    'Text 2' => 'Continuation of the story. You can enter an call to action here, for example.',
  ],
];

echo 'Please wait while your video is being rendered...' . PHP_EOL;

try {
  $renders = $client->render($options);

  echo 'Completed: ' . json_encode($renders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (Exception $ex) {
  echo 'Error: ' . $ex->getMessage();
}
