<?php
function isPalindrome($str)
{
    $str = mb_convert_encoding($str, "UTF-8");
    $middleIndex = ceil(mb_strlen($str) / 2);
    $beginChar = '';
    $endChar = '';
    for ($i = 0; $i <= $middleIndex - 1; $i++){
        $beginChar = mb_substr($str, $i, 1);
        $endChar = mb_substr($str, - ($i + 1), 1);
        if ($beginChar !== $endChar) {
            return false;
        }
    }
    return true;
}
var_dump(isPalindrome('шалашаш'));