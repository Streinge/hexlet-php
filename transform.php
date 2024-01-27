<?php

namespace Hexlet\Php;

function makeFlattenTree($tree, $flattenList, $parent = null)
{
    [$nameCity] = $tree;

    $branches = $tree[1] ?? [];

    if ($branches === []) {
        $flattenList[$nameCity] = [$parent];
        return $flattenList;
    }

    $children = array_map(fn($child) => $child[0], $branches);

    $newAcc = array_merge($flattenList, [$nameCity => [$parent, $children]]);

    return array_reduce($branches, fn($iAcc, $child) => makeFlattenTree($child, $iAcc, $nameCity), $newAcc);
}

function reverseСonversionChild($children, $list)
{
    // здесь $children это массив названий узлов массива $list
    // 5. если у ребенка нет детей то есть массив пустой
    // то возвращаем пустой массив
    echo "Это children на входе в функцию \n";
    print_r($children);
    echo "\n";


    // 3. Для каждого дитя из списка
    $result = array_reduce($children, function ($acc, $child) use ($list) {
        // 4. Берем значение $list по ключу $child и записываем в аккум
        // имя родителя и рекурсивно запускаем нашу функцию для обработки детей
        echo "Это child  \n";
        print_r($child);
        echo "\n";
        $parent = $list[$child][0];
        echo "Это parent  \n";
        print_r($parent);
        echo "\n";
        $kids = $list[$child][1] ?? [];
        echo "Это kids  \n";
        print_r($kids);
        echo "\n";
        if ($kids === []) {
            $acc[] = [$child];
        } else {
            $acc[] = [$child, [...reverseСonversionChild($kids, $list)]];
        }
        echo "Это АККУМУЛЯТОР  \n";
        print_r($acc);
        echo "\n";
        return $acc;
    }, []);

    return $result;
}

function transform($tree, $node)
{
    $list = makeFlattenTree($tree, [], null);
    // 1. находим элемент $list c ключом $node и берем значение родителя и детей
    [$parent, $children] = $list[$node];
    // 2. для каждого списка детей запускаем рекурсивную функцию передаем в нее список названий узлов
    $newChildren = reverseСonversionChild($children, $list);

    return $newChildren;
}

$tree = ['A', [                              //     A
              ['B', [                        //    / \
                    ['D', [                  //   B   C
                          ['G'],            //   /   / \
                          ['I'],           //   D   E   F
                          ]              //    / \        
                    ]],                 //    G   I 
              ['C', [                       
                    ['E'],             
                    ['F'],               
                    ]],
               ]]
        ];


print_r(transform($tree, 'B'));
