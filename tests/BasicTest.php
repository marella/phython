<?php

namespace Phython\Tests;

class BasicTest extends BaseTestCase
{
    public function testNullOutput()
    {
        $python = $this->getPython();
        $actual = $python->import('basic')->does_nothing();
        $this->assertNull($actual);
    }

    /**
     * @dataProvider moduleArrayProvider
     */
    public function testSort($module, array $array)
    {
        $python = $this->getPython();

        $function = $python->from($module)->import('sort');

        $actual = $function($array);
        $expected = $array;
        sort($expected);
        $this->assertSame($expected, $actual);

        $actual = $function($array, $reverse = true);
        $expected = array_reverse($expected);
        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider moduleArrayProvider
     */
    public function testSortAsync($module, array $array)
    {
        $python = $this->getPython();

        $function = $python->from($module)->import('sort');

        $process = $function->async($array);
        $actual = $process->output();
        $expected = $array;
        sort($expected);
        $this->assertSame($expected, $actual);

        $process = $function->async($array, $reverse = true);
        $actual = $process->output();
        $expected = array_reverse($expected);
        $this->assertSame($expected, $actual);
    }

    public function moduleArrayProvider()
    {
        $modules = [
            'submodules.helpers.array',
            'submodules.helpers.implicit',
            'submodules.helpers.absolute',
            'submodules.helpers.relative',
            'submodules.helpers.inner.absolute',
            'submodules.helpers.inner.relative',
            'submodules.outer.absolute',
            'submodules.outer.relative',
        ];

        $arrays = [
            [5, 3, 1, 2, 4],
        ];

        $ret = [];

        foreach ($modules as $module) {
            foreach ($arrays as $array) {
                $ret[] = [$module, $array];
            }
        }

        return $ret;
    }
}
