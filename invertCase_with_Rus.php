<?php
function invertCase($text)
// Здесь используются методы для работы
// с русским языком и переводом кодировки в UTF-8
{
    // BEGIN (write your solution here)
    $sum = '';
    // функция mb_convert_encoding переводит кодировку в требуюмую
    $text = mb_convert_encoding($text, "UTF-8");
    for ($i = 0; $i < mb_strlen($text); $i += 1){
        $char = mb_substr($text, $i, 1);
        if ($char === mb_strtolower($char)){
            $result = mb_strtoupper($char);
            $sum = "{$sum}{$result}";
        } else {
            $result = mb_strtolower($char);
            $sum = "{$sum}{$result}";
        }
    }
    return $sum;
    // END
}


// mb_strtolower(string $string, ?string $encoding = null)
$str = "ПрИвЕт!";
print_r(invertCase($str));
