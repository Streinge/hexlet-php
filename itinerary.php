<?php

namespace Hexlet\Php;

function makeFlattenTree($tree, &$flattenList, $parent = null)
{
    if (!array_key_exists('1', $tree)) {
        $branches = [];
    } else {
        [, $branches] = $tree;
    }
    [$nameCity] = $tree;

    $children = [];

    foreach ($branches as $town) {
        $children[] = makeFlattenTree($town, $flattenList, $nameCity);
    }
    $flattenList[$nameCity] = [$parent, $children];

    return $nameCity;
}

function findArrayParents($flat, $city, $arrayParents = [])
{
    $parent = $flat[$city][0];
    if (empty($parent)) {
        return $arrayParents;
    } else {
        $arrayParents[] = $parent;
        return findArrayParents($flat, $parent, $arrayParents);
    }
}


function itinerary($tree, $startCity, $finishCity)
{
    $flat = [];
    makeFlattenTree($tree, $flat);
    print_r($flat);
    if ($flat[$finishCity][0] === $startCity) {
        return [$startCity, $finishCity];
    }

    $arrParentsStart = findArrayParents($flat, $startCity);
    $arrParentsFinish = findArrayParents($flat, $finishCity);

    if (empty($arrParentsFinish)) {
        $result[] = $startCity;
        return [...$result, ...$arrParentsStart];
    }

    foreach ($arrParentsStart as $start) {
        if (in_array($start, $arrParentsFinish)) {
            $indexStart = array_search($start, $arrParentsStart);
            $indexFinish = array_search($start, $arrParentsFinish);
            $first[] = $startCity;
            $second[] = $finishCity;
            $first = [...$first, ...array_slice($arrParentsStart, 0, $indexStart + 1)];
            $second = array_reverse([...$second, ...array_slice($arrParentsFinish, 0, $indexFinish)]);
            return [...$first, ...$second];
        }
    }
}

$tree = ['Moscow', [
                   ['Smolensk'],
                   ['Yaroslavl'],
                   ['Voronezh', [
                                ['Liski'],
                                ['Boguchar'],
                                ['Kursk', [
                                          ['Belgorod', [
                                                       ['Borisovka'],
                                                       ]
                                          ],
                                          ['Kurchatov'],
                                          ]
                                ],
                                ]
                                ],
                    ['Ivanovo', [
                                ['Kostroma'],
                                ['Kineshma'],
                                ]
                                ],
                    ['Vladimir'],
                    ['Tver', [
                             ['Klin'],
                             ['Dubna'],
                             ['Rzhev'],
                   ]],
  ]];


//print_r(itinerary($tree, 'Dubna', 'Kostroma'));
// ['Dubna', 'Tver', 'Moscow', 'Ivanovo', 'Kostroma']
//print_r(itinerary($tree, 'Borisovka', 'Kurchatov'));
//$route2 = ['Borisovka', 'Belgorod', 'Kursk', 'Kurchatov'];
//print_r(itinerary($tree, 'Rzhev', 'Moscow'));
//        $route3 = ['Rzhev', 'Tver', 'Moscow'];
//print_r(itinerary($tree, 'Ivanovo', 'Kursk'));
// $route4 = ['Ivanovo', 'Moscow', 'Voronezh', 'Kursk'];
print_r(itinerary($tree, 'Rzhev', 'Borisovka'));
// $route5 = ['Rzhev', 'Tver', 'Moscow', 'Voronezh', 'Kursk', 'Belgorod', 'Borisovka'];
//print_r(itinerary($tree, 'Tver', 'Dubna'));
//$route6 = ['Tver', 'Dubna'];
