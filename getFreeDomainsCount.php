<?php

namespace Hexlet\Php;

const FREE_EMAIL_DOMAINS = [
    'gmail.com', 'yandex.ru', 'hotmail.com'
];

function getFreeDomainsCount(array $mails)
{
    $onlyDomaind = array_map(fn($mail) => substr($mail, stripos($mail, '@') + 1), $mails);
    return $onlyDomaind;
}

$emails = [
    'info@gmail.com',
    'info@yandex.ru',
    'info@hotmail.com',
    'mk@host.com',
    'support@hexlet.io',
    'key@yandex.ru',
    'sergey@gmail.com',
    'vovan@gmail.com',
    'vovan@hotmail.com'
];

var_dump(getFreeDomainsCount($emails));
