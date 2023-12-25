<?php

namespace Hexlet\Php\CompareVersion;

function compareVersion(string $version1, string $version2)
{
    $version1 = explode(".", $version1);
    $version2 = explode(".", $version2);
    return ($version1 <=> $version2);
}

var_dump(compareVersion("4.2", "4.2"));
