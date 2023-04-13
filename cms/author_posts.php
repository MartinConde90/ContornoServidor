<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>


    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            
            <?php

            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
            }

            $query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}'";
            $select_all_post_query = mysqli_query($connection, $query);
            ?>
            <h1> All post by <?php echo $_GET['author']; ?></h1>
            <?php
                while($row = mysqli_fetch_assoc($select_all_post_query)){
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

            ?>
                   

                    <!-- First Blog Post -->
                    <h1>
                        <a href="#"><?php echo $post_title ?></a>
                    </h1>
                    
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="image/<?php echo imagePlaceholder($post_image)?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    

                    <hr>

        <?php  } ?>

        <!-- Blog Comments -->

                <?php

                    if(isset($_POST['create_comment'])){

                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
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

                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 " ;
                            $query .= "WHERE post_id = $the_post_id ";
                            $update_comment_count = mysqli_query($connection,$query);
                        }
                        else{
                            echo "<script>alert('Fields cannot by empty!!!')</script>";
                        }

                    }

                ?>
   
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
 