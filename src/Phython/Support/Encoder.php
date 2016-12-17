<?php

namespace Phython\Support;

class Encoder
{
    /**
     * @var string
     */
    protected $encoding;

    public function __construct($encoding = 'UTF-8')
    {
        $this->encoding = $encoding;
    }

    public function encode($value)
    {
        if (is_object($value)) {
            $value = clone $value;
        }

        $this->encodeRecursive($value);

        return $value;
    }

    /**
     * Recursively encode a variable.
     *
     * @see http://php.net/manual/en/function.utf8-encode.php#109965
     *
     * @param mixed &$input
     */
    protected function encodeRecursive(&$input)
    {
        if (is_string($input)) {
            $input = $this->encodeString($input);
        } elseif (is_array($input)) {
            foreach ($input as &$value) {
                $this->encodeRecursive($value);
            }
            unset($value);
        } elseif (is_object($input)) {
            $vars = array_keys(get_object_vars($input));
            foreach ($vars as $var) {
                $this->encodeRecursive($input->$var);
            }
        }
    }

    /**
     * Convert encoding of a string.
     *
     * @param string $value
     *
     * @return string
     */
    protected function encodeString($value)
    {
        return mb_convert_encoding($value, $this->encoding);
    }

    /**
     * Get encoding used for encoding strings.
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }
}
