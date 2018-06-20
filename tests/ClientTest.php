<?php

require_once './Client.php';

use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase
{
    public function testIDIsEmpty()
    {
        $client = new Client(array(''));
        $this->assertEmpty($client->id);
    }
}
