<?php 
include 'partials/header.php';
include 'conection_to_db.php';

$post_id = $_GET['id'];

$sql = "SELECT posts.id, posts.title, posts.body, posts.author, posts.created_at, 
                comments.id AS commentID, comments.post_id, comments.author AS authorName, comments.tekst 
                FROM posts LEFT JOIN comments ON posts.id = comments.post_id WHERE posts.id = $post_id";
                
    $statement = $conn->prepare($sql);

    // izvrsavamo upit
    $statement->execute();

    // zelimo da se rezultat vrati kao asocijativni niz.
    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $postWithComments = $statement->fetchAll(); 

    $post = $postWithComments[0];
    $comments = [];
        foreach($postWithComments as $comment) {
        array_push($comments, ['author' => $comment['authorName'], 'text' => $comment['tekst']]);
    }

    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
        // echo '<pre>';
        // var_dump($comments);
        // echo '</pre>';
        ?>

    <main role="main" class="container">

        <div class="row">
            
            <div class="col-sm-8 blog-main">
                
                <div class="blog-post">

                        <h2 class="blog-post-title">
                            <?php echo ($post['title']) ?>
                        </h2>
                        <p>
                            <?php echo ($post['body']) ?>
                        </p>
                        <p class="blog-post-meta">
                            <?php echo date('d/m/Y H:i\h', strtotime($post['created_at'])) ?>
                            <a href="#"><?php echo ($post['author']) ?></a>
                        </p>

                </div><!-- /.blog-post -->

                    <form action="" method="POST">
                        <p class="writeComment">Example text</p>
                        <button class="comm-btn btn btn-default" href="#">Submit</button> 
                    </form>
                    
                    <?php if(!empty($comment['tekst'])) {?>
                        <button type="button" class="comm-btn btn btn-default" onclick="myFunction()">Hide comments</button>

                    <div class="comment">
                        <?php 
                            foreach ($comments as $comment) { 
                        ?>
                            <ul>
                                <li><a href="#"><?php echo ($comment['author'])  ?></a></li>
                                <li><?php echo ($comment['text']) ?></li>
                            </ul>
                        <?php } ?>
                    </div>
                <?php }?>

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

            </div><!-- /.blog-main -->

            <?php include 'partials/sidebar.php'; ?>

        </div><!-- /.row -->

    </main><!-- /.container -->

<?php include 'partials/footer.php'; ?>