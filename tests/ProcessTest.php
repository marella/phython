<?php

namespace Phython\Tests;

use Phython\Process;
use Symfony\Component\Process\Process as SymfonyProcess;

class ProcessTest extends BaseTestCase
{
    public function testProcess()
    {
        $python = $this->getPython();
        $function = $python->from('basic')->import('echo');
        $process = $function->getProcess();
        $this->assertFalse($process->isStarted());
        $this->assertInstanceOf(Process::class, $process);
    }

    public function testSymfonyProcess()
    {
        $python = $this->getPython();
        $function = $python->from('basic')->import('echo');
        $process = $function->getProcess()->getProcess();
        $this->assertFalse($process->isStarted());
        $this->assertInstanceOf(SymfonyProcess::class, $process);
    }
}
