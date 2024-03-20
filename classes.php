<?php

interface Commentators
{
    public function getUsername();
    public function getEmail();
}

class Category
{
    private string $name;
    private bool $isTurnOn;

    public function __construct(string $name, bool $isTurnOn = true)
    {
        $this->name = $name;
        $this->$isTurnOn = $isTurnOn;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isTurnOn()
    {
        return $this->isTurnOn;
    }

    public function turnOn()
    {
        $this->isTurnOn = true;
    }

    public function turnOff()
    {
        $this->isTurnOn = false;
    }
}

class User implements Commentators
{
    private string $username;
    private string $email;

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

class Guest implements Commentators
{
    private string $username;
    private string $email;

    public function __construct(string $username = "", string $email = "")
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

class News
{
    private string $title;
    private User $author;
    private string $text;
    private Category $category;
    private $comments = [];

    public function __construct(string $title, User $author, string $text, Category $category)
    {
        $this->title = $title;
        $this->author = $author;
        $this->text = $text;
        $this->category = $category;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function addComment(Соmment $newComment)
    {
        $this->comments[] = $newComment;
    }

    public function getComments() {
        return $this->comments;
    }
}

class Comment {
    private Commentators $author;
    private string $text;

    public function __construct(Commentators $author, string $text) {
        $this->author = $author;
        $this->text = $text;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getText() {
        return $this->text;
    }
}
