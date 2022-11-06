<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

$source = new Creatomate\Source([

  'output_format' =>  'mp4',

  'elements' =>  [

    new Creatomate\Elements\Composition([

      // Simulate camera shake
      'animations' =>  [
        // Random horizontal shake
        new Creatomate\Animations\Shake([
          'distance' =>  '0.5%',
          'frequency' =>  '1.5 Hz',
          'randomness' =>  '100%',
          'ramp_duration' =>  '0%',
        ]),
        // Random vertical shake
        new Creatomate\Animations\Shake([
          'direction' =>  '90°',
          'distance' =>  '0.5%',
          'frequency' =>  '1.5 Hz',
          'randomness' =>  '100%',
          'ramp_duration' =>  '0%',
        ]),
        // Random rotational wiggle
        new Creatomate\Animations\Wiggle([
          'frequency' =>  '1 Hz',
          'randomness' =>  '100%',
          'z_rotation' =>  '0.2°',
          'ramp_duration' =>  '0%',
        ]),
      ],

      // Scale up to account for camera shake
      'x_scale' =>  '105%',
      'y_scale' =>  '105%',

      'elements' =>  [

        // Times square photo
        new Creatomate\Elements\Image([
          'source' =>  'https://creatomate-static.s3.amazonaws.com/demo/times-square.jpg',
        ]),

        // Composition that is projected on a billboard
        new Creatomate\Elements\Composition([
          'x' =>  '53.6583%',
          'y' =>  '52.4322%',
          'width' =>  '16.4755%',
          'height' =>  '20.2832%',
          'aspect_ratio' =>  0.6498,
          'fill_color' =>  '#4b7be5',

          // Four corners (top left, top right, bottom left, bottom right)
          // Tip: Create these warp points with the template editor
          // https://creatomate.com/docs/template-editor/introduction
          'warp_mode' => 'perspective',
          'warp_matrix' => [
            [
              ['x' =>  '3.0703%', 'y' =>  '0.2217%'],
              ['x' =>  '95.0703%', 'y' =>  '2.5683%'],
            ],
            [
              ['x' =>  '-2.2956%', 'y' =>  '98.61%'],
              ['x' =>  '101.3554%', 'y' =>  '100.5701%'],
            ],
          ],

          'elements' =>  [

            // Video projected on billboard. The total video stretches to the length of this video.
            new Creatomate\Elements\Video([
              'track' =>  1,
              'source' =>  'https://creatomate-static.s3.amazonaws.com/demo/vertical.mp4',
            ]),

            // Outro that is played after the video
            new Creatomate\Elements\Composition([
              'track' =>  1,

              'transition' =>  new Creatomate\Animations\CircularWipe([
                'duration' =>  1,
              ]),

              'elements' =>  [

                new Creatomate\Elements\Text([
                  'width' =>  '66.2379%',
                  'height' =>  '22.3534%',
                  'x_alignment' =>  '50%',
                  'y_alignment' =>  '50%',
                  'fill_color' =>  '#fff',
                  'text' =>  'Edit This Outro',
                  'font_weight' =>  '800',
                  'line_height' =>  '94%',
                ]),

                new Creatomate\Elements\Rectangle([
                  'width' =>  '82.7212%',
                  'height' =>  '38.8825%',
                  'stroke_color' =>  '#fff',
                  'stroke_width' =>  '0.5 vmin',
                ]),
              ],
            ]),
          ],
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
