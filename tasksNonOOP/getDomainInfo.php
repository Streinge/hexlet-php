<?php

namespace Hexlet\Php;

function getDomainInfo(string $url): array
{
    $pathParts = explode('/', $url);
    if (count($pathParts) === 1) {
        $scheme = 'http';
    } else {
        $scheme = substr($pathParts[array_key_first($pathParts)], 0, -1);
    }
    $name = $pathParts[array_key_last($pathParts)];
    $domainInfo = ['scheme' => $scheme, 'name' => $name];
    return $domainInfo;
}

var_dump(getDomainInfo('https://hexlet.io'));
