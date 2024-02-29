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
}

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
