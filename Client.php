<?php
require_once 'Validation.php';
class Client
/* 
* Class for Client inserting, updating and editing.
*/ 
{
    private $dbserver = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'cms';

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $phonenumber1;
    public $phonenumber2;
    public $comment;

    public function __construct($data)
    {
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        foreach ($data as $column => $value)
        {
            switch ($column){
                case 'id':
                    $this->id = $mysqli->real_escape_string($value);
                    break;
                case 'firstname':
                    $this->firstname = $mysqli->real_escape_string($value);
                    break;
                case 'lastname':
                    $this->lastname = $mysqli->real_escape_string($value);
                    break;
                case 'email':
                    $this->email = $mysqli->real_escape_string($value);
                    break;
                case 'phonenumber1':
                    $this->phonenumber1 = $mysqli->real_escape_string($value);
                    break;
                case 'phonenumber2':
                    $this->phonenumber2 = $mysqli->real_escape_string($value);
                    break;
                case 'comment':
                    $this->comment = $mysqli->real_escape_string($value);
                    break;
            }
        }
    }
    public function insert()
    {
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        $query ="INSERT INTO client (firstname, lastname, email, phonenumber1, phonenumber2, comment) VALUES
                                            ('$this->firstname', '$this->lastname', '$this->email', '$this->phonenumber1', '$this->phonenumber2', '$this->comment')";
        if (!$mysqli->query($query)) {
            printf("Error: %s\n", $mysqli->error);
        }
        return $query;
    }

    public function delete()
    {
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        $query = "DELETE FROM client WHERE id = $this->id";
        if (!$mysqli->query($query)) {
            printf("Error: %s\n", $mysqli->error);
        }
        return $query;
    }

    public function update()
    {
        return 'succesfully deleted user '. $this->firstname;
    }

    public function import()
    {
        return 'succesfully deleted user '. $this->firstname;
    }
}
