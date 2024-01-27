<?php

namespace Hexlet\Php;

function filterEmpty($tree)
{
    echo "ЗАШЕЛ В ФУНКЦИЮ\n";
    echo $tree['name'] . "\n";
    // Перед фильтрацией отфильтровываем всех потомков
    $internalFiltered = array_map(function ($node) {
        echo $node['name'] . "\n";
        if ($node['type'] === 'tag-internal') {
            // Тут самый важный момент. Рекурсивно вызываем функцию фильтрации.
            // Дальнейшая работа не завершится, пока функция фильтрации не отфильтрует вложенные узлы.
            return filterEmpty($node);
        }
        return $node;
    }, $tree['children']);
    var_dump($internalFiltered);

    $result = array_filter($internalFiltered, function ($node) {
        // Каждый тип фильтруется по-своему, удобно для этого использовать switch
        switch ($node['type']) {
            case 'tag-internal':
                // К этому моменту мы уже отфильтровали пустых потомков
                // Если остались не пустые потомки, значит текущий родитель не пустой
                return count($node['children']) > 0;
            case 'tag-leaf':
                // Листовые узлы всегда выводятся
                return true;
            case 'text':
                // Для текстовых узлов просто проверяем существование контента
                return !!$node['content']; // Для однозначности приводим значение к булевому типу
        }
    });

    
    $tree['children'] = $result;
    return $tree;
}

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

filterEmpty($htmlTree);
