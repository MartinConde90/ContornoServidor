<?php

include("delete_modal.php");

if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = escape($_POST['bulk_options']);

        switch($bulk_options){
            case 'Published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '$postValueId'";
                $update_published_status = mysqli_query($connection, $query);
                confirmQuery($update_published_status);
                break;
            case 'Draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '$postValueId'";
                $update_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_draft_status);
                break;
            case 'Delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $update_delete_status = mysqli_query($connection, $query);
                confirmQuery($update_delete_status);
                break;
            case 'Clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_post_query)){
                    $post_title    = escape($row['post_title']);
                    $post_category = escape($row['post_category_id']);
                    $post_date     = escape($row['post_date']); 
                    $post_author   = escape($row['post_author']);
                    $post_user     = escape($row['post_user']);
                    $post_status   = escape($row['post_status']);
                    $post_image    = escape($row['post_image']);
                    $post_tags     = escape($row['post_tags']);
                    $post_content  = escape($row['post_content']); 

                    if(empty($post_tags)){
                        $post_tags = "Not tags";
                    }
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user,
                            post_date, post_image,post_content, post_tags,post_status)";

                $query .= "VALUES( '{$post_category}','{$post_title}','{$post_author}','{$post_user}',now(),
                        '{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";
                $copy_query = mysqli_query($connection, $query);      
                
                if(!$copy_query){
                    die("QUERY FAILED!!" . mysqli_error($connection, $query));
                }
                break;
        }
    }
}
?>

<form action="" method ='post'>

    

        <div id="bulkOptionsContainer" class="col-xs-4">
            <select name="bulk_options" id="bulk_options" class="form-control">
                <option value="">Select Options</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="Delete">Delete</option>
                <option value="Clone">Clone</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_posts">Add New</a>
        </div>

        <table class="table table-bordered table-hover">
        <thead>
            <tr> <!-- EL SELECTOR DE "TODOS" ESTÁ EN SCRIPTS.JS, QUE SE LLAMA DESDE EL ADMIN_FOOTER-->
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Views</th>
                <th>Likes</th>
                <th>Publish</th>
                <th>Draft</th>
                <th>Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            //$query = "SELECT * FROM posts ORDER BY post_id DESC";
            $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, ";
            $query .= "posts.post_status, posts.post_image, posts.post_tags, posts.post_content, posts.post_comment_count, ";
            $query .= "posts.post_date, posts.post_views_count, posts.likes, categories.cat_id, categories.cat_title ";
            $query .= "FROM posts ";
            $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";

            $select_posts_categ = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_posts_categ)){
                $post_id          = escape($row['post_id']);
                $post_author      = escape($row['post_author']);
                $post_user        = escape($row['post_user']);
                $post_title       = escape($row['post_title']);
                $post_category    = escape($row['post_category_id']);
                $post_status      = escape($row['post_status']);
                $post_image       = escape($row['post_image']);
                $post_tags        = escape($row['post_tags']);
                $post_content     = escape($row['post_content']);
                $post_comments    = escape($row['post_comment_count']);
                $post_date        = escape($row['post_date']);
                $post_views_count = escape($row['post_views_count']);
                $post_likes       = escape($row['likes']);
                $cat_id           = escape($row['cat_id']);
                $cat_title        = escape($row['cat_title']);

                echo "<tr>";
            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>; 
                <!-- EN ESTE ARRAY VAMOS A IR METIENDO LOS ID DE LAS PUBLICACIONES QUE SELECCIONEMOS-->
            <?php
                echo "<td>$post_id</td>";

                if(!empty($post_author)){
                    echo "<td>$post_author</td>";
                }
                elseif(!empty($post_user)){
                    echo "<td>$post_user</td>";
                }
 
                echo "<td><a href=' ../post.php?p_id=$post_id'>$post_title</a></td>";

                //TODO ESTO SE HACE ARRIBA CON EL JOIN
                //$query = "SELECT * FROM categories WHERE cat_id = $post_category";
                //$select_categories_id = mysqli_query($connection, $query);

                //while($row = mysqli_fetch_assoc($select_categories_id)){
                //    $cat_id = $row['cat_id'];
                //    $cat_title = $row['cat_title'];
                
                echo "<td>$cat_title</td>";
            //}

                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../image/$post_image' ></td>";
                echo "<td>$post_tags</td>";

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                $send_comment_query = mysqli_query($connection , $query);
                $row = mysqli_fetch_array($send_comment_query);
                
                $count_comments = mysqli_num_rows($send_comment_query);
                echo "<td><a href='post_comments.php?id=$post_id&user=$post_user'>$count_comments</a></td>";
                


                echo "<td>$post_date</td>";
                echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                echo "<td>$post_likes</td>";
                echo "<td><a href='posts.php?publish=$post_id'>Publish</a></td>";
                echo "<td><a href='posts.php?draft=$post_id'>Draft</a></td>";
                echo "<td><a class ='btn btn-primary' href=' ../post.php?p_id=$post_id'>View Post</a></td>";
                echo "<td><a class ='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                //echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";

                ?>
                <!--  DE ESTA FORMA NO SALTA AVISO, PERO AL ENVIAR POR POST EN VEZ DE GET, LIMITAMOS
                    EL ACCESO SI ALGUIEN CONOCE LA RUTA DE ELIMINADO Y EL ID DE LA PUBLICACION-->
                    <form method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                        <?php  
                            echo '<td><input class ="btn  btn-danger" type="submit" name="delete" value="delete"></td>';
                        ?>
                    </form>
                <?php

               // echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                echo "</tr>";
                
            }
            
            ?>
                    
        </tbody>
    </table>
</form>

        <?php
        if(isset($_GET['publish'])){
            $the_post_id = escape($_GET['publish']);
            $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = $the_post_id";
            $approve_comment_query = mysqli_query($connection, $query);
            header("Location: posts.php");
        }

        if(isset($_GET['draft'])){
            $the_post_id = escape($_GET['draft']);
            $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = $the_post_id";
            $approve_comment_query = mysqli_query($connection, $query);
            header("Location: posts.php");
        }

            if(isset($_POST['delete'])){
                    $the_post_id = $_POST['post_id'];
                    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                    $delete_query = mysqli_query($connection, $query);
                    //header ("Location: posts.php");

                    $query2 = "DELETE FROM comments WHERE comment_post_id = {$the_post_id}";
                    $delete_query = mysqli_query($connection, $query2);
                    header ("Location: posts.php");
                    
            }

            if(isset($_GET['reset'])){
                $the_post_id = escape($_GET['reset']);
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $the_post_id";
                $reset_query = mysqli_query($connection, $query);
                header ("Location: posts.php");
                
        }
        ?>
<script>

        $(document).ready(function(){
            $(".delete_link").on('click', function(){
                var id = $(this).attr("rel");
                var delete_url = "posts.php?delete=" + id + " ";
                $(".modal_delete_link").attr("href", delete_url);

                $("#myModal").modal('show');

            });
        });

</script>