<?php

namespace Hexlet\Php;

function normalize(array &$arr)
{
    $arr['name'] = mb_convert_case($arr['name'], MB_CASE_TITLE, "UTF-8");
    $arr['description'] = mb_strtolower($arr['description']);
}

$lesson = [
    'name' => 'ДеструКТУРИЗАЦИЯ',
    'description' => 'каК удивитЬ друзей',
];

normalize($lesson);
var_dump($lesson);
