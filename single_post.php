<?php 
include 'partials/header.php';
include 'conection_to_db.php';

$post_id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE posts.id = $post_id";
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
        // var_dump($posts);
        // echo '</pre>';
        ?>

    <main role="main" class="container">

        <div class="row">
            
            <div class="col-sm-8 blog-main">
                
                <div class="blog-post">
                        
                    <?php foreach ($posts as $post) { ?>

                        <h2 class="blog-post-title">
                            <a href = "single_post.php" >
                                <?php echo ($post['title']) ?>
                            </a>
                        </h2>
                        <p class="blog-post-meta">
                            <?php echo date('d/m/Y H:i\h', strtotime($post['created_at'])) ?>
                            <a href="#"><?php echo ($post['author']) ?></a>
                        </p>
                        <p>
                            <?php echo ($post['body']) ?>
                        </p>
                    
                    <?php } ?>

                </div><!-- /.blog-post -->

                <div class="comment">
                    <ul>
                        <li>Sample comment</li>
                    </ul>
                </div>

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

            </div><!-- /.blog-main -->

            <?php include 'partials/sidebar.php'; ?>

        </div><!-- /.row -->

    </main><!-- /.container -->

<?php include 'partials/footer.php'; ?>