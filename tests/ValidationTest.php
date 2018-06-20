<?php

require_once './Validation.php';

use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    public function testIfValidEmail()
    {
        $validation = new Validation;
        $this->assertTrue($validation->validatePhoneNumber('+37069558133'));
        $this->assertFalse($validation->validatePhoneNumber('+370694558133'));
    }
}
