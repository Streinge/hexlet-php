<?php

namespace Hexlet\Php;

// наибольший общий делитель
function gcd($a, $b)
{
    return ($a % $b) ? gcd($b, $a % $b) : abs($b);
}

function makeRational(int $num, int $denom)
{
    $gsd = gcd($num, $denom);
    $normalisedDenom = $denom / $gsd;
    if ($normalisedDenom < 0) {
        $normalisedNum = -$num / $gsd;
        $normalisedDenom = -$normalisedDenom;
    } else {
        $normalisedNum = $num / $gsd;
    }

    return ['num' => $normalisedNum, 'denom' => $normalisedDenom];
}

function getNumer($rat)
{
    return $rat['num'];
}

function getDenom($rat)
{
    return $rat['denom'];
}
function add($rat1, $rat2)
{
    $num = getNumer($rat1) *  getDenom($rat2) + getNumer($rat2) * getDenom($rat1);
    $denom = getDenom($rat1) * getDenom($rat2);
    return makeRational($num, $denom);
}

function sub($rat1, $rat2)
{
    $negative = makeRational(-getNumer($rat2), getDenom($rat2));
    return add($rat1, $negative);
}

function ratToString($rat)
{
    return getNumer($rat) . '/' . getDenom($rat);
}


$rat1 = makeRational(3, 9);
echo getNumer($rat1) . "\n"; // 1
echo getDenom($rat1) . "\n"; // 3
echo ratToString($rat1) . "\n";

$rat2 = makeRational(10, 3);
$rat3 = add($rat1, $rat2);
echo RatToString($rat3) . "\n"; // 11/3

$rat4 = sub($rat1, $rat2);
echo RatToString($rat4) . "\n"; // -3/1
