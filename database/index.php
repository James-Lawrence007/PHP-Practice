<?php

// Connect to database:
$pdo = require 'connect.php';



$sql = 'insert into authors (first_name, middle_name, last_name)
        values(:first_name, :middle_name, :last_name)';

$statement = $pdo->prepare($sql);


//Step 2: Execution
$authors = [
    [
        'first_name' => 'Joanne',
        'middle_name' => 'Kathleen',
        'last_name' => 'Rowling'
    ],
    [
        'first_name' => 'George',
        'middle_name' => 'Raymond Richard',
        'last_name' => 'Martin'
    ],
    [
        'first_name' => 'John',
        'middle_name' => 'Ronald Reuel',
        'last_name' => 'Tolkien'
    ],
    [
        'first_name' => 'Eric',
        'middle_name' => 'Arthur',
        'last_name' => 'Blair'
    ],
    [
        'first_name' => 'Nelle',
        'middle_name' => 'Harper',
        'last_name' => 'Lee'
    ]
];



foreach($authors as $author){
    $statement->bindParam(':first_name', $author['first_name']);
    $statement->bindParam(':middle_name', $author['middle_name']);
    $statement->bindParam(':last_name', $author['last_name']);
    $statement->execute();
};
