<?php

class Import
/* 
* Class for importing files.
*/ 
{
    public $file;

    public function importClientCSV($file)
    {
        $clients = array_map('str_getcsv', file($file));
        return $clients;
    }

}
