<?php

namespace Phython\Tests;

use Phython\Exceptions\ProcessFailedException;

class PythonTest extends BaseTestCase
{
    /**
     * @dataProvider validPythonPathProvider
     */
    public function testValidPythonPath($python)
    {
        $python = $this->getPython($python);
        $function = $python->from('basic')->import('echo');
        $expected = ['something'];
        $actual = $function($expected);
        $this->assertSame($expected, $actual);
    }

    public function validPythonPathProvider()
    {
        $paths = [
            'python',
            '/usr/bin/python',
        ];

        return array_map(function ($value) {
            return [$value];
        }, $paths);
    }

    /**
     * @dataProvider invalidPythonPathProvider
     */
    public function testInvalidPythonPath($python)
    {
        $python = $this->getPython($python);
        $function = $python->from('basic')->import('echo');
        $expected = ['something'];
        $this->setExpectedException(ProcessFailedException::class);
        $function($expected);
    }

    public function invalidPythonPathProvider()
    {
        $paths = [
            'somethingthatdoesntexist',
        ];

        return array_map(function ($value) {
            return [$value];
        }, $paths);
    }
}
