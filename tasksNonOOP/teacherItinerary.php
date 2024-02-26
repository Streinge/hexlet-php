<?php

namespace Hexlet\Php;

// BEGIN
function makeJoins($tree, $acc, $parent)
// функция создает структуру дерева с использованием списка
// но без использования цикла, как у меня
{
    // название листа
    $leaf = $tree[0];
    // изящая проверка существования ключа, взамен громоздкой 
    // как у меня, если ключа нет то присваивается null
    // я присваивал пустой список, потому что c null
    // в дальнейшем выдавало ошибку
    $children = $tree[1] ?? null;
    
    // если детей нет, то сразу добавляет в $acc лист, у которого
    // детей вообще нет ни в каком виде ни null, ни список
    // и возвращает $acc
    if (!$children) {
        $acc[$leaf] = [$parent];
        return $acc;
    }
    
    // здесь создается массив соседей, то есть всех детей первого уровня
    // просто массив названий городов
    $neighbors = array_map(fn($child) => $child[0], $children);
    echo "Город = " . $leaf . "\n";
    // и зачем в массив соседей добавляется имя родителя
    $neighbors[] = $parent;

    // здесь собирается уже массив с ключами названий городови и списком соседей
    // где родитель записан последним элементом

    $newAcc = array_merge($acc, [$leaf => $neighbors]);
    
    // рекурсивно вызывается makeJoin если дети существуют существуют
    return array_reduce($children, fn($iAcc, $child) => makeJoins($child, $iAcc, $leaf), $newAcc);
}

function findRoute($start, $finish, $joins)
{
    // анонимная функция принимающая на входе название города и массив маршрута
    $iter = function ($current, $route) use (&$iter, $finish, $joins) {
        // здесь начинается анонимная функция которая будет вызываться рекурсивно
        // формируется текущий маршрут, как слияние старого маршрута с текущим городом
        echo "Вывожу current\n";
        print_r($current . "\n");

        $routeToCurrent = array_merge($route, [$current]);
        echo "Вывожу текущий маршрут\n";
        print_r($routeToCurrent);
        echo "\n";
        // если текущий город равен конечному то возвращется текущий маршрут
        if ($current === $finish) {
            return $routeToCurrent;
        }
        
        // берется список соседей (там еще включен родитель) текущего города, 
        // начинается все с города отправления , если соседей нет
        // то присваивается пустой массив
        $neighbors = $joins[$current] ?? [];
        echo "Вывожу СОСЕДЕЙ\n";
        print_r($neighbors);
        echo "\n";

        // здесь проверяются города из соседей на НЕвхождение в массив текущего маршрута
        // если сосед не входим в маршрут, то он записывается в отфильтрованный маршрут
        $filtered = array_filter($neighbors, fn($neighbor) => !in_array($neighbor, $routeToCurrent));
        echo "Печатаем filtered\n";
        print_r($filtered);
        // и здесь по отфильтрованному массиву происходит рекурсивный вызов iter уже по интересующему соседу
        // 
        return array_reduce(
            $filtered,
            fn($acc, $neighbor) => array_merge($acc, $iter($neighbor, $routeToCurrent)),
            []
        );
    };

    return $iter($start, []);
}

function itinerary($tree, $start, $finish)
{
    // создается новая структура дерева в виде связанных списков
    $joins = makeJoins($tree, [], '');
    //  вызывается функция по этому дереву
    return findRoute($start, $finish, $joins);
}
// END

$tree = ['Moscow', [
    ['Smolensk'],
    ['Yaroslavl'],
    ['Voronezh', [
                 ['Liski'],
                 ['Boguchar'],
                 ['Kursk', [
                           ['Belgorod', [
                                        ['Borisovka'],
                                        ]
                           ],
                           ['Kurchatov'],
                           ]
                 ],
                 ]
                 ],
     ['Ivanovo', [
                 ['Kostroma'],
                 ['Kineshma'],
                 ]
                 ],
     ['Vladimir'],
     ['Tver', [
              ['Klin'],
              ['Dubna'],
              ['Rzhev'],
    ]],
]];

print_r(itinerary($tree, 'Rzhev', 'Borisovka'));
// $route5 = ['Rzhev', 'Tver', 'Moscow', 'Voronezh', 'Kursk', 'Belgorod', 'Borisovka'];