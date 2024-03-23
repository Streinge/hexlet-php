<?php

namespace Hexlet\Php;

class Truncater
{
    private const OPTIONS = [
        'separator' => '...',
        'length' => 200,
    ];

    private $options;

    public function __construct(array $options = [])
    {
        $this->options = array_merge(self::OPTIONS, $options);
    }

    public function truncate(string $textNew, array $options = [])
    {
        $newOptions = array_merge($this->options, $options);
        $separator = $newOptions['separator'];
        $newLength = $newOptions['length'];
        $part = mb_substr($textNew, 0, $newLength);
        return (mb_strlen($part) < mb_strlen($textNew)) ? "{$part}{$separator}" : $textNew;
    }
}

$truncater = new Truncater();

$actual = $truncater->truncate('one two');
var_dump('one two' === $actual); //true

$actual = $truncater->truncate('one two', ['length' => 6]);
var_dump('one tw...' === $actual); // true

$actual = $truncater->truncate('one two', ['separator' => '.']);
var_dump('one two' === $actual); // true

$actual = $truncater->truncate('one two', ['length' => '3']);
var_dump('one...' === $actual); //true
