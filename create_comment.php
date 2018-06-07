<?php

$postId = $_POST['postId']; 
$author = $_POST['author'];
$comment = $_POST['comment'];


if (empty($author) || empty($comment)) {
    header('Location: single_post.php?id=' . $postId .'&error=1');
}

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO comments (post_id, author, tekst) 
        VALUES ($postId, '$author', '$comment')";
        // use exec() because no results are returned
        $conn->exec($sql);
        
        echo "New record created successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;

?>