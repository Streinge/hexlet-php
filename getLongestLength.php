<?php

namespace Hexlet\Php\GetLongestLength;

function findsSubstring(string $str): string
<<<<<<< Updated upstream
{
    echo "Строка ". $str . "\n";
    if (strlen($str) === 1) {
=======
// функция ищет подстроку с уникальными символами
{
    $size = strlen($str);
    if ($size === 1 || empty($str)) {
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
    if (strlen($str) === 1) {
        return $str;
    }
    $lengthString = strlen($str);
    for ($i = 0; $i < $lengthString; $i++) {
        // echo "i = ". $i . "\n";
        $firstChar = $str[$i];
        // echo "firstChar = ". $firstChar . "\n";
        $sliceStr = substr($str, $i + 1);
        // echo "sliceStr = ". $sliceStr . "\n";
        $lengthSlice = strlen($sliceStr);
        $uniqueString = $firstChar;
        for ($j = 0; $j < $lengthSlice; $j++) {
            if ($sliceStr[$j] !== $firstChar) {
                $uniqueString .= "$sliceStr[$j]";
            } else {
                break;
            }
        }
        echo getLongestLength($uniqueString) . "\n";
    }
}
$str = 'qweqrty';
echo getLongestLength($str) . "\n";
=======
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


$str = 'j12j23j754';
echo "Наибольшая длина = " . getLongestLength($str) . "\n";
>>>>>>> Stashed changes
