<?php

namespace Hexlet\Php;

class Rational
{
    public $numer;
    public $denom;

    public function __construct($numer, $denom)
    {
        $this->numer = $numer;
        $this->denom = $denom;
    }

    public function getNumer()
    {
        return $this->numer;
    }

    public function getDenom()
    {
        return $this->denom;
    }

    public function add(Rational $number)
    {
        $numer1 = $this->getNumer();
        $denom1 = $this->getDenom();
        $numer2 = $number->getNumer();
        $denom2 = $number->getDenom();
        $newNumer = (int) ($numer1 * $denom2 + $numer2 * $denom1);
        $newDenom = (int) ($denom1 * $denom2);
        return new Rational($newNumer, $newDenom);
    }

    public function sub(Rational $number)
    {
        $numer1 = $this->getNumer();
        $denom1 = $this->getDenom();
        $numer2 = $number->getNumer();
        $denom2 = $number->getDenom();
        $newNumer = (int) ($numer1 * $denom2 - $numer2 * $denom1);
        $newDenom = (int) ($denom1 * $denom2);
        return new Rational($newNumer, $newDenom);
    }
}

$rat1 = new Rational(3, 9);
var_dump($rat1->getNumer()); // 3
var_dump($rat1->getDenom()); // 9

$rat2 = new Rational(10, 3);

$rat3 = $rat1->add($rat2); // Абстракция для рационального числа 99/27
var_dump($rat3->getNumer()); // 99
var_dump($rat3->getDenom()); // 27

$rat4 = $rat1->sub($rat2); // Абстракция для рационального числа -81/27
var_dump($rat4->getNumer()); // -81
var_dump($rat4->getDenom()); // 27
