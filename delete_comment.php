<?php

$postId=$_GET['postsID'];
$commentId=$_GET['commentID'];

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog";


    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to delete a record
        $sql = "DELETE FROM comments WHERE id = $commentId";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Record deleted successfully";
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }

    $conn = null;

?>