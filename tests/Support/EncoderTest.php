<?php

namespace Phython\Tests\Support;

use Phython\Exceptions\InputException;
use Phython\Support\Encoder;
use Phython\Tests\BaseTestCase;

class EncoderTest extends BaseTestCase
{
    /**
     * @dataProvider invalidStringProvider
     */
    public function testEncode($invalidString)
    {
        $invalidArray = $this->getArray($invalidString);
        $invalidObject = $this->getObject($invalidString);
        $this->assertFalse(json_encode($invalidString));
        $this->assertFalse(json_encode($invalidArray));
        $this->assertFalse(json_encode($invalidObject));

        $encoder = new Encoder();
        $encoding = $encoder->getEncoding();

        $expectedValidString = mb_convert_encoding($invalidString, $encoding);
        $expectedValidArray = $this->getArray($expectedValidString);
        $expectedValidObject = $this->getObject($expectedValidString);
        $this->assertNotFalse(json_encode($expectedValidString));
        $this->assertNotFalse(json_encode($expectedValidArray));
        $this->assertNotFalse(json_encode($expectedValidObject));

        $actualValidString = $encoder->encode($invalidString);
        $actualValidArray = $encoder->encode($invalidArray);
        $actualValidObject = $encoder->encode($invalidObject);
        $this->assertFalse(json_encode($invalidObject));
        $this->assertNotSame($invalidObject, $actualValidObject);
        $this->assertSame($expectedValidString, $actualValidString);
        $this->assertSame($expectedValidArray, $actualValidArray);
        $this->assertEquals($expectedValidObject, $actualValidObject);
    }

    /**
     * @dataProvider invalidStringProvider
     */
    public function testFixInputException($invalidString)
    {
        $python = $this->getPython();

        $invalidArray = $this->getArray($invalidString);
        $this->assertFalse(json_encode($invalidArray));

        $encoder = new Encoder();
        $validArray = $encoder->encode($invalidArray);
        $this->assertNotFalse(json_encode($validArray));

        $function = $python->from('basic')->import('echo');

        $expected = $validArray;
        $actual = $function($validArray);
        $this->assertSame($expected, $actual);

        $this->setExpectedException(InputException::class);
        $function($invalidArray);
    }

    public function invalidStringProvider()
    {
        return [
            [chr(128)],
        ];
    }

    protected function getArray($string)
    {
        return [
            'a' => 1,
            'b' => [
                'c' => $string,
            ],
        ];
    }

    protected function getObject($string)
    {
        return (object) [
            'a' => 1,
            'b' => [
                'c' => $string,
            ],
        ];
    }
}
