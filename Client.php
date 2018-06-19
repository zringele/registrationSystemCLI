<?php
require_once 'Validation.php';
class Client
/* 
* Class for Client inserting, updating and editing.
*/ 
{
    public $dbserver = 'localhost';
    public $dbuser = 'root';
    public $dbpass = '';
    public $dbname = 'client';

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $phonenumber1;
    public $phonenumber2;
    public $comment;

    public function __construct($data)
    {
        foreach ($data as $column => $value)
        {
            switch ($column){
                case 'id':
                    $this->id = $value;
                    break;
                case 'firstname':
                    $this->firstname = $value;
                    break;
                case 'lastname':
                    $this->lastname = $value;
                    break;
                case 'email':
                    $this->email = $value;
                    break;
                case 'phonenumber1':
                    $this->phonenumber1 = $value;
                    break;
                case 'phonenumber2':
                    $this->phonenumber2 = $value;
                    break;
                case 'comment':
                    $this->comment = $value;
                    break;
            }
        }
    }
    public function insert()
    {
        $mysqli = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
        $query = $mysqli->real_escape_string("INSERT INTO users (firstname, lastname, email, phonenumber1, phonenumber2, comment) VALUES
                                            ('$this->firstname', '$this->lastname', '$this->email', '$this->phonenumber1', '$this->phonenumber2', '$this->comment')");
        var_dump($query);
        return $query;
    }
    public function delete()
    {
        return 'succesfully deleted user '. $this->firstname;
    }
}
