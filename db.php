<?php

/****************************************************
 * 
 * Filnamn: db.php
 * 
 * Filen innehåller info om databasen och användaren
 * 
 *****************************************************/


$db_server = "localhost";
$db_database = "my_cms";
$db_username = "root";
$db_password = "";

try{
$db = new PDO("mysql:host=$db_server;dbname=$db_database;charset=utf8"
            , $db_username
            , $db_password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
echo "Error: " . $e-> getMessage();
}


