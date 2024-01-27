<?php

namespace Hexlet\Php\BuildDefinitionList;

function buildDefinitionList(array $definitions): string
{
    if (empty($definitions)) {
        return '';
    }
    $result = [];
    foreach ($definitions as $def) {
        $result[] = "<dt>{$def[0]}</dt>";
        $result[] = "<dd>{$def[1]}</dd>";
    }
    $innerValue = implode('', $result);
    $result = "<dl>{$innerValue}</dl>";
    return $result;

}
$definitions1 = [
    ['key', 'value'],
    ['key2', 'value2'],
  ];
 
print_r(buildDefinitionList($definitions1));
