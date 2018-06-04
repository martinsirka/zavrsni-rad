<?php 
include 'partials/header.php';

include 'conection_to_db.php';

$sql = "SELECT id, title, created_at, body, author FROM posts ORDER BY created_at DESC LIMIT 3";
    $statement = $connection->prepare($sql);

    // izvrsavamo upit
    $statement->execute();

    // zelimo da se rezultat vrati kao asocijativni niz.
    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $posts = $statement->fetchAll();

    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
        echo '<pre>';
        var_dump($posts);
        echo '</pre>';


include 'partials/sidebar.php'; 
include 'partials/footer.php'; 
?>