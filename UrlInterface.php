<?php

namespace Hexlet\Php;

interface UrlInterface
{
    public function getScheme();
    public function getQueryParams();
    public function getQueryParam($key, $defaultValue = null);
    public function getHost();
}
