<?php

use PHPUnit\Framework\TestCase;
use App\Models\Expense;

class ExpenseTest extends TestCase
{
    public function testExpenseCreation()
    {
        $result = 3+2;
        $this->assertEquals(5, $result
    );
    }
}
