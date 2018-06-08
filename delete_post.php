<?php

include "conection_to_db.php";

$postId = $_POST['postId'];

    try {          
        $sql = "DELETE FROM comments WHERE post_id = $postId";
        $conn->exec($sql);

        $sql = "DELETE FROM posts WHERE id = $postId";
        $conn->exec($sql);
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;
    
    header('Location: index.php');

?>