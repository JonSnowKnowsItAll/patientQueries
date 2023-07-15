<?php

/*Verbindung zur DB*/
$server = 'localhost:3306';
$user = 'root';
$password = 'raspberry';
$db = 'arztpraxis';

try {
    $con = new PDO('mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8', $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Error - Verbindung zur Datenbank nicht möglich ' . $e->getCode() . ': ' . $e->getMessage();
}