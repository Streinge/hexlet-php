<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Functional\repeat;
use function Functional\concat;

function enlargeArrayImage(array $image)
{
    $arr = array_reduce($image, function ($accExt, $imag) {
        $accExt[] = array_reduce($imag, function ($accInt, $im) {
            $accInt[] = $im;
            $accInt[] = $im;
            return $accInt;
        }, []);
        $accExt[] = array_reduce($imag, function ($accInt, $im) {
            $accInt[] = $im;
            $accInt[] = $im;
            return $accInt;
        }, []);
        return $accExt;
    }, []);
    return $arr;
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

  var_dump(enlargeArrayImage($image));
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

  // enlargeArrayImage($image);
  // ********
  // ********
  // **    **
  // **    **
  // **    **
  // **    **
  // ********
  // ********
