<?php

use Mav\Optimacros\Handler;
use PHPUnit\Framework\TestCase;

class HandlerTest extends TestCase
{

    private string $inputFileName = 'D:\projects\tests\Optimacros\src\input.csv';
    private string $actualFileName = 'D:\projects\tests\Optimacros\src\output.json';
    private string $resFileName = 'outputTest.txt';

    protected function setUp(): void
    {
        new Handler($this->inputFileName,$this->resFileName);
    }

    public function testExportJson(){

        $this->assertTrue(file_exists($this->resFileName));
        $this->assertEquals(file_get_contents($this->actualFileName),file_get_contents($this->resFileName));
    }

}