<?php

class Client
/* 
* Class for Client inserting, updating and editing.
*/ 
{
    public $conn = '';

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $phonenumber1;
    public $phonenumber2;
    public $comment;

    public function __construct($action)
    {
        switch($action['action'])
    }
}
