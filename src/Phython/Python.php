<?php

namespace Phython;

class Python
{
    /**
     * @var string
     */
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function module($module)
    {
        return new Module($this->path, $module);
    }

    public function import($module)
    {
        return $this->module($module);
    }

    public function from($module)
    {
        return $this->module($module);
    }
}
