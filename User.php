<?php

namespace Hexlet\Php;

require_once 'Address.php';

use Hexlet\Php\Adress;

class User
{
    private $name;
    private $listAdresses;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addAddress(Address $address)
    {
        $listAdresses[] = $address;
        return $this->$listAdresses;
    }
//getAddresses() — возвращает массив адресов пользователя.
//getName() — возвращает имя пользователя.
}

$user1 = new User('Ivan');
var_dump($user1);
$user1->addAddress(new Address(''));
