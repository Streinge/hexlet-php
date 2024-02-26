<?php

namespace Hexlet\Php;

const FREE_EMAIL_DOMAINS = [
    'gmail.com', 'yandex.ru', 'hotmail.com'
];

function getFreeDomainsCount(array $mails)
{
    $onlyDomains = array_map(fn($mail) => substr($mail, stripos($mail, '@') + 1), $mails);
    $freeDomains = array_filter($onlyDomains, fn($onlyDomain) => in_array($onlyDomain, FREE_EMAIL_DOMAINS));
    $numberFreeDomains = array_reduce($freeDomains, function ($acc, $domain) {
        $acc[$domain] = ($acc[$domain] ?? 0) + 1;
        return $acc;
    }, []);
    return $numberFreeDomains;
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
