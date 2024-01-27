<?php

namespace Hexlet\Php;

function toString($value)
{
     return trim(var_export($value, true), "'");
}

function getsArray($incoming, &$base, $str)
{
    $result = array_reduce(array_keys($incoming), function ($acc, $key) use ($incoming, $str, $base) {
        $value = is_bool($incoming[$key]) ? toString($incoming[$key]) : $incoming[$key];
        if (!is_array($value)) {
            $acc[] = "\n{$base}{$key}: {$value}";
        } else {
            $acc[] = "\n{$base}{$key}: {";
            $base .= $str;
            $value = getsArray($value, $base, $str);
            $acc = [...$acc, ...$value];
            $base = substr($base, 0, -1 * strlen($str));
            $acc[] = "\n{$base}}";
        }
        return $acc;
    }, []);

    return $result;
}

function stringify($incoming, string $replacer = ' ', int $counter = 1)
{
    if (!is_array($incoming)) {
        return $incoming;
    }

    $base = str_repeat($replacer, $counter);
    $result =  implode('', getsArray($incoming, $base, $base));

    return "{{$result}\n}";
}


$data = [
    'string' => 'value',
    'boolean' => true,
    'number' => 5,
    'float' => 1.25,
    'object' => [
                5 => 'number',
               '1.25' => 'float',
               'null' => 'null',
               'true' => 'boolean',
              'value' => 'string',
             'nested' => [
                        'boolean' => true,
                        'float' => 1.25,
                        'string' => 'value',
                        'number' => 5,
                        'null' => 'null'
                        ]
                ]
];
print_r(stringify($data, ' ', 2));
