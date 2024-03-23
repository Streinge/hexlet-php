<?php

namespace Hexlet\Php;

class User
{
    public $id;
    public $name;
}

function areUsersEqual($user1, $user2)
{
    return $user1->id === $user2->id;
}