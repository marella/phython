<?php

namespace Phython;

class Python
{
    /**
     * Python modules path.
     *
     * @var string
     */
    protected $path;

    /**
     * Python executable path.
     *
     * @var string
     */
    protected $python;

    public function __construct($path, $python = null)
    {
        $this->path = $path;
        $this->python = $python;
    }

    public function module($module)
    {
        return new Module($this->path, $module, $this->python);
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
