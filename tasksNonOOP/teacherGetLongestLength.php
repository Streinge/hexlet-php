<?php

namespace Hexlet\Php\GetLongestLength;

// BEGIN
function getLongestLength(string $str)
{
    $sequence = [];
    $maxLength = 0;

    // Проходимся по всем символам переданной строки.
    for ($i = 0; $i < strlen($str); $i += 1) {
        $char = $str[$i];
        // Ищем в сформированной последовательности
        // позицию первого вхождения текущего символа.
        $index = array_search($char, $sequence);
        var_dump($index);
        // Добавляем в последовательность текущий символ.
        $sequence[] = $char;
        var_dump($sequence);
        if ($index !== false) {
            // Если символ в последовательности был найден,
            // значит в неё был добавлен повторяющийся символ.
            // Отсекаем все символы, включая найденный.
            $sequence = array_slice($sequence, $index + 1);
        }
        // Получаем длину последовательности.
        $sequenceLength = count($sequence);
        if ($sequenceLength > $maxLength) {
            // Если длина последовательности больше чем максимальная,
            // устанавливаем новую максимальную длину.
            $maxLength = $sequenceLength;
        }
    }

    return $maxLength;
}
// END


$str = 'j12j23j754';
echo "Наибольшая длина = " . getLongestLength($str) . "\n";
