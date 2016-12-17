<?php

namespace Phython;

class Module
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $module;

    public function __construct($path, $module)
    {
        $this->path = $path;
        $this->module = $module;
    }

    public function def($def)
    {
        return new Def($this->path, $this->module, $def);
    }

    public function import($def)
    {
        return $this->def($def);
    }

    public function __call($def, $arguments)
    {
        return call_user_func_array([$this->def($def), 'call'], $arguments);
    }
}
