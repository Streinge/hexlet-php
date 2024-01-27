<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;

function dfs($tree)
{
  // Распечатываем содержимое узла
  echo getName($tree) . "\n";
  // Если это файл, то возвращаем управление
  if (isFile($tree)) {
      return;
  }

  // Получаем детей
  $children = getChildren($tree);

  // Применяем функцию dfs ко всем дочерним элементам
  // Множество рекурсивных вызовов в рамках одного вызова функции
  // называется древовидной рекурсией
  array_map(fn($child) => dfs($child), $children);
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

dfs($tree);
