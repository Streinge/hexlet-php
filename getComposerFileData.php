<?php

function getComposerFileData()
{
    $result = [
        "autoload" => [
            "files" => [
                "src/Arrays.php"
            ]
        ],
        "config" => [
            "vendor-dir" => "/composer/vendor"
        ]
    ];
    return $result;
}
