<?php

namespace App\Arrays;

use function Functional\{
    reduce_left,
    map,
};

// BEGIN
function duplicateEach(array $items)
{
    return reduce_left(
        map($items, fn($item) => [$item, $item]),
        function ($value, $index, $coll, $acc) {
            return [...$acc, ...$value];
        },
        []
    );
}

function enlargeArrayImage($matrix)
{
    $horizontallyStretched = map($matrix, fn($col) => duplicateEach($col));
    return duplicateEach($horizontallyStretched);
}
// END