<?php

namespace Hexlet\Php;

<?php

namespace App\Solution;

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
