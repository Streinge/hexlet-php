<?php

namespace Hexlet\Php;


function changeClass(array $tree, string $oldClass, string $newClass)
{   
    if (array_key_exists('className', $tree) && $tree['className'] === $oldClass) {
        $tree['className'] = $newClass;
    }
    
    if (array_key_exists('children', $tree)) {
        $children = $tree['children'];
        $newChildren = array_map(fn($child) => changeClass($child, $oldClass, $newClass), $children);

        $newTree = array_reduce(array_keys($tree), function($acc, $key) use ($tree, $newChildren) {
            if ($key !== 'children') {
                $acc[$key] = $tree[$key];
            } else {
                $acc[$key] = $newChildren;
            }
            return $acc;
        }, []);
        return $newTree;
    } else {
        return $tree;
    }
}

/*$tree = [
    'name' => 'div',
    'type' => 'tag-internal',
    'className' => 'hexlet-community',
    'children' => [
        [
            'name' => 'div',
            'type' => 'tag-internal',
            'className' => 'old-class',
            'children' => [],
        ],
        [
            'name' => 'div',
            'type' => 'tag-internal',
            'className' => 'old-class',
            'children' => [],
        ],
    ],
];

$result = changeClass($tree, 'old-class', 'new-class');

print_r($result);*/
$htmlTree = [
    'name' => 'html',
    'type' => 'tag-internal',
    'children' => [
        [
            'name' => 'body',
            'type' => 'tag-internal',
            'children' => [
                [
                    'name' => 'h1',
                    'type' => 'tag-internal',
                    'children' => [
                        [
                            'name' => '',
                            'type' => 'text',
                            'content' => 'Сообщество',
                        ],
                    ],
                ],
                [
                    'name' => 'p',
                    'type' => 'tag-internal',
                    'children' => [
                        [
                            'type' => 'text',
                            'content' => 'Общение между пользователями Хекслета',
                        ],
                    ],
                ],
                [
                    'name' => 'hr',
                    'type' => 'tag-leaf',
                ],
                [
                    'name' => 'input',
                    'type' => 'tag-leaf',
                ],
                [
                    'name' => 'div',
                    'type' => 'tag-internal',
                    'className' => 'hexlet-community',
                    'children' => [
                        [
                            'name' => 'div',
                            'type' => 'tag-internal',
                            'className' => 'text-xs-center',
                            'children' => [],
                        ],
                        [
                            'name' => 'div',
                            'type' => 'tag-internal',
                            'className' => 'fa fa-spinner',
                            'children' => [],
                        ],
                    ],
                ],
            ],
        ],
    ],
];

$result = changeClass($htmlTree, 'hexlet-community', 'new-class');

print_r($result);
