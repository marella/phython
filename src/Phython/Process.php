<?php

namespace Phython;

use Phython\Exceptions\InputException;
use Phython\Exceptions\OutputException;
use Phython\Exceptions\ProcessFailedException;
use Symfony\Component\Process\ProcessBuilder;

class Process
{
    /**
     * @var \Symfony\Component\Process\Process
     */
    protected $process;

    public function __construct($path, $module, $function)
    {
        $path = rtrim($path, DIRECTORY_SEPARATOR);
        $main = realpath(__DIR__.'/../modules/phython.py');
        $builder = new ProcessBuilder(['python', $main, $module, $function]);
        $builder->setEnv('PYTHONPATH', $path);
        $this->process = $builder->getProcess();
    }

    public function input($arguments)
    {
        $input = json_encode($arguments);

        if ($input === false) {
            throw new InputException('Invalid input arguments');
        }

        $this->process->setInput($input);
    }

    public function output()
    {
        $process = $this->process;

        $process->wait(); // let the process finish if it is async

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = trim($process->getOutput());
        $return = json_decode($output, true);

        if (is_null($return) && $output !== 'null') {
            throw new OutputException('Invalid output returned');
        }

        return $return;
    }

    public function getProcess()
    {
        return $this->process;
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->process, $method], $arguments);
    }
}
