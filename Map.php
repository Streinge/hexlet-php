<?php

namespace Hexlet\Php;

function make()
{
    return array();
}
function isСollision(array &$map, string $key, int $index): bool
{
    [$existKey] = $map[$index];
    if ($key !== $existKey) {
        return true;
    }
    return false;
}

function set(array &$map, string $newKey, $newValue = null)
{
    $index = crc32($newKey) % 1000;
    if (array_key_exists($index, $map)) {
        if (isСollision($map, $newKey, $index)) {
            return false;
        }
    }
    $map[$index] = [$newKey, $newValue];
    return true;
}

function get(array &$map, string $key, $defaultValue = null)
{
    $index = crc32($key) % 1000;
    if (!array_key_exists($index, $map)) {
        set($map, $key, $defaultValue);
    }
    [, $value] = $map[$index];
    return (isСollision($map, $key, $index)) ? null : $value ?? $defaultValue;
}
