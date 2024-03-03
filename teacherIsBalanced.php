<?php

namespace App;

// это решение учителя проверка сбалансированного дерева
// для этого по условиям задачи количество узлов левого и правого
// поддерева должно отличаться не более чем на 2
class Node
{
    private $key;
    private $left;
    private $right;

    public function __construct($key = null, $left = null, $right = null)
    {
        $this->key = $key;
        $this->left = $left;
        $this->right = $right;
    }

    // BEGIN
    // задается пороговое значение по умолчаню равное 2, как надо по условию задачи
    public function measure($threshold = 2)
    {
        var_dump($this->key);
        // ecли узел существует (то есть не null) то к нему применяется рекурсивно функция measure
        // если не существует, то возвращается массив что баланс true, а счетчик ноль
        $delegateTo = function ($node) use ($threshold) {
            var_dump($node->key);
            var_dump($node);
            return $node ? $node->measure($threshold) : ['balanced' => true, 'count' => 0];
        };
        
        //Здесь запускается функция delegateTo для левого и правого узла
        ['balanced' => $balanceLeft, 'count' => $countLeft] = $delegateTo($this->left);
        ['balanced' => $balanceRight, 'count' => $countRight] = $delegateTo($this->right);

        $balanced = $balanceLeft && $balanceRight && abs($countLeft - $countRight) <= $threshold;
        $count = $countLeft + $countRight + 1;

        return ['balanced' => $balanced, 'count' => $count];
    }

    public function isBalanced()
    {
        // это такой способ получить первый элемент массива
        // потому что функция mesure возвращает массив из двух элементов
        // первое из которых это логическое значение сбалансированности
        ['balanced'  => $balanced] = $this->measure(); // запускается функция
        var_dump($this->measure());
        return $balanced;
    }
    // END

    
}

$tree = new Node(
    8,
    new Node(
        5,
        new Node(
            4,
            new Node(1),
            new Node(
                3,
                new Node(2)
            )
        ),
        new Node(6)
    ),
    new Node(
        12,
        new Node(
            10,
            null,
            new Node(11)
        ),
        new Node(14)
    )
);

var_dump($tree->isBalanced());