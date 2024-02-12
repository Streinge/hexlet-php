<?php

require_once __DIR__ . '/vendor/autoload.php';

$a = ['I' => [null, ['A']], 'A' => ['I', ['B']], 'B' => ['A', ['C', 'H']], 'C' => ['B'], 'H' => ['B']];
$b = ['I', 'F', 'A', 'K'];

$x = array_shift($a);

// добавление нового продукта
$sURL = "https://dummyjson.com/products/add";
$sPD = json_decode('{ "title":"BMW Pencil", 
    "description":"Attractive DesignMetallic",
    "price":30,
    "discountPercentage":2.92,
    "rating":4.92,
    "stock":54,
    "brand":"Golden"}');

$aHTTP = array(
    'http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type:application/json',
            'content' => $sPD
             )
            );
$context = stream_context_create($aHTTP);
$contents = file_get_contents($sURL, false, $context);

echo $contents;

// поиск по категориям
$group = 'products';
//$group = 'users';
//$group = 'posts';
//$group = 'recipes';

$sURL = "https://dummyjson.com/{$group}/search?q=Iphone";
$contents1 = file_get_contents($sURL);
echo $contents1;
