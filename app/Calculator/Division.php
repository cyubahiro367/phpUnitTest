<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandsException;

class Division extends OperationAbstract implements OperationInterface
{
    public function calculate()
    {

        if(count($this->operands) === 0){
            throw new NoOperandsException;
        }

        $results = 0;

        foreach(array_filter($this->operands) as $index => $operand){
            if($index===0){
                $results = $operand;
                continue;
            }

            $results = $results / $operand;
        }

        return $results;
    }

}