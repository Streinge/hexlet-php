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
    if ($children === []) {
        return [];
    }


    // 3. Для каждого дитя из списка
    $result = array_reduce($children, function ($acc, $child) use ($list) {
        // 4. Берем значение $list по ключу $child и записываем в аккум
        // имя родителя и рекурсивно запускаем нашу функцию для обработки детей

        $parent = $list[$child][0];
        echo "Это parent  \n";
        print_r($parent);
        echo "\n";
        $kids = $list[$child][1] ?? [];
        echo "Это kids  \n";
        print_r($kids);
        echo "\n";
        $acc[] = [$parent, [reverseСonversionChild($kids, $list)]];

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

    return;
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
