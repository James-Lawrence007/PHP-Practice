<?php

// Connect to database:
$pdo = require 'connect.php';


/*Adding the following book titles:

1. **Book Title**: *Harry Potter and the Sorcerer's Stone*
    - **Author**: J.K. Rowling
        - **First Name**: Joanne
        - **Middle Name**: Kathleen
        - **Last Name**: Rowling
    - **Publisher**: Bloomsbury Publishing
    - **ISBN**: 978-0747532699
    - **Published Date**: 1997-06-26
2. **Book Title**: *A Game of Thrones*
    - **Author**: George R.R. Martin
        - **First Name**: George
        - **Middle Name**: Raymond Richard
        - **Last Name**: Martin
    - **Publisher**: Bantam Books
    - **ISBN**: 978-0553103540
    - **Published Date**: 1996-08-06
3. **Book Title**: *The Hobbit*
    - **Author**: J.R.R. Tolkien
        - **First Name**: John
        - **Middle Name**: Ronald Reuel
        - **Last Name**: Tolkien
    - **Publisher**: George Allen & Unwin
    - **ISBN**: 978-0048231887
    - **Published Date**: 1937-09-21
4. **Book Title**: *1984*
    - **Author**: George Orwell
        - **First Name**: Eric
        - **Middle Name**: Arthur
        - **Last Name**: Blair (pen name: George Orwell)
    - **Publisher**: Secker & Warburg
    - **ISBN**: 978-0451524935
    - **Published Date**: 1949-06-08
5. **Book Title**: *To Kill a Mockingbird*
    - **Author**: Harper Lee
        - **First Name**: Nelle
        - **Middle Name**: Harper
        - **Last Name**: Lee
    - **Publisher**: J.B. Lippincott & Co.
    - **ISBN**: 978-0060935467
    - **Published Date**: 1960-07-11

*/

// authors
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
    $author_id[] = $pdo->lastInsertId();
};
//-------------------------------------------------------------

//publishers
$sql = 'insert into publishers(name)
        values(:name)';

$statement = $pdo->prepare($sql);

$publishers = [
    'Bloomsbury Publishing',
    'Bantam Books',
    'George Allen & Unwin',
    'Secker & Warburg',
    'J.B. Lippincott & Co.'
];

foreach ($publishers as $publisher){
    $statement->bindParam(':name', $publisher);
    $statement->execute();
    $publisher_id[] = $pdo->lastInsertId();
};

//--------------------------------------------------------

//books

$sql = "INSERT INTO books (title, ISBN, published_date, publisher_id) VALUES (:title, :ISBN, :published_date, :publisher_id)";

$statement = $pdo->prepare($sql);

$books = [
    ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'ISBN' => '978-0747532699', 'published_date' => '1997-06-26', 'publisher_id' => $publisher_id[0]],
    ['title' => 'A Game of Thrones', 'ISBN' => '978-0553103540', 'published_date' => '1996-08-06', 'publisher_id' => $publisher_id[1]],
    ['title' => 'The Hobbit', 'ISBN' => '978-0048231887', 'published_date' => '1937-09-21', 'publisher_id' => $publisher_id[2]],
    ['title' => '1984', 'ISBN' => '978-0451524935', 'published_date' => '1949-06-08', 'publisher_id' => $publisher_id[3]],
    ['title' => 'To Kill a Mockingbird', 'ISBN' => '978-0060935467', 'published_date' => '1960-07-11', 'publisher_id' => $publisher_id[4]]
];

foreach ($books as $book){
    $statement->bindParam(':title', $book['title']);
    $statement->bindParam(':ISBN', $book['ISBN']);
    $statement->bindParam(':published_date', $book['published_date']);
    $statement->bindParam(':publisher_id', $book['publisher_id']);
    $statement->execute();
    $book_id[] = $pdo->lastInsertId();
};

//------------------------------------------------------------------------------------

//book authors


$sql = "INSERT INTO book_authors (book_id, author_id)
    VALUES (:book_id, :author_id)";

$statement = $pdo->prepare($sql);

for ($i = 0; $i < count($book_id); $i++){
    $statement->bindParam(':book_id', $book_id[$i]);
    $statement->bindParam(':author_id', $author_id[$i]);
    $statement->execute();
}

echo "Data inserted successfully";
