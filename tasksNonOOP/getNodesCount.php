<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;

// В реализации используем рекурсивный процесс,
// чтобы добраться до самого дна дерева.
function getNodesCount($tree)
{
    echo "ЗАХОДИТ В getNodesCount\n";
    if (isFile($tree)) {
    // Возвращаем 1, для учета текущего файла
    echo "ВОЗВРАЩАЕМ 1\n";
    return 1;
  }

  // Если узел — директория, получаем его детей
  $children = getChildren($tree);
  // Самая сложная часть
  // Считаем количество потомков для каждого из детей,
  // вызывая рекурсивно нашу функцию getNodesCount
  echo "ЗАХОДИТ В ARRAY_MAP\n";
  $descendantsCount = array_map(function ($child) {
      echo "ЭТО CHILD\n"; 
      print_r(getName($child));
      echo "\n";
      return getNodesCount($child);
  }, $children);
  echo "ВЫХОДИТ ИЗ ARRAY_MAP\n";
  echo "А это descendantsCount\n";
  print_r($descendantsCount);
  // Возвращаем 1 (текущая директория) + общее количество потомков
  echo "А ЭТО ВОЗВРАЩАЕТСЯ\n";
  echo (1 + array_sum($descendantsCount)) . "\n";
  return 1 + array_sum($descendantsCount);
}

$tree = mkdir('/', [
                   mkdir('etc', [
                                mkfile('bashrc'),
                                mkfile('consul.cfg'),
                                ]),
                   mkfile('hexletrc'),
                   mkdir('bin', [
                                mkfile('ls'),
                                mkfile('cat'),
                                ]),
                   ]);

print_r(getNodesCount($tree));
