<?php
parse_str( implode('&', array_slice($argv, 1)), $_GET);
require_once 'Client.php';

if(!isset($_GET['action'])) 
    echo "Please define action. action must be import, insert, update or delete";
switch ($_GET['action'])
{
    case 'insert':
        $client = new Client($_GET);
        echo $client->insert();
        break;
    case 'update':
        $client = new Client($_GET);
        echo $client->update();
        break;
    case 'import':
        $client = new Client($_GET);
        echo $client->import();
        break;
    case 'delete':
        $client = new Client($_GET);
        echo $client->delete();
        break;
}