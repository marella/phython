<?php

namespace Phython\Tests;

use PHPUnit_Framework_TestCase;
use Phython\Python;

abstract class BaseTestCase extends PHPUnit_Framework_TestCase
{
    protected function getPython($python = null)
    {
        return new Python(__DIR__.'/modules', $python);
    }
}
