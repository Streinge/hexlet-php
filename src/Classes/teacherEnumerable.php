<?php

// Здесь в решении учителя вывод all cделан с функцией мемоизацией
// то есть сохранение результатов вызовов функций для их повторного использования 
// при повторных вызовах - это позволяет оптимизировать по скорости работу

namespace App;

// BEGIN
class Enumerable implements EnumerableInterface
{
    private $elements;
    private $whereParts;

    public static function wrap($elements)
    {
        return new self($elements);
    }

    private function __construct($elements, $whereParts = [])
    {
        $this->elements = $elements;
        $this->whereParts = $whereParts;
    }

    public function where($key, $value)
    {
        $newWhereParts = array_merge($this->whereParts, [$key => $value]);
        return new self($this->elements, $newWhereParts);
    }

    public function all()
    {
        // use memo for avoiding recalculations
        $result = array_filter($this->elements, function ($element) {
            $intersection = array_intersect($element, $this->whereParts);
            return $intersection === $this->whereParts;
        });
        return array_values($result);
    }
}
// END