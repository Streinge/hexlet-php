<?php

namespace Hexlet\Php\GetLongestLength;

function findsSubstring(string $str): string
// функция ищет подстроку с уникальными символами
{
    $size = strlen($str);
    if ($size === 1 || empty($str)) {
        return $str;
    }
    $firstChar = $str[0];
    $newSubstr = $firstChar;
    for ($i = 1; $i < $size; $i++) {
        if ($str[$i] === $firstChar || $i === $size - 1) {
            if ($i === $size - 1) {
                $newSubstr .= "$str[$i]";
            }
            $testSubstr = substr($newSubstr, 1);
            // проверяю, что все символы найденной подстроки уникальные
            $testSubstr  = findsSubstring($testSubstr);
            $newFirstChar = $newSubstr[0];
            $newSubstr = "{$newFirstChar}{$testSubstr}";
            return $newSubstr;
        } else {
            $newSubstr .= "$str[$i]";
        }
    
    }
}

function getLongestLength(string $str)
{
    $size = strlen($str);
    $LongestLength = 0;
    for ($i = 0; $i < $size; $i++) {
        $sliceString = substr($str, $i);
        $subString = findsSubstring($sliceString);
        $sizeSubstring = strlen($subString);
        if ($sizeSubstring > $LongestLength) {
            $LongestLength = $sizeSubstring;
        }
    }
    return $LongestLength;
}