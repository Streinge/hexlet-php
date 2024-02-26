<?php

namespace Hexlet\Code;

require_once '/home/streinge/hexlet-php/vendor/autoload.php';

use function Functional\flatten;
# Это функция из проекта "Вычислитель отличий", которая выводит массив различий в плоском виде
# здесь два варианта функции которая, преобразовывает одинкаовые значения которые
# они называются (старая) $changedArray  и новая - $changedArrayNew.
# cтарая не проходила проверку по иммутабельности, а новая прошла

function toStringNew(mixed $value): string
{
    // эта функция делает так, чтобы true и false выводились как строка
    if ($value === '[complex value]') {
        return $value;
    } elseif (is_null($value)) {
        return 'null';
    }
    $newValue =  trim(var_export($value, true), "'");
    return is_string($value) ? "'{$newValue}'" : $newValue;
}

function plain(array $incoming): string
{
    // Здесь сразу меняю значение на [complex value] если ключи имеют знак плюс или минус
    // на первом уровне вложенности
    $changedIncoming = array_reduce(array_keys($incoming), function ($acc, $key) use ($incoming) {
        $element = [$key =>
            ($key[0] === '+' || $key[0] === '-')
            ? '[complex value]' : $incoming[$key]];
        return array_merge($acc, $element);
    }, []);

    $dfs = function ($changedIncoming, $newKeyArray = []) use (&$dfs) {
        if (!is_array($changedIncoming)) {
            return [...$newKeyArray, $changedIncoming];
        } elseif (count($changedIncoming) === 1) {
            return [...$newKeyArray, '[complex value]'];
        }


        $new = array_map(function ($key) use ($changedIncoming, $newKeyArray, &$dfs) {
            $prefix = $key[0];
            $sign = $newKeyArray[0] ?? null;
            $signStatus = ($sign === " " || $newKeyArray === []);
            $newPrefix =  $signStatus ? $prefix : $sign;
            $actualKey = substr($key, 2);
            $arrayWhithoutPrefix = ($newKeyArray !== []) ? array_slice($newKeyArray, 1) : [];
            return $dfs($changedIncoming[$key], [$newPrefix, ...$arrayWhithoutPrefix, $actualKey]);
        }, array_keys($changedIncoming));

        return $new;
    };

    $flatt = function ($needsFolded) use (&$flatt) {
        $fn = array_reduce($needsFolded, function ($acc, $item) use (&$flatt) {
            if (is_array($item) && !is_array($item[0])) {
                return array_merge($acc, [$item]);
            } else {
                return array_merge($acc, $flatt($item));
            }
        }, []);
        return $fn;
    };


    $sourceArrayNew = $flatt($dfs($changedIncoming));

    $onlyKeys = array_map(fn($value) => array_slice($value, 1, -1), $sourceArrayNew);
    $uniqueOnlyKeys = array_unique($onlyKeys, SORT_REGULAR);
    $nonUniqueKeys = array_diff_key($onlyKeys, $uniqueOnlyKeys);
    $uniqueIndexes = array_keys($uniqueOnlyKeys);

    $uniqueSourceArray = array_filter(array_map(
        function ($index) use ($sourceArrayNew, $uniqueIndexes) {
            return in_array($index, $uniqueIndexes, true) ? $sourceArrayNew[$index] : [];
        },
        array_keys($sourceArrayNew)
    ));

    $indexesNonUnique = array_keys($nonUniqueKeys);

    $firstIndexes = array_map(fn($index) => $index - 1, $indexesNonUnique);
    $changedArrayNew = array_reduce(
        array_keys($uniqueSourceArray),
        function ($acc, $index) use ($uniqueSourceArray, $sourceArrayNew, $firstIndexes) {
            if (in_array($index, $firstIndexes, true)) {
                $valueWithoutSign = array_slice($uniqueSourceArray[$index], 1);
                $lastIndex = count($sourceArrayNew[$index + 1]) - 1;
                $updatedValue = $sourceArrayNew[$index + 1][$lastIndex];
                return [...$acc, ['changed', ...$valueWithoutSign, $updatedValue]];
            } else {
                return [...$acc, $uniqueSourceArray[$index]];
            }
        },
        []
    );


    # Дальше идет старая рабочая версия
    $sourceArray = [...$flatt($dfs($changedIncoming)), []];

    $isEqualKeys = function ($old, $element) {
        $sliceOld = array_slice($old, 1, -1);
        $sliceElement = array_slice($element, 1, -1);
        return $sliceOld === $sliceElement;
    };

    $old = [];
    $changeOldToElement = function (&$old, $element) {
        $old = $element;
        return true;
    };
    # находим элементы в которых были изменения
    $changedArray = array_reduce(
        $sourceArray,
        function ($acc, $element) use (&$old, $isEqualKeys, $changeOldToElement, $sourceArray) {
        # для этого хочу сравнить элементы массивов без префикса и значения (это будущие составные ключи)
            if ($old === []) {
                $x = $changeOldToElement($old, $element);
            } else {
                # здесь если составные ключи равны
                if ($isEqualKeys($old, $element)) {
                    # здесь убираю префикс из будущего составного ключа
                    $oldWhithoutPrefix = array_slice($old, 1);
                    # и поскольку сравнение закончилось - пара найдена то начинаем поиск занова old = []
                    $x = $changeOldToElement($old, []);
                    # возвращаю массив с новым элементом массива
                    return [...$acc, ["changed", ...$oldWhithoutPrefix, $element[count($element) - 1]]];
                } else {
                    # если составные ключи не совпадают, то возвращаю элемент со старым элементом массива
                    $newOld = $old;
                    $x = $changeOldToElement($old, $element);
                    return [...$acc, $newOld];
                }
            }
            return $acc;
        },
        []
    );


    $flattenKey = function ($item, $numbersValue) {
        $sliceItem = array_slice($item, 1, (int) (- $numbersValue));
        $key = implode(".", $sliceItem);
        return "'{$key}'";
    };

    $stringArray = array_reduce($changedArrayNew, function ($acc, $item) use ($flattenKey) {
        if ($item[0] === "+") {
            $key = $flattenKey($item, 1);
            $value = toStringNew($item[count($item) - 1]);
            $acc[] = "Property {$key} was added with value: {$value}";
        } elseif (($item[0] === "-")) {
            $key = $flattenKey($item, 1);
            $acc[] = "Property {$key} was removed";
        } elseif (($item[0] === "changed")) {
            $key = $flattenKey($item, 2);
            $value1 = toStringNew($item[count($item) - 2]);
            $value2 = toStringNew($item[count($item) - 1]);
            $acc[] = "Property {$key} was updated. From {$value1} to {$value2}";
        }
        return $acc;
    }, []);

    return implode("\n", $stringArray) . "\n";
}

$exeptedNestedResult = [
    '  common' => [
                '+ follow' => false,
                '  setting1' => 'Value 1',
                '- setting2' => 200,
                '- setting3' => true,
                '+ setting3' => null,
                '+ setting4' => 'blah blah',
                '+ setting5' => [
                               '  key5' =>  'value5'
                                ],
                '  setting6' => [
                              '  doge' => [
                                        '- wow' => '',
                                        '+ wow' => 'so much'
                                        ],
                              '  key' => 'value',
                              '+ ops' => 'vops'
                                ]
                ],
     '  group1' => [
                   '- baz' => 'bas',
                   '+ baz' => 'bars',
                   '  foo' => 'bar',
                   '- nest' => [
                               '  key' => 'value'
                               ],
                   '+ nest' => 'str'
                   ],
     '- group2' => [
                   '  abc' => 12345,
                   '  deep' => [
                               '  id' => 45
                               ]
                   ],
     '+ group3' => [
                   '  deep' => [
                             '  id' => [
                                     '  number' => 45
                                     ]
                             ],
                   '  fee' => 100500
                   ]
];
print_r(plain($exeptedNestedResult));
