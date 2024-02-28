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
        return $this->listAdresses[] = $address;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddresses()
    {
        return $this->listAdresses;
    }
}

$user = new User('Ivan');
//var_dump('Ivan' === $user->getName());

$address = new Address('Russia', 'Moscow', 'Lenina');

$user->addAddress($address);

$user2 = new User('Mila');
$user2->addAddress($address);

//var_dump($user->getAddresses() == $user2->getAddresses());

//var_dump($user->getAddresses() == [$address]);

$address->setCountry('USA');

//var_dump($user->getAddresses() == $user2->getAddresses());

$address2 = new Address('Russia', 'Omsk', 'Belinskigo');
$user->addAddress($address2);
//var_dump(is_array($user->getAddresses()));
//var_dump(count($user->getAddresses()) === 2);
var_dump(count($user->getAddresses()));
//var_dump($user->getAddresses() == [$address, $address2]);