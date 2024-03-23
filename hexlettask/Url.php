<?php

namespace Hexlet\Php;

class Url
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }
    public function getScheme()
    {
        return parse_url($this->url, PHP_URL_SCHEME);
    }

    public function getQueryParams()
    {
        $str = parse_url($this->url, PHP_URL_QUERY);
        parse_str($str, $queryArray);
        return $queryArray;
    }

    public function getQueryParam($key, $defaultValue = null)
    {
        $queryArr = $this->getQueryParams();

        return $queryArr[$key] ?? $defaultValue;
    }
    public function getHostName()
    {
        return parse_url($this->url, PHP_URL_HOST);
    }

    public function equals(Url $url)
    {
        return $this->url === $url->url;
    }
}

$url = new Url('http://yandex.ru:80?key=value&key2=value2');
var_dump($url->getScheme()); // 'http'
var_dump($url->getHostName()); // 'yandex.ru'
var_dump($url->getQueryParams());
// [
//     'key' => 'value',
//     'key2' => 'value2',
// ];
var_dump($url->getQueryParam('key')); // 'value'
// второй параметр - значение по умолчанию
var_dump($url->getQueryParam('key2', 'lala')); // 'value2'
var_dump($url->getQueryParam('new', 'ehu')); // 'ehu'
var_dump($url->getQueryParam('new')); // null
var_dump($url->equals(new Url('http://yandex.ru:80?key=value&key2=value2'))); // true
var_dump($url->equals(new Url('http://yandex.ru:80?key=value'))); // false
