<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use function Symfony\Component\String\s;

function getQuestions($text)
{
    $arrayText = explode("\n", $text);
    $arrayTextTrimmed = array_map(fn($item) => s($item)->trim()->__toString(), $arrayText);
    $filtered = array_filter($arrayTextTrimmed, fn($item) => s($item)->endsWith('?'));
    return implode("\n", $filtered);
}

$text = <<<HEREDOC
lala\r\nr
ehu?\t
vie?eii
\n \t
i see you
/r \n
one two?\r\n\n
turum-purum
HEREDOC;
var_dump(getQuestions($text));
