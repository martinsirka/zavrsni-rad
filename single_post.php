<?php 
include 'partials/head.php';
include 'conection_to_db.php';

$post_id = $_GET['id'];

$sql = "SELECT posts.id AS postsID, posts.title, posts.body, posts.author, posts.created_at, 
                comments.id, comments.post_id, comments.author AS authorName, comments.tekst 
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
        array_push(
            $comments, 
                ['author' => $comment['authorName'], 
                 'text' => $comment['tekst'], 
                 'id' => $comment['id'], 
                 'post_id' => $comment['post_id']]
                );
    }

?>

    <main role="main" class="container">

        <div class="row">
            
            <div class="col-sm-8 blog-main">
                
                <div class="blog-post">

                    <!-- Error message in case theres empty fild -->
                   <?php 
                   if ( isset($_GET['error']) ) {
                       if ( $_GET['error'] == 1 ) {
                            echo "<h4 class='alert alert-danger text-danger text-center'>Please fillout all filds</h4>";
                       }
                   }
                   ?>
                
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

                    <!-- Delete POST -->

                    <p id="demo">

                    <form onsubmit='return confirm("Are you sure you want to delete this post?");' action="delete_post.php" method="POST">
                        <input type="hidden" name="postId" value="<?php echo $post_id ?>">
                        <button class="comm-btn btn btn-default" >Delete post</button>
                    </form>

                </div><!-- /.blog-post -->

                <!-- Create comment form -->
                <form action="create_comment.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="postId" value="<?php echo $post_id ?>">
                        <input class="form-control author" type="text" name="author" placeholder="Author">
                        <textarea class="writeComment form-control" placeholder="Your comment.." name="comment"></textarea>
                        <button type="submit" class="comm-btn btn btn-default ">Submit</button>
                    </div>
                </form>
                    
                <?php if(!empty($comment['tekst'])) {?>

                    <button type="button" class="comm-btn btn btn-default" onclick="myFunction()">Hide comments</button>

                    <div class="comment">
                        <?php  foreach ($comments as $comment) { ?>
                    
                            <!-- Print comments and Delete comment form -->
                            <ul>
                                <li><a href="#"><?php echo ($comment['author'])  ?></a></li>
                                <li><?php echo ($comment['text']) ?></li>

                                <form onsubmit='return confirm("Are you sure you want to delete this comment?");' action="delete_comment.php" method="POST">
                                    <input type="hidden" name="postId" value="<?php echo $post_id ?>">
                                    <input type="hidden" name="commentId" value="<?php echo $comment['id'] ?>">
                                    <button class="comm-btn btn btn-default">Delete comment</button>
                                </form> 
                            </ul>
                            
                        <?php } ?>

                    </div>

                <?php } ?>

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

            </div><!-- /.blog-main -->

            <?php include 'partials/sidebar.php'; ?>

        </div><!-- /.row -->

    </main><!-- /.container -->

<?php include 'partials/footer.php'; ?>