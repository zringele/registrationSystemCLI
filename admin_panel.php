<?php
parse_str(implode('&', array_slice($argv, 1)), $_GET);

require_once 'Client.php';
if ($_GET['action'] != 'import'){
    new Client($_GET);
}