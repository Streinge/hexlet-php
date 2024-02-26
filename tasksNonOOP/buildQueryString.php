<?php

namespace Hexlet\Php;

function buildQueryString(array $params): string
{
    $copyParams = $params;
    ksort($copyParams);
    $result = '';
    foreach ($copyParams as $key => $value) {
        $result .= "{$key}={$value}&";
    }
    $result = substr($result, 0, strlen($result) - 1);
    return $result;
}
