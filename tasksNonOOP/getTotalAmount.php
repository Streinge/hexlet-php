<?php

namespace Hexlet\Php\GetTotalAmount;

function getTotalAmount(array $money, string $currency): int
{
    $sum = 0;
    foreach ($money as $bill) {
        $curr = substr($bill, 0, 3);
        $value = (int) substr($bill, 3);
        if ($curr !== $currency) {
        continue;
        }
        $sum += $value;
    }
    return $sum;
}

$money1 = ['eur 10', 'usd 1', 'usd 10', 'rub 50', 'usd 5'];
echo getTotalAmount($money1, 'usd') . "\n"; // 16
 
$money2 = ['eur 10', 'usd 1', 'eur 5', 'rub 100', 'eur 20', 'eur 100', 'rub 200'];
echo getTotalAmount($money2, 'eur') . "\n"; // 135
 
$money3 = ['eur 10', 'rub 50', 'eur 5', 'rub 10', 'rub 10', 'eur 100', 'rub 200'];
echo getTotalAmount($money3, 'rub') . "\n"; // 270