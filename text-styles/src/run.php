<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([
  'output_format' =>  'png',
  'width' =>  1920,
  'height' =>  1080,
  'fill_color' =>  '#ffffff',
  'elements' =>  [

    new Creatomate\Elements\Text([
      'text' =>  'Inline styles can be applied to text with style tags. It\'s possible to set the ' .
        '[family Architects Daughter]font family[/family], [weight 800]weight[/weight], [style italic]style[/style], ' .
        '[size 50%]size[/size], and [color #3498db]color[/color].',
      'y' =>  '18.8478%',
      'width' =>  '67.2833%',
      'height' =>  '24.6106%',
      'font_family' =>  'Aileron',
      'font_weight' =>  600,
      'x_alignment' =>  '50%',
      'y_alignment' =>  '50%',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  'Text outline',
      'x' =>  '17.1225%',
      'y' =>  '41.5765%',
      'fill_color' =>  null,
      'stroke_color' => '#333333',
      'stroke_width' => '0.4 vmin',
      'font_weight' =>  '800',
      'font_size' =>  '8.16 vmin',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  'Text shadow',
      'x' =>  '48.2061%',
      'y' =>  '41.5765%',
      'shadow_color' => 'rgba(0,0,0,0.37)',
      'shadow_blur' => '3 vmin',
      'shadow_x' => '0 vmin',
      'shadow_y' => '3.3 vmin',
      'font_weight' =>  '800',
      'font_size' =>  '8.16 vmin',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  'Text gradient',
      'x' =>  '81.154%',
      'y' =>  '41.5765%',
      'fill_mode' => 'linear',
      'fill_x0' => '0%',
      'fill_y0' => '50%',
      'fill_x1' => '100%',
      'fill_y1' => '50%',
      'fill_color' => [
        ['offset' => '0%', 'color' => '#27e1ad'],
        ['offset' => '100%', 'color' => '#0004ff'],
      ],
      'font_weight' =>  '800',
      'font_size' =>  '8.16 vmin',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  'This text is converted to uppercase.',
      'y' =>  '56.2158%',
      'font_size' =>  '5.759 vmin',
      'text_transform' =>  'uppercase',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  'This text has a larger spacing between letters.',
      'y' =>  '67.9249%',
      'font_size' =>  '5.759 vmin',
      'letter_spacing' =>  '190%',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  "This text has a\nlarger line spacing.",
      'x' =>  '28.4155%',
      'y' =>  '84.7227%',
      'width' =>  '34.0633%',
      'height' =>  '17.4695%',
      'x_alignment' =>  '50%',
      'line_height' =>  '172%',
    ]),

    new Creatomate\Elements\Text([
      'text' =>  'This text has a background color.',
      'x' =>  '71.5845%',
      'y' =>  '84.7227%',
      'width' =>  '34.0633%',
      'height' =>  '17.4695%',
      'x_alignment' =>  '50%',
      'fill_color' =>  '#ffffff',
      'background_color' => '#000000',
      'background_x_padding' => '43%',
      'background_y_padding' => '25%',
      'background_border_radius' => '23%',
      'background_align_threshold' => '0%',
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
