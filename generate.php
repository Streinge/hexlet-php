<?php

namespace Hexlet\Php\Generate;

function factorial($number){ 
    if($number <= 1){ 
        return 1; 
    } 
    else{ 
        return $number * factorial($number - 1); 
    } 
} 
function generate(int $number): array
{
    $result = [1];
    for ($i = 1; $i <= $number; $i++) {
        $result[] = round(factorial($number) / (factorial($i) * (factorial($number - $i))));
    }
    return $result;
}
var_dump(generate(7));
