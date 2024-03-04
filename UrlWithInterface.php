<?php

namespace Hexlet\Php;

require_once 'UrlInterface.php';

use Hexlet\Php\UrlInterface;

class Url implements UrlInterface
{
    public $url;

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
    public function getHost()
    {
        return parse_url($this->url, PHP_URL_HOST);
    }
}

$url = new Url('http://yandex.ru?key=value&key2=value2');
var_dump($url->getScheme()); // http
var_dump($url->getHost()); // yandex.ru
var_dump($url->getQueryParams());
// [
//     'key' => 'value',
//     'key2' => 'value2'
// ];
var_dump($url->getQueryParam('key')); // value
// второй параметр - значение по умолчанию
var_dump($url->getQueryParam('key2', 'lala')); // value2
var_dump($url->getQueryParam('new', 'ehu')); // ehu
