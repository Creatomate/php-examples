<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$options = [

  // In order to create multiple renders in one API call, assign tags to any of your templates in your project,
  // then specify those tags here.
  // For more information, see https://creatomate.com/docs/api/rest-api/post-v1-renders
  'tags' => [
    'instagram-templates',
    'twitter-templates',
  ],

  // Modifications that you want to apply to all templates.
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
