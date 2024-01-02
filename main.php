<?php

require_once 'scrabble.php';

use function Hexlet\Php\scrabble;


var_dump(scrabble('rkqodlw', 'world')); // true
var_dump(scrabble('avj', 'java')); // false
var_dump(scrabble('avjafff', 'java')); // true
var_dump(scrabble('', 'hexlet')); // false
var_dump(scrabble('scriptingjava', 'JavaScript')); // true
