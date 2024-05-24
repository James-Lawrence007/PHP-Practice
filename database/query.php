<?php


// Connect to database:
$pdo = require 'connect.php';

//SQL statement:
$sql = "SELECT publisher_id, name
            FROM publishers";

$statement = $pdo->query($sql);

//Get all publishers
$publishers = $statement->fetchALL(PDO::FETCH_ASSOC);

if($publishers){
    //display result
    foreach ($publishers as $publisher){
        echo $publisher['name'] . '<br>';
    }
}