<?php

namespace Hexlet\Php;

function hexToRgb(string $data): array
{
    $hexColor = substr($data, 1);
    $valueRed = hexdec(substr($hexColor, 0, 2));
    $valueGreen = hexdec(substr($hexColor, 2, 2));
    $valueBlue = hexdec(substr($hexColor, 4, 2));
    return ['r' => $valueRed, 'g' => $valueGreen, 'b' => $valueBlue];
}

function rgbToHex(int $redValue, $greenValue, $blueValue) {
    $hexRed = dechex($redValue);
    $hexGreen = dechex($greenValue);
    $hexBlue = dechex($blueValue);
    $hexRed = (strlen($hexRed) === 1) ? "0{$hexRed}" : $hexRed;
    $hexGreen = (strlen($hexGreen) === 1) ? "0{$hexGreen}" : $hexGreen;
    $hexBlue = (strlen($hexBlue) === 1) ? "0{$hexBlue}" : $hexBlue;
    $result = "#{$hexRed}{$hexGreen}{$hexBlue}";
    return $result;
}

var_dump(hexToRgb('#24ab00'));

var_dump(rgbToHex(0, 132, 12));
//'#00840c', 0, 132, 12

