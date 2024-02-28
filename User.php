<?php

namespace Hexlet\Php;

require_once 'ComparableInterface.php';

// BEGIN (write your solution here)
use Hexlet\Php\ComparableInterface;

class User implements ComparableInterface
{
    private $id;
    private $name;

    // Интерфейсные функции

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Не интерфейсные функции

    public function __toString()
    {
        return "({$this->getId()}, {$this->getName()})";
    }

    public function compareTo(ComparableInterface $user)
    {
        return $this->getId() === $user->getId();
    }
}
// END
$user1 = new User(4, 'tolya');
$user2 = new User(1, 'petya');

var_dump($user1->compareTo($user2)); // false