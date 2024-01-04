<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Functional\repeat;
use function Funct\Collection;

function enlargeArrayImage()
{

}

$image = [
    ['*','*','*','*'],
    ['*',' ',' ','*'],
    ['*',' ',' ','*'],
    ['*','*','*','*']
  ];
  // ****
  // *  *
  // *  *
  // ****

  enlargeArrayImage($image);
  // ********
  // ********
  // **    **
  // **    **
  // **    **
  // **    **
  // ********
  // ********
  $image = [
    ['*','*','*','*'],
    ['*',' ',' ','*'],
    ['*',' ',' ','*'],
    ['*','*','*','*']
  ];
  // ****
  // *  *
  // *  *
  // ****

  enlargeArrayImage($image);
  // ********
  // ********
  // **    **
  // **    **
  // **    **
  // **    **
  // ********
  // ********
