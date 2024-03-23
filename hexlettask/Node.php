<?php

namespace Hexlet\Php;

use function App\Brackets\isBalanced;

class Node
{
    private $key;
    private $left;
    private $right;

    public function __construct($key = null, $left = null, $right = null)
    {
        $this->key = $key;
        $this->left = $left;
        $this->right = $right;
    }

    public function countLeftAndRight()
    {
        $countNodes = function ($node, &$count = 0) use (&$countNodes) {
            $count++;
            if (!is_null($node->left)) {
                $countNodes($node->left, $count);
            }
            if (!is_null($node->right)) {
                $countNodes($node->right, $count);
            }
            return $count;
        };

        $numberLeft = (is_object($this->left)) ? $countNodes($this->left) : 0;
        $numberRight = (is_object($this->right)) ? $countNodes($this->right) : 0;

        return abs($numberLeft - $numberRight) <= 2;
    }

    public function isBalanced()
    {
        if (!is_object($this)) {
            return;
        }

        $status = $this->countLeftAndRight();
        if ($status) {
            if (is_object($this->left)) {
                return $this->left->isBalanced();
            }
            if (is_object($this->right)) {
                return $this->right->isBalanced();
            }
        } else {
            return false;
        }
        return true;
    }

    public function toArray()
    {
        $passesNodes = function ($node, &$listNodes = []) use (&$passesNodes) {
            if ($node) {
                $listNodes[] = $node->key;
            }

            if ($node->left) {
                $passesNodes($node->left, $listNodes);
            }
            if ($node->right) {
                $passesNodes($node->right, $listNodes);
            }
            return $listNodes;
        };

        return $passesNodes($this);
    }
    public function getCount()
    {
        return count($this->toArray());
    }

    public function getSum()
    {
        return array_sum($this->toArray());
    }

    public function toString()
    {
        $arrayKeys = $this->toArray();
        $stringKeys = implode(', ', $arrayKeys);
        return "({$stringKeys})";
    }

    public function every($fun)
    {
        $arrayKeys = $this->toArray();
        $result = array_filter($arrayKeys, fn($item) => $fun($item));
        return count($arrayKeys) === count($result);
    }

    public function some($fun)
    {
        $arrayKeys = $this->toArray();
        $result = array_filter($arrayKeys, fn($item) => $fun($item));
        return count($result) !== 0;
    }

    public function getKey()
    {
        return is_object($this) ? $this->key : null;
    }

    public function getLeft()
    {
        return $this->left;
    }
    public function getRight()
    {
        return $this->right;
    }

    public function search($key)
    {
        if ($this->key === $key) {
            return $this;
        } else {
            if ($this->key > $key && $this->left) {
                return $this->left->search($key);
            }
            if ($this->key <= $key && $this->right) {
                return $this->right->search($key);
            }
        }
        return null;
    }

    public function insert($key)
    {
        if (!($this->key)) {
            $this->key = $key;
            return $this;
        } else {
            if (!($this->search($key))) {
                $new = new Node($key);
                if ($key < $this->key) {
                    if (!($this->left)) {
                        return $this->left = $new;
                    } else {
                        $this->left->insert($key);
                    }
                } elseif ($key >= $this->key) {
                    if (!($this->right)) {
                        return $this->right = $new;
                    } else {
                        $this->right->insert($key);
                    }
                }
            }
        }
    }
}

$tree = new Node();
$tree->insert(9);
$tree->insert(17);
$tree->insert(4);
$tree->insert(3);
$tree->insert(6);
var_dump($tree->getKey()); // 9
var_dump($tree->getLeft()->getKey()); // 4
var_dump($tree->getRight()->getKey()); // 17
var_dump($tree->getLeft()->getLeft()->getKey()); // 3
var_dump($tree->getLeft()->getRight()->getKey()); // 6





$tree = new Node(
    9,
    new Node(
        4,
        new Node(3),
        new Node(
            6,
            new Node(5),
            new Node(7)
        )
    ),
    new Node(
        17,
        null,
        new Node(
            22,
            new Node(20),
            null
        )
    )
);

//$node = $tree->search(6);

//var_dump($node->getKey()); // 6
//var_dump($node->getLeft()->getKey()); // 5
//var_dump($node->getRight()->getKey()); // 7

//var_dump($tree->search(35)); // null
//var_dump($tree->search(3)->getLeft()); // null
$tree = new Node(
    9,
    new Node(
        4,
        new Node(3),
        new Node(
            6,
            new Node(5),
            new Node(7)
        )
    ),
    new Node(
        17,
        null,
        new Node(
            22,
            null,
            new Node(23)
        )
    )
);
//$test = [9, 4, 3, 6, 5, 7, 17, 22, 23];
//var_dump($tree->toArray() === $test);
//var_dump($tree->getCount());
//var_dump($tree->getSum());
//var_dump($tree->toString());
//var_dump($tree->every(fn($key) => $key <= 23));
//var_dump($tree->every(fn($key) => $key < 10));
//var_dump($tree->some(fn($key) => $key < 4)); // true
//var_dump($tree->some(fn($key) => $key > 24)); // false

$tree = new Node(
    4,
    new Node(
        3,
        new Node(2)
    )
);

//var_dump($tree->isBalanced()); //true


$tree = new Node(
    4,
    new Node(
        3,
        new Node(
            2,
            new Node(1)
        )
    )
);

//var_dump($tree->isBalanced()); //false

$tree = new Node(
    4,
    new Node(
        3,
        new Node(
            2,
            new Node(1)
        )
    ),
    new Node(5)
);

//var_dump($tree->isBalanced()); // true

$tree = new Node(
    9,
    new Node(
        4,
        new Node(3),
        new Node(
            6,
            new Node(5),
            new Node(7)
        )
    ),
    new Node(
        17,
        null,
        new Node(
            22,
            null,
            new Node(20)
        )
    )
);

//var_dump($tree->isBalanced()); // true

$tree = new Node(
    8,
    new Node(
        5,
        null,
        new Node(
            6,
            new Node(4)
        )
    ),
    new Node(
        12,
        new Node(
            10,
            null,
            new Node(11)
        ),
        new Node(14)
    )
);

//var_dump($tree->isBalanced()); //true

$tree = new Node(
    8,
    new Node(
        5,
        new Node(
            4,
            new Node(1),
            new Node(
                3,
                new Node(2)
            )
        ),
        new Node(6)
    ),
    new Node(
        12,
        new Node(
            10,
            null,
            new Node(11)
        ),
        new Node(14)
    )
);

//var_dump($tree->isBalanced()); //false

$tree = new Node(
    12,
    new Node(
        5,
        new Node(
            1,
            null,
            new Node(
                2,
                null,
                new Node(
                    3,
                    null,
                    new Node(4)
                )
            )
        ),
        new Node(
            10,
            new Node(
                8,
                new Node(
                    7,
                    new Node(6)
                ),
                new Node(9)
            ),
            new Node(11)
        )
    ),
    new Node(
        15,
        new Node(
            14,
            new Node(13)
        )
    )
);

//var_dump($tree->isBalanced()); //false
