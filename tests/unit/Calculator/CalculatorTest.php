<?php

use App\Calculator\Addition;
use App\Calculator\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /** @test */
    public function can_set_single_operation()
    {
        $addition = new Addition;
        $addition->setOperands([5,10]);

        $calculator = new Calculator;
        $calculator->setOperation($addition);

        $this->assertCount(1, $calculator->getOperations());
    }

    /** @test */
    public function can_set_multiple_operation()
    {
        $addition1 = new Addition;
        $addition1->setOperands([5,10]);

        $addition2 = new Addition;
        $addition2->setOperands([5,10]);

        $calculator = new Calculator;
        $calculator->setOperations([$addition1, $addition2]);

        $this->assertCount(2, $calculator->getOperations());
    }

    /** @test */
    public function operations_are_ignored_if_not_instance_of_operation_interface()
    {
        $addition = new Addition;
        $addition->setOperands([5,10]);

        $calculator = new Calculator;
        $calculator->setOperations([$addition, 'dd', 'jdhfd']);

        $this->assertCount(1, $calculator->getOperations());
    }
}