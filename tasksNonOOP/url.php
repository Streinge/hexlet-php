<?php

namespace Hexlet\Php;

function make(string $url)
{
    return parse_url($url);
}

function getScheme($data)
{
    return $data['scheme'];
}

function setScheme(array &$data, $scheme)
{
    $data['scheme'] = $scheme;
    return true;
}

function getHost($data)
{
    return $data['host'];
}

function setHost(array &$data, $scheme)
{
    $data['host'] = $scheme;
    return true;
}

function getPath($data)
{
    return $data['path'];
}

function setPath(array &$data, $scheme)
{
    $data['path'] = $scheme;
    return true;
}
function getQueryParam($data, $paramName, $default = null)
{
    $result = [];
    parse_str($data['query'], $result);
    return $result[$paramName] ?? $default;
}

function setQueryParam(&$data, $key, $value)
{
    $result = [];
    parse_str($data['query'], $result);
    $result[$key] = $value;
    $data['query'] = http_build_query($result);
    return true;
}

function toString($url)
{
    $scheme = $url['scheme'];
    $host = $url['host'];
    $path = $url['path'] ?? '';
    $query = $url['query'] ?? '';
    $question = ($query !== '') ? '?' : '';
    return "{$scheme}://{$host}{$path}{$question}{$query}";
}
$url1 = 'https://hexlet.io/community?q=low&page=5';
$url = make($url1);
var_dump($url);
setScheme($url, 'http');
var_dump(toString($url)); // 'http://hexlet.io/community?q=low'
var_dump(getHost($url));
setHost($url, 'www.yandex.ru');
var_dump(toString($url));
var_dump(getPath($url));
setPath($url, '/404');
var_dump(toString($url));
var_dump(getQueryParam($url, 'q'));
setQueryParam($url, 'q', 'high');
var_dump(toString($url));
setQueryParam($url, 'text', '0');
var_dump(toString($url));
setQueryParam($url, 'page', '4');
var_dump(toString($url));