<?php

require_once '../src/capitalize.php';

require_once '../vendor/autoload.php';

use Webmozart\Assert\Assert;

Assert::eq(Hexlet\Php\capitalize(''), '');

Assert::eq(Hexlet\Php\capitalize('hello'), 'Hello');

//echo 'Все тесты пройдены!';
