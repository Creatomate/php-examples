<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format' => 'mp4',
  'framerate' => 1,
  'width' => 1280,
  'height' => 720,
  'fill_color' => '#ffffff',
  'elements' => [

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 2,
      'width' => '80%',
      'height' => '80%',
      'text' => '1. This is an example text.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'y_alignment' => '50%',
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 2,
      'width' => '80%',
      'height' => '80%',
      'text' => "2. This is an example text\nwithout line wrapping.",
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'y_alignment' => '50%',
      'text_wrap' => false,
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 2,
      'width' => '80%',
      'height' => '80%',
      'text' => '3. This is a centered example text.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'x_alignment' => '50%',
      'y_alignment' => '50%',
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'width' => '80%',
      'height' => '80%',
      'text' => '4. This is a very long text. You can see that the text auto-sizes to fit the available space.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'y_alignment' => '50%',
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'width' => '80%',
      'height' => '80%',
      'text' => '5. Font auto-sizing can be controlled by setting a [color gray]minimum[/color] and ' .
        '[color gray]maximum[/color]. As can be seen in this example, text has a very small minimum size by default ' .
        'and therefore shrinks as it gets longer. Maybe you don\'t want this, since it might become too small for ' .
        'your needs. This can be fixed by setting a minimum font size as shown in the next example.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'y_alignment' => '50%',
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'width' => '80%',
      'height' => '80%',
      'text' => '6. In this example, the minimum font size has been set. This results in this text being clipped with an ' .
        'ellipsis (...) because it overflows its available space and can\'t be shrunk to fit.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'font_size_minimum' => '12 vmin',
      'text_clip' => true,
      'y_alignment' => '50%',
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'text' => "7. In the absence of width or height,\nthe text does not adhere to a bounding box.\n" .
        'A fixed font size is required.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'font_size' => '6 vmin',
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'width' => '80%',
      'text' => '8. It\'s also possible to just set a width.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'height' => '30%',
      'text' => '9. Or height',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'width' => '80%',
      'height' => '80%',
      'text' => '10. Here\'s an example of using a fixed width, height, and font size. When the text exceeds the ' .
        'available space, it is clipped.',
      'font_family' => 'Montserrat',
      'font_weight' => 800,
      'font_size' => '12 vmin',
      'text_clip' => true,
      'y_alignment' => '50%',
    ]),

    new Creatomate\Elements\Text([
      'track' => 1,
      'duration' => 3,
      'width' => '80%',
      'height' => '80%',
      'text' => '11. Even when using [size 150%][weight 700]different[/weight][/size] fonts, [family Roboto Slab]the ' .
        'text will [size 50%]automatically adjust to fit the available space 👌.[/size][/family]',
      'font_family' => 'Montserrat',
      'font_weight' => 400,
      'y_alignment' => '50%',
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
