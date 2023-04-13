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
            $per_page = 5;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            else{
                $page = "";
            }

            if($page == "" || $page == 1){
                $page_1 = 0;
            }
            else{
                $page_1 = ($page * $per_page) - $per_page; //EN LA PAGINA 1 TENEMOS 5 PUBLICACIONES, -5 PARA SABER EN CUAL EMPIEZA
            }

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $post_query_count = "SELECT * FROM posts"; 
            }
            //SOLO PUBLICADO PARA SUSCRIPTORES
            else{
                $post_query_count = "SELECT * FROM posts WHERE post_status = 'Published'"; 
            }

            //$post_query_count = "SELECT * FROM posts WHERE post_status = 'Published'";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);

            if($count < 1){
                echo "<h1 class='text-center'>NO POST PUBLISHED</h1>";
            }
            else{

                $count = ceil($count / $per_page);

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts LIMIT $page_1, $per_page"; 
                }
                //SOLO PUBLICADO PARA SUSCRIPTORES
                else{
                    $query = "SELECT * FROM posts WHERE post_status = 'Published' LIMIT $page_1, $per_page"; 
                }

                //$query = "SELECT * FROM posts WHERE post_status = 'Published' LIMIT $page_1, $per_page"; 
                                                            //LIMIT Y 2 PARAMETROS, INDICAN POSICION Y CUANTOS
                $select_all_post_query = mysqli_query($connection, $query);

                //if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'subscriber' ){
                    while($row = mysqli_fetch_assoc($select_all_post_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr(strip_tags($row['post_content']),0,100); //de 0 caracteres a 100
                        $post_status = $row['post_status'];

                        
                ?>
                            <!--<h1 class="page-header">
                                Page Heading<small>Secondary Text</small>
                            </h1>-->

                            <!-- First Blog Post -->
                            <!-- <h1><?php echo $count ?></h1> -->
                            <h2>
                                <!-- MODIFICACION EN .HTACCESS PARA LOS LINKS-->
                                <!-- <a href="post.php?p_id=<?php //echo $post_id ?>"><?php //echo $post_title ?></a> -->
                                <a href="/cms/post/<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                <!-- <a href="author_posts.php?author=<?php //echo $post_user ?>&p_id=<?php //echo $the_post_id ?>"><?php //echo $post_user ?> -->
                                <!-- MODIFICACION EN .HTACCESS PARA LOS LINKS-->
                                by <a href="/cms/author_posts/<?php echo $post_user ?>/<?php echo $post_id ?>"><?php echo $post_user ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $post_id ?>">
                                <img class="img-responsive" src="image/<?php echo imagePlaceholder($post_image)?>" alt="">
                            </a>
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More<span class="glyphicon glyphicon-chevron-right">
                                                                                                            </span>
                            </a>
                            
                            <hr>
                <?php     
                    }
                //}
                //else{
                //    echo "<h1 class='text-center'>PUBLICATIONS AVAILABLE ONLY FOR USERS</h1>";
                //}
            }?>

                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">    
        <?php

            for($i = 1; $i <= $count; $i++){
                if($i == $page){
                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>"; 
                }
                else{
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }

        ?>
        </ul>

<?php include "includes/footer.php"; ?>
