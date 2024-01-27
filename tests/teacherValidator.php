<?php

// пример модульного тестирования

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Implementations\Validator;

class SolutionTest extends TestCase
{
    public function testValidator(): void
    {
        // BEGIN
        $validator = new Validator();

        $this->assertTrue($validator->isValid('value'));

        $validator->addCheck(fn ($v) => is_integer($v));
        $this->assertFalse($validator->isValid('string'));

        $validator->addCheck(fn ($v) => $v > 10);
        $this->assertTrue($validator->isValid(100));

        $validator->addCheck(fn ($v) => $v % 2 === 0);
        $this->assertFalse($validator->isValid(8));
        $this->assertFalse($validator->isValid(11));
        $this->assertTrue($validator->isValid(12));
        // END
    }
}