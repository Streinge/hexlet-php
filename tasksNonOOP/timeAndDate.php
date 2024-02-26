<?php
function getCustomDate($time)
// Возвращает время по заданному timestamp
{
    return date('d/m/Y', $time);
}
echo getCustomDate(1532435204);
echo "\n";
// функция timye() определяет текущий timestamp
$currient_time = time();
echo getCustomDate($currient_time);

