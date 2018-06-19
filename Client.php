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
        $validation = new Validation;
        foreach ($data as $column => $value)
        {
            switch ($column)
            {
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
                    if ($validation->validateEmail($value)){
                        $this->email = $mysqli->real_escape_string($value);
                        break;
                    }
                    echo 'email is not valid';
                    break;
                case 'phonenumber1':
                    if ($validation->validateEmail($value)){
                        $this->phonenumber1 = $mysqli->real_escape_string($value);
                        break;
                    }
                    echo 'Phone number 1 is not valid';
                    break;
                case 'phonenumber2':
                if ($validation->validateEmail($value)){
                        $this->phonenumber2 = $mysqli->real_escape_string($value);
                        break;
                    }
                    echo 'Phone number 2 is not valid';
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
        if (isset($this->firstname)) {
            $this->updateQuery('firstname', $this->firstname);
        }
        if (isset($this->lastname)) {
            $this->updateQuery('lastname', $this->lastname);
        }
        if (isset($this->email)) {
            $this->updateQuery('email', $this->email);
        }
        if (isset($this->phonenumber1)) {
            $this->updateQuery('phonenumber1', $this->phonenumber1);
        }
        if (isset($this->phonenumber2)) {
            $this->updateQuery('phonenumber2', $this->phonenumber2);
        }
        if (isset($this->comment)) {
            $this->updateQuery('comment', $this->comment);
        }
        return $query;
    }

    public function import()
    {
        return 'succesfully deleted user '. $this->firstname;
    }

    private function updateQuery($column, $field)
    {
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        $query = "UPDATE client SET $column = '$field' WHERE id = $this->id";
        if (!$mysqli->query($query)) {
            printf("Error: %s\n", $mysqli->error);
        } 
    }
}
