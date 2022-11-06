<?php

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 2) {
  die('Please provide your API key, as follows: php run.php YOUR_API_KEY');
}

$apiKey = $argv[1];
$client = new Creatomate\Client($apiKey);

// The SDK comes with these preset text animations.
// Each animation is highly configurable, you can use the template editor to test out variations.
// https://creatomate.com/docs/template-editor/animations
$textAnimations = [

  // Text Slide and variants
  new Creatomate\Animations\TextSlide(),
  // new Creatomate\Animations\TextSlideDownLetterByLetter(),
  // new Creatomate\Animations\TextSlideDownLetterByLetterClipped(),
  // new Creatomate\Animations\TextSlideDownLineByLine(),
  // new Creatomate\Animations\TextSlideDownLineByLineClipped(),
  // new Creatomate\Animations\TextSlideDownWordByWord(),
  // new Creatomate\Animations\TextSlideDownWordByWordClipped(),
  // new Creatomate\Animations\TextSlideLeftLetterByLetter(),
  // new Creatomate\Animations\TextSlideLeftLetterByLetterClipped(),
  // new Creatomate\Animations\TextSlideLeftLineByLine(),
  // new Creatomate\Animations\TextSlideLeftLineByLineClipped(),
  // new Creatomate\Animations\TextSlideLeftWordByWord(),
  // new Creatomate\Animations\TextSlideLeftWordByWordClipped(),
  // new Creatomate\Animations\TextSlideRightLetterByLetterClipped(),
  // new Creatomate\Animations\TextSlideRightLineByLine(),
  // new Creatomate\Animations\TextSlideRightLineByLineClipped(),
  // new Creatomate\Animations\TextSlideRightWordByWord(),
  // new Creatomate\Animations\TextSlideRightWordByWordClipped(),
  // new Creatomate\Animations\TextSlideUpLetterByLetter(),
  // new Creatomate\Animations\TextSlideUpLetterByLetterClipped(),
  // new Creatomate\Animations\TextSlideUpLineByLine(),
  // new Creatomate\Animations\TextSlideUpLineByLineClipped(),
  // new Creatomate\Animations\TextSlideUpWordByWord(),
  // new Creatomate\Animations\TextSlideUpWordByWordClipped(),

  // Text Scale and variants
  new Creatomate\Animations\TextScale(),
  // new Creatomate\Animations\TextScaleCenter(),
  // new Creatomate\Animations\TextScaleCenterHorizontal(),
  // new Creatomate\Animations\TextScaleCenterVertical(),
  // new Creatomate\Animations\TextScaleDown(),
  // new Creatomate\Animations\TextScaleLeft(),
  // new Creatomate\Animations\TextScaleRight(),
  // new Creatomate\Animations\TextScaleUp(),

  // Text Appear and variants
  new Creatomate\Animations\TextAppear(),
  // new Creatomate\Animations\TextAppearLetterByLetter(),
  // new Creatomate\Animations\TextAppearLetterByLetterHighlighting(),
  // new Creatomate\Animations\TextAppearLetterByLetterRandomly(),
  // new Creatomate\Animations\TextAppearLineByLine(),
  // new Creatomate\Animations\TextAppearLineByLineHighlighting(),
  // new Creatomate\Animations\TextAppearLineByLineRandomly(),
  // new Creatomate\Animations\TextAppearWordByWord(),
  // new Creatomate\Animations\TextAppearWordByWordHighlighting(),
  // new Creatomate\Animations\TextAppearWordByWordRandomly(),

  // Text Reveal and variants
  new Creatomate\Animations\TextReveal(),
  // new Creatomate\Animations\TextRevealCenter(),
  // new Creatomate\Animations\TextRevealCenterHorizontal(),
  // new Creatomate\Animations\TextRevealCenterVertical(),
  // new Creatomate\Animations\TextRevealDown(),
  // new Creatomate\Animations\TextRevealLeft(),
  // new Creatomate\Animations\TextRevealRight(),
  // new Creatomate\Animations\TextRevealUp(),

  // Text Spin and variants
  new Creatomate\Animations\TextSpin(),
  // new Creatomate\Animations\TextSpinLetters(),
  // new Creatomate\Animations\TextSpinLettersChaotic(),
  // new Creatomate\Animations\TextSpinLettersChaoticRandomly(),
  // new Creatomate\Animations\TextSpinLettersDown(),
  // new Creatomate\Animations\TextSpinLettersLeft(),
  // new Creatomate\Animations\TextSpinLettersRight(),
  // new Creatomate\Animations\TextSpinLettersUp(),

  // Text Fly and variants
  new Creatomate\Animations\TextFly(),
  // new Creatomate\Animations\TextFlyInLetterByLetter(),
  // new Creatomate\Animations\TextFlyInLineByLine(),
  // new Creatomate\Animations\TextFlyInWordByWord(),

  // Text Wave and variants
  new Creatomate\Animations\TextWave(),
  // new Creatomate\Animations\TextWaveInLetterByLetter(),
  // new Creatomate\Animations\TextWaveInLetterByLetterAlternative(),
  // new Creatomate\Animations\TextWaveInLetterByLetterRandomly(),
  // new Creatomate\Animations\TextWaveInLineByLine(),
  // new Creatomate\Animations\TextWaveInLongWavelength(),
  // new Creatomate\Animations\TextWaveInWordByWord(),

  // Text Typewriter and variants
  new Creatomate\Animations\TextTypewriter(),
  // new Creatomate\Animations\TextTypewriterFixedDuration(),
];

$textElements = [];
for ($i = 0; $i < count($textAnimations); $i++) {

  // Create a text string based on the name of a text animation instance, e.g. "Slide Down Letter By Letter"
  $classPath = explode('\\', get_class($textAnimations[$i]));
  $className = end($classPath);
  $text = implode(' ', preg_split('/(?=[A-Z])/', $className, -1, PREG_SPLIT_NO_EMPTY));

  // Create text element
  $textElements[] = new Creatomate\Elements\Text([
    'track' => 1,
    'duration' => 2.5,
    'width' => '90%',
    'height' => '90%',
    'y_alignment' => '50%',
    'text' => $text,
    'enter' => $textAnimations[$i],
    'exit' => $textAnimations[$i],
  ]);
}

$source = new Creatomate\Source([
  'output_format' => 'mp4',
  'frame_rate' => 60,
  'width' => 1280,
  'height' => 720,
  'fill_color' => '#ffffff',
  'elements' => $textElements,
]);

echo 'Please wait while your video is being rendered...' . PHP_EOL;

try {
  $renders = $client->render(['source' => $source]);

  echo 'Completed: ' . json_encode($renders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (Exception $ex) {
  echo 'Error: ' . $ex->getMessage();
}
