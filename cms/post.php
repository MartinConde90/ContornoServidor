<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>



    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <?php

    //LIKE
    if(isset($_POST['liked'])){
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];

        //1-> FETCHING THE RIGHT POST
        $query = "SELECT * FROM posts WHERE post_id= $post_id";
        $postResult = mysqli_query($connection, $query);
        $post = mysqli_fetch_array($postResult);
        $likes = $post['likes'];

        //2-> UPDATE - INCREMENTING LIKES
        mysqli_query($connection, "UPDATE posts SET likes = $likes+1 WHERE post_id = $post_id");
        header("Location: post.php?p_id=".$the_post_id);

        //3-> CREATE LIKES FOR POST
        mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
        exit();
    }

    //UNLIKE
    if(isset($_POST['unliked'])){
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];

        //1-> FETCHING THE RIGHT POST
        $query = "SELECT * FROM posts WHERE post_id= $post_id";
        $postResult = mysqli_query($connection, $query);
        $post = mysqli_fetch_array($postResult);
        $likes = $post['likes'];

        //2-> UPDATE - DECREMENTING LIKES
        mysqli_query($connection, "UPDATE posts SET likes = $likes-1 WHERE post_id = $post_id");

        //3-> DELETE LIKES
        mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
        exit();
    }

    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            
            <?php

            if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];

                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                    $send_query = mysqli_query($connection,$view_query);
                if(!$send_query){
                    die("Query failed!");
                }

                //MOSTRAR TODO, PUBLICADO O NO PARA ADMIN
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                }
                //SOLO PUBLICADO PARA SUSCRIPTORES
                else{
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published' ";
                }

                //$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                $select_all_post_query = mysqli_query($connection, $query);

                if(mysqli_num_rows($select_all_post_query)<1){
                    echo "<h1 class='text-center'>NO POST PUBLISHED</h1>";
                }
                else{

                    while($row = mysqli_fetch_assoc($select_all_post_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_likes = $row['likes'];

                ?>
                        <h1 class="page-header">
                            Post
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <h2><?php echo $post_title ?></h2>
                        </h2>
                        <p class="lead">
                            <!-- <a href="author_posts.php?author=<?php //echo $post_user ?>&p_id=<?php //echo $the_post_id ?>"><?php //echo $post_user ?> -->
                             <!-- MODIFICACION EN .HTACCESS PARA LOS LINKS-->
                                by <a href="/cms/author_posts/<?php echo $post_user ?>/<?php echo $the_post_id ?>"><?php echo $post_user ?></a>
                            </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="image/<?php echo imagePlaceholder($post_image)?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <hr>
                        
                        <?php if(isset($_SESSION['user_role'])): ?>

                            <div class="row">
                                <p class="pull-right">
                                    <a class="<?php  echo userLikedThisPost($the_post_id) ? 'unlike' : 'like'; ?>" 
                                       href="/cms/post/<?php echo $post_id ?>" 
                                       style="font-size: 25px">
                                        <span 
                                            class="<?php  echo userLikedThisPost($the_post_id) ? 'glyphicon glyphicon-thumbs-down' : 'glyphicon glyphicon-thumbs-up'; ?>"
                                            <?php //LOS 3 ELEMENTOS A CONTINUACION SON DE BOOTSTRAP3, SE ACTIVAN CON JS, ESTÁ ABAJO DEL TODO ?>
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="<?php  echo userLikedThisPost($the_post_id) ? ' I liked this before' : ' Want to liked'; ?>">
                                        </span><?php  echo userLikedThisPost($the_post_id) ? ' Unlike' : ' Like'; ?></a>
                                </p>
                            </div>

                        <?php else: ?>
                            <div class="row">
                                <p class="pull-right" style="font-size: 25px">You need <a  href="/cms/login.php">Login</a> to like</p>
                            </div>
                        <?php endif; ?>

                        <br>
                        <div class="row">
                            <p class="pull-right">Likes: <?php getPostLikes($the_post_id)?></p> <!-- ESTA FUNCION TE LA AHORRAS PONIENDO $post_likes-->
                        </div>
                        <div class="clearfix"></div>
                        

            <?php  
                    ?>

            <!-- Blog Comments -->

                    <?php

                        if(isset($_POST['create_comment'])){

                            $the_post_id = $_GET['p_id'];
                            $comment_author = $_SESSION['username'];
                            $comment_email = $_SESSION['user_email'];
                            $comment_content = $_POST['comment_content'];

                            //VERIFICAMOS QUE EL FORMULARIO DE COMENTARIO NO TIENE CAMPOS VACIOS
                            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, 
                                comment_content, comment_status, comment_date)";
                                $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', 
                                                    '{$comment_content}', 'Approved', now())";

                                $create_query = mysqli_query($connection, $query);
                                if(!$create_query){
                                    die('QUERY FALIED' . mysqli_error($connection));
                                }
                                /*
                                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 " ;
                                $query .= "WHERE post_id = $the_post_id ";
                                $update_comment_count = mysqli_query($connection,$query);
                                */
                            }
                            else{
                                echo "<script>alert('Fields cannot by empty!!!')</script>";
                            }
                            redirect(location:"/cms/post.php?p_id=$the_post_id");
                        }
                        
                    if(isset($_SESSION['user_role'])){ 
                        ?> 
                        <!-- Comments Form -->
                        <div class="well">
                            <h4>Leave a Comment:</h4>
                            <form action="" method="post" role="form">

                                <div class="form-group">
                                    <label for="comment">Leave your comment</label>
                                    <textarea class="form-control"name="comment_content" rows="3"></textarea>
                                </div>

                                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

             <?php }
                    else{ ?>
                        <div class="row">
                                <p>Login to comment</p>
                        </div>
              <?php } ?>

                    <hr>

                    <!-- Posted Comments -->
                        <?php
                        $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
                        $query .= "AND comment_status = 'Approved' ";
                        $query .= "ORDER BY comment_id DESC ";

                        $select_comment_query = mysqli_query($connection,$query);
                        if(!$select_comment_query){
                            die('QUERY FAILED' . mysqli_error($connection));
                        }
                        while($row = mysqli_fetch_array($select_comment_query)){
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                            $comment_author = $row['comment_author'];
                        ?>
                        
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author ?>
                                    <small><?php echo $comment_date ?></small>
                                </h4>
                                <?php echo $comment_content ?>
                            </div>
                        </div>


                    <?php } 
                    } 
                }
            }
            else{
                header("Location: index.php");
            }?>
    
                </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>

<script>
    $(document).ready(function(){

        $("[data-toggle='tooltip']").tooltip();

        var post_id = <?php echo $the_post_id?>;
        var user_id = <?php echo loggedInUserId()?>;

        //LIKE
        $('.like').click(function(){
            $.ajax({
                url: "/cms/post.php?p_id=<?php echo $the_post_id?>",
                type: 'post',
                data: {
                    'liked': 1,
                    'post_id': post_id,
                    'user_id': user_id

                }
            });
        });

        //UNLIKE
        $('.unlike').click(function(){
            $.ajax({
                url: "/cms/post.php?p_id=<?php echo $the_post_id?>",
                type: 'post',
                data: {
                    'unliked': 1,
                    'post_id': post_id,
                    'user_id': user_id

                }
            });
        });
    });
</script>
 