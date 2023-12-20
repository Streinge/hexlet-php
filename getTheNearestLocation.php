<?php

namespace Hexlet\Php\GetTheNearestLocation;
function getDistance(array $point1, array $point2)
{
    [$x1, $y1] = $point1;
    [$x2, $y2] = $point2;

    $xs = $x2 - $x1;
    $ys = $y2 - $y1;

    return sqrt($xs ** 2 + $ys ** 2);
}

function getTheNearestLocation(array $locations, array $point)
{
    if ($locations === []) {
        return null;
    }
    $min_location = [];
    $min_distance = null;
    foreach ($locations as [$name, $point_test]) {
        $test_distance = getDistance($point, $point_test);
        if ($min_location === [] || $test_distance < $min_distance) {
            $min_location = [$name, $point_test];
            $min_distance = $test_distance;
        }
    }
    return $min_location;
}
$locations = [
    ['Park', [10, 5]],
    ['Sea', [1, 3]],
    ['Museum', [8, 4]],
  ];
   
  $point = [5, 5];
   
  // Если точек нет, то возвращается null
  var_dump(getTheNearestLocation([], $point)); // null
   
  var_dump(getTheNearestLocation($locations, $point)); // ['Museum', [8, 4]]
  