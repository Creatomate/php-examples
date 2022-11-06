<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([

  'output_format' => 'mp4',
  'frame_rate' => 30,

  // Try different resolutions to see the responsive overlay in action.
  'width' => 720,
  'height' => 720,

  'elements' => [

    new Creatomate\Elements\Composition([
      'track' => 1,
      'x_padding' => '3 vmin',
      'y_padding' => '3 vmin',
      'fill_color' => 'rgba(230,126,34,1)',
      'elements' => [

        // Image 1
        new Creatomate\Elements\Image([
          'track' => 1,
          'duration' => 3,
          'border_radius' => '2 vmin',
          'clip' => true,
          'source' => 'https://creatomate-static.s3.amazonaws.com/demo/city1.jpg',
          'animations' => [
            new Creatomate\Animations\Scale([
              'easing' => 'linear',
              'scope' => 'element',
              'end_scale' => '130%',
              'start_scale' => '100%',
              'fade' => false,
            ]),
          ],
        ]),

        // Image 2
        new Creatomate\Elements\Image([
          'track' => 1,
          'duration' => 3,
          'border_radius' => '2 vmin',
          'clip' => true,
          'source' => 'https://creatomate-static.s3.amazonaws.com/demo/city2.jpg',
          'animations' => [
            new Creatomate\Animations\Scale([
              'easing' => 'linear',
              'scope' => 'element',
              'start_scale' => '100%',
              'end_scale' => '130%',
              'fade' => false,
            ]),
          ],
        ]),

        // Image 3
        new Creatomate\Elements\Image([
          'track' => 1,
          'duration' => 3,
          'border_radius' => '2 vmin',
          'clip' => true,
          'source' => 'https://creatomate-static.s3.amazonaws.com/demo/city3.jpg',
          'animations' => [
            new Creatomate\Animations\Scale([
              'easing' => 'linear',
              'scope' => 'element',
              'start_scale' => '100%',
              'end_scale' => '130%',
              'fade' => false,
            ]),
          ],
        ]),

        // Text "Amsterdam"
        new Creatomate\Elements\Text([
          'track' => 2,
          'y' => '68.3864%',
          'width' => '71.94%',
          'height' => '16.9545%',
          'x_alignment' => '50%',
          'y_alignment' => '100%',
          'text' => 'Amsterdam',
          'font_family' => 'Cabin',
          'font_weight' => 700,
          'fill_color' => '#ffffff',
          'shadow_color' => 'rgba(0,0,0,1)',
          'shadow_blur' => 0,
          'shadow_x' => '0.5 vmin',
          'shadow_y' => '0.5 vmin',
          'enter' => new Creatomate\Animations\TextSlide([
            'time' => 'start',
            'duration' => '1 s',
            'easing' => 'quadratic-out',
            'type' => 'text-slide',
            'scope' => 'split-clip',
            'split' => 'letter',
            'distance' => '200%',
            'direction' => 'up',
          ]),
        ]),

        // Text "from $90 per night"
        new Creatomate\Elements\Text([
          'track' => 3,
          'time' => 1.08,
          'y' => '87.0623%',
          'width' => '71.94%',
          'height' => '15.2653%',
          'x_alignment' => '50%',
          'text' => 'from [weight 700]$90[/weight] per night',
          'text_wrap' => false,
          'font_family' => 'Cabin',
          'font_weight' => 400,
          'fill_color' => '#ffffff',
          'background_color' => 'rgba(230,126,34,1)',
          'background_x_padding' => '50%',
          'background_y_padding' => '17%',
          'background_border_radius' => '28%',
          'enter' => new Creatomate\Animations\TextReveal([
            'time' => 'start',
            'duration' => '1 s',
            'easing' => 'quadratic-out',
            'axis' => 'x',
            'split' => 'line',
            'x_anchor' => '0%',
          ]),
        ]),

      ],
    ]),

    // Logo in upper left corner
    new Creatomate\Elements\Composition([
      'track' => 2,
      'x' => '0%',
      'y' => '0%',
      'width' => '53.5906 vmin',
      'height' => '16.8567 vmin',
      'x_anchor' => '0%',
      'y_anchor' => '0%',
      'fill_color' => 'rgba(230,126,34,1)',
      'border_radius' => '2.3 vmin',
      'elements' => [
        new Creatomate\Elements\Image([
          'width' => '81.6363%',
          'height' => '61.5928%',
          'source' => 'https://creatomate-static.s3.amazonaws.com/demo/logoipsum.png',
          'fit' => 'contain',
          'shadow_color' => 'rgba(0,0,0,1)',
          'shadow_blur' => 0,
          'shadow_x' => '0.5 vmin',
          'shadow_y' => '0.5 vmin',
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
