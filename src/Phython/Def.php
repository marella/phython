<?php

namespace Phython;

class Def
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $python;

    /**
     * @var string
     */
    protected $module;

    /**
     * @var string
     */
    protected $def;

    public function __construct($path, $module, $def, $python = null)
    {
        $this->path = $path;
        $this->python = $python;
        $this->module = $module;
        $this->def = $def;
    }

    public function call()
    {
        $arguments = func_get_args();
        $process = call_user_func_array([$this, 'async'], $arguments);

        return $process->output();
    }

    public function async()
    {
        $arguments = func_get_args();
        $process = $this->getProcess();
        $process->input($arguments);
        $process->start();

        return $process;
    }

    public function getProcess()
    {
        return new Process($this->path, $this->module, $this->def, $this->python);
    }

    public function __invoke()
    {
        $arguments = func_get_args();

        return call_user_func_array([$this, 'call'], $arguments);
    }
}
