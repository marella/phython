<?php

namespace Phython\Tests;

use Phython\Exceptions\InputException;
use Phython\Exceptions\OutputException;
use Phython\Exceptions\ProcessFailedException;

class ExceptionsTest extends BaseTestCase
{
    public function testInputJsonException()
    {
        $python = $this->getPython();
        $function = $python->from('exception_cases.input')->import('test');
        $invalidString = chr(128);
        $this->setExpectedException(InputException::class);
        $function($invalidString);
    }

    public function testOutputJsonException()
    {
        $python = $this->getPython();
        $function = $python->from('exception_cases.output')->import('test');
        $this->setExpectedException(OutputException::class);
        $function();
    }

    public function testProcessFailedException()
    {
        $python = $this->getPython();
        $function = $python->from('exception_cases.process')->import('test');
        $this->setExpectedException(ProcessFailedException::class);
        $function();
    }
}
