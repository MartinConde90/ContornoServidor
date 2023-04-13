<?php
if (isset($_GET['p_id'])) {
 
    $the_post_id = $_GET['p_id'];
}
 
$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);
 
while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];
}
 
if (isset($_POST['update_post'])) {
    $post_title = mysqli_real_escape_string($connection, $_POST['title']);
    $post_user = mysqli_real_escape_string($connection, $_POST['post_user']);
    $post_category = mysqli_real_escape_string($connection, $_POST['post_category']);
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = strip_tags(mysqli_real_escape_string($connection, $_POST['post_content']));
 
    move_uploaded_file($post_image_temp, "../image/$post_image");
 
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connection, $query);
 
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }
 
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category}', ";
    $query .= "post_date = now(), ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$the_post_id} ";
 
    $update_post = mysqli_query($connection, $query);
    confirmQuery($update_post);
 
    echo "<p class='bg-success'>Post Updated <a href='../post.php?p_id={$the_post_id}'> View Post </a> or
        <a href='posts.php'> Edit More Posts </a></p>";
}
?>
 
 
<form action="" method="post" enctype="multipart/form-data">
 
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
 
    <div class="form-group">
        <label for="title">Categories</label>
        <select name="post_category" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
 
            confirmQuery($select_categories);
 
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
 
                if ($cat_id == $post_category) {
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                } else {
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            ?>
        </select>
    </div>
 
    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">
            <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>
            <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
 
            confirmQuery($select_users);
 
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
 
                echo "<option value='{$username}'>{$username}</option>";
            }
            ?>
        </select>
    </div>
 
    <!--
    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_user; ?>" type="text" class="form-control" name="author">
    </div>
    -->
 
 
    <div class="form-group">
        <label for="title">Post Status</label>
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
            if ($post_status == 'Published') {
                echo "<option value='Draft'>Draft</option>";
            } else {
                echo "<option value='Published'>Publish</option>";
            }
            ?>
        </select>
    </div>
 
    <div class="form-group">
        <img width="100" src="../image/<?php echo $post_image; ?>" alt="">
        <label for="title">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
 
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
 
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
 
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
 
</form>