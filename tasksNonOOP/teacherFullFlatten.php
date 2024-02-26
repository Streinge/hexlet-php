<?php

namespace Hexlet\Php;

// BEGIN
function flatten($tree)
{
    return array_reduce(
        $tree,
        fn($acc, $element) =>
            is_array($element)
                ? [...$acc, ...flatten($element)]
                : [...$acc, $element],
        [],
    );
}
