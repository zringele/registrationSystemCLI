<?php
require_once 'Validation.php';
require_once 'Import.php';
class Client
/* 
* Class for Client inserting, updating and editing.
*/ 
{
    private $dbserver = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'cms';

    private $message;
    private $file;
    private $arrayStructure = array(
        'id',
        'firstname',
        'lastname',
        'email',
        'phonenumber1',
        'phonenumber2',
        'comment'
    );

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
                    $email = $mysqli->real_escape_string($value);
                    if (!$this->uniqueClientEmail($email)){
                        echo ' Email is not unique.' . PHP_EOL;
                        break;
                    }
                    if (filter_var($value, FILTER_VALIDATE_EMAIL)){
                        $this->email = $email;
                        break;
                    }
                    echo ' Email is not valid.' . PHP_EOL;
                    break;
                case 'phonenumber1':
                    if ($value === ""){ 
                        unset($this->phonenumber1);
                        break;
                    }
                    $number = str_replace(" ", "+", $value);
                    if ($validation->validatePhoneNumber($number)){
                        $this->phonenumber1 = $mysqli->real_escape_string($number);
                        break;
                    }
                    echo ' Phone number 1 is not a valid Lithuanian phone no.' . PHP_EOL;
                    break;
                case 'phonenumber2':
                    if ($value === "") break;
                    $number = str_replace(" ", "+", $value);
                    if ($validation->validatePhoneNumber($number)){
                        $this->phonenumber2 = $mysqli->real_escape_string($number);
                        break;
                    }
                    echo ' Phone number 2 is not valid' . PHP_EOL;
                    break;
                case 'comment':
                    $this->comment = $mysqli->real_escape_string($value);
                    break;
                case 'file':
                    $this->file = $value;
                    break;
            }
        }
    }

    public function insert()
    {
        $errors = FALSE;
        if (!isset($this->firstname)){
            $this->message .= ' First name has to be set when adding new client.' . PHP_EOL;
            $errors = TRUE;
        }
        if (!isset($this->lastname)){
            $this->message .= ' Last name has to be set when adding new client.' . PHP_EOL;
            $errors = TRUE;
        }
        if (!isset($this->email)){
            $this->message .= ' Unique and valid email has to be set when adding new client.' . PHP_EOL;
            $errors = TRUE;
        }
        if (!isset($this->phonenumber1)){
            $this->message .= ' We need a valid first phone number to add new client.' . PHP_EOL;
            $errors = TRUE;
        }
        if ($errors) 
            return $this->message;
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        $query ="INSERT INTO client (firstname, lastname, email, phonenumber1, phonenumber2, comment) VALUES
                                            ('$this->firstname', '$this->lastname', '$this->email', '$this->phonenumber1', '$this->phonenumber2', '$this->comment')";
        if (!$mysqli->query($query)) {
            printf("Error: %s\n", $mysqli->error);
        }
        else {
            $this->message = " Succesfully added new client, ID set to $mysqli->insert_id";
        }
        return $this->message;
    }

    public function delete()
    {
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        $query = "DELETE FROM client WHERE id = $this->id";
        if (!$mysqli->query($query)) {
            printf("Error: %s\n", $mysqli->error);
            $this->message = ' Delete action was not successfull.';
        }
        else {
            $this->message = ' Delete action was successfull.';            
        }
        return $this->message;
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
        return $this->message;
    }

    public function import()
    {
        $import = new Import;
        $clients = $import->importClientCSV($this->file);
        foreach ($clients as $client){
            $clientArray = array_combine($this->arrayStructure, $client);
            $insert = new Self($clientArray);
            echo $insert->insert();
        }
    }

    private function updateQuery($column, $field)
    {
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        $query = "UPDATE client SET $column = '$field' WHERE id = $this->id";
        if (!$mysqli->query($query)) {
            printf("Error: %s\n", $mysqli->error);
        } 
    }

    private function uniqueClientEmail($email)
    {
        $mysqli = new mysqli($this->dbserver, $this->dbuser, $this->dbpass, $this->dbname);
        $query = "SELECT * FROM client WHERE email = '$email'";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0){
            return FALSE;
        }
        return TRUE;
    }
}
