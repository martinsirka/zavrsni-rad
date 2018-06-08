<?php

$author = $_POST['author'];
$title = $_POST['title'];
$post = $_POST['post'];


if (empty($author) || empty($post)) {
    header('Location: create.php?error=1');
}

if (!empty($author) && !empty($post)) {
        header('Location: index.php');    
    
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO posts (author, title, body, created_at) 
        VALUES ('$author', '$title', '$post', NOW())";
        // use exec() because no results are returned
        $conn->exec($sql);
        
        echo "New record created successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;
    
}

?>