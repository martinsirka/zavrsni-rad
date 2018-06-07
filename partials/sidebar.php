<?php 
include 'conection_to_db.php';

$post_id = $_GET['id'];

$sql = "SELECT posts.id, posts.title FROM posts ORDER BY created_at DESC LIMIT 5";
    $statement = $conn->prepare($sql);

    // izvrsavamo upit
    $statement->execute();

    // zelimo da se rezultat vrati kao asocijativni niz.
    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $posts = $statement->fetchAll();

    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
        // echo '<pre>';
        // var_dump($comments);
        // echo '</pre>';
        ?>


<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
            <h4>Latest post</h4>
        <?php foreach($posts as $post) { ?>
            <a href="single_post.php?id=<?php echo $post['id'] ?>">
            <p><?php echo substr(($post['title']), 0, 22) ?></p></a>    
        <?php } ?>
    </div>
</aside><!-- /.blog-sidebar -->