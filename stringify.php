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
$exeptedNestedResult = [
    '  common' => [
                '+ follow' => false,
                '  setting1' => 'Value 1',
                '- setting2' => 200,
                '- setting3' => true,
                '+ setting3' => null,
                '+ setting4' => 'blah blah',
                '+ setting5' => [
                               '  key5' =>  'value5'
                                ],
                '  setting6' => [
                              '  doge' => [
                                        '- wow' => '',
                                        '+ wow' => 'so much'
                                        ],
                              '  key' => 'value',
                              '+ ops' => 'vops'
                                ]
                ],
     '  group1' => [
                   '- baz' => 'bas',
                   '+ baz' => 'bars',
                   '  foo' => 'bar',
                   '- nest' => [
                               '  key' => 'value'
                               ],
                   '+ nest' => 'str'
                   ],
     '- group2' => [
                   '  abc' => 12345,
                   '  deep' => [
                               '  id' => 45
                               ]
                   ],
     '+ group3' => [
                   '  deep' => [
                             '  id' => [
                                     '  number' => 45
                                     ]
                             ],
                   ' fee' => 100500
                   ]
       ];
print_r(stringify($exeptedNestedResult, '/', 2));
