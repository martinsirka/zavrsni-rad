<?php 
include 'partials/head.php';
include 'conection_to_db.php';

$post_id = $_GET['id'];

if (!empty($_GET['error'])) {
    $error = true;
}
?>

    <main role="main" class="container">

        <div class="row">
            
            <div class="col-sm-8 blog-main">
                
                <div class="blog-post">

                <?php if ($error) { ?>
                    <div class="alert alert-danger">Please fillout all filds.</div>
                <?php } ?>

                </div><!-- /.blog-post -->

                    <!-- Create comment form -->
                    <form action="create_post.php" method="POST">
                        <div class="form-group">
                            <input class="form-control" type="text" name="author" placeholder="Author of post">
                            <input class="form-control" type="text" name="title" placeholder="Title of post">
                            <textarea class="writeComment form-control" placeholder="New post" cols="50" rows="5" name="post"></textarea>
                            <button type="submit" class="comm-btn btn btn-default">Submit</button>
                        </div>
                    </form>

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

            </div><!-- /.blog-main -->

            <?php include 'partials/sidebar.php'; ?>

        </div><!-- /.row -->

    </main><!-- /.container -->

<?php include 'partials/footer.php'; ?>