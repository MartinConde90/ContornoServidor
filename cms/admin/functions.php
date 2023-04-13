<?php
//====  DATABASE HELPER FUNCTIONS ====//
function redirect($location){
    header("Location:" . $location);
    exit;
}

function query($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function fetchRecords($result){
    return mysqli_fetch_array($result);
}
//====  END DATABASE HELPER FUNCTIONS ====//

//====  GENERAL HELPER FUNCTIONS ====//

function get_user_name(){
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

//====  END GENERAL HELPER FUNCTIONS ====//

//====  AUTHENTICATION HELPER FUNCTIONS ====//
function is_admin(){
    //funcion no utilizada en "users" por usar otra forma en "navigation"
    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id = ".$_SESSION['user_id']."");
        $row = fetchRecords($result);
        if($row['user_role'] == 'admin'){
            return true;
        }
        else{
            return false;
        }
    }  
    return false;
}

//====  END AUTHENTICATION HELPER FUNCTIONS ====//


//==== USER SPECIFIC HELPERS ====//

function recordCount($table){
    global $connection;
    $query ="SELECT * FROM " . $table;
    $select_all = mysqli_query($connection, $query);

    return  mysqli_num_rows($select_all);
}

function get_all_user_posts(){
    return query("SELECT * FROM posts INNER JOIN users ON posts.post_user = users.username 
                    WHERE users.user_id=".loggedInUserId()."");
}
function get_all_user_comments(){
    return query("SELECT * FROM comments 
    join users on users.username = comments.comment_author
    WHERE users.user_id=".loggedInUserId()."");
}

function get_all_user_categories(){
    return query("SELECT * FROM categories WHERE user_id=".loggedInUserId()."");
}

function get_all_user_published_posts(){
    return query("SELECT * FROM posts INNER JOIN users ON posts.post_user = users.username 
                WHERE users.user_id=".loggedInUserId()." AND post_status='Published'");
}
function get_all_user_draft_posts(){
    return query("SELECT * FROM posts INNER JOIN users ON posts.post_user = users.username 
                WHERE users.user_id=".loggedInUserId()." AND post_status='Draft'");
}
function get_all_user_approve_comments(){
    return query("SELECT * FROM comments 
    join users on users.username = comments.comment_author
    WHERE users.user_id=".loggedInUserId()." AND comment_status='Approved'");
}
function get_all_user_unapprove_comments(){
    return query("SELECT * FROM comments 
    join users on users.username = comments.comment_author
    WHERE users.user_id=".loggedInUserId()." AND comment_status='Unapproved'");
}

//==== END USER SPECIFIC HELPERS ====//

function count_records($result){
    return mysqli_num_rows($result);
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE username ='" . $_SESSION['username'] . "'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        if(mysqli_num_rows($result) >=1){
            return $user['user_id'];
        }
    }
    return false;
}

function userLikedThisPost($post_id){
    $result = query("SELECT * FROM likes WHERE user_id = " . loggedInUserId() . " AND post_id = {$post_id}");
    confirmQuery($result);
    return mysqli_num_rows($result) >= 1 ? true : false;
}

function checkIfUserIsLoggedInAndREdirect($redirectLocation=null){
    if(IsLoggedIn()){
        redirect($redirectLocation);
    }
}

function getPostLikes($post_id){
    $result = query("SELECT * FROM likes WHERE post_id = $post_id");
    confirmQuery($result);  
    echo mysqli_num_rows($result);

}

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}

function users_online(){

    if(isset($_GET['onlineusers'])){ //ESTO ESTÁ EN JAVASCRIPT PARA REFRESCAR USUARIOS ONLINE AUTOMATICAMENTE, NO LO EXPLICA PORQUE LO TIENE EN OTRO CURSO
        global $connection;

        if(!$connection){
            session_start();
            include ("../includes/db.php"); 

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 02;
            $time_out = $time - $time_out_in_seconds;
    
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection,$query);
            $count = mysqli_num_rows($send_query);
    
            if($count == NULL){
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
            }
            else{
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_users = mysqli_num_rows($users_online_query);
        }
    } //get request isset()
}
users_online();

function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
};

function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }
        else{

            $query = "INSERT INTO categories(cat_title,user_id)";
            $query .= "VALUES('{$cat_title}','{$_SESSION['user_id']}') ";

            $create_category_query = mysqli_query($connection,$query);

            if(!$create_category_query){
                die('Query failed!!!' . mysqli_error($connection));
            }
        }

    }
}

function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<tr>";
                    echo "<td>{$cat_id}</td>";
                    echo "<td>{$cat_title}</td>";
                    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                    echo "</tr>";
                }

}

function deleteCategory(){
    global $connection;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}

function checkStatus($table, $column,$status){
    global $connection;
    $query ="SELECT * FROM " .  $table . " WHERE " . $column . " =  '$status'";
    $select_all = mysqli_query($connection, $query);

    return mysqli_num_rows($select_all);
}

function checkRole($table, $column,$role){
    global $connection;
    $query ="SELECT * FROM " .  $table . " WHERE " . $column . " =  '$role'";
    $select_all = mysqli_query($connection, $query);

    return mysqli_num_rows($select_all);
}



function userNameRep($name){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$name'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $count_username_users = mysqli_num_rows($result);

    if($count_username_users > 0){
        return true;
    }
    else{
        return false;
    }
}

function emailNameRep($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $count_email_users = mysqli_num_rows($result);

    if($count_email_users > 0){
        return true;
    }
    else{
        return false;
    }
}


function register_user($username, $email, $password){
    global $connection;


            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);

            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10)); //el 10 es el tiempo que tarda en procesarse

            /*ANTERIOR FORMA DE HACERLO CON EL RANDSALT EN LA BASE DE DATOS
            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection,$query);

            if(!$select_randsalt_query){
                die("Query Failed" . mysqli_error($connection));
            }
            $row = mysqli_fetch_array($select_randsalt_query);
            $salt = $row['randSalt'];
            $password = crypt($password, $salt);
            */
            
            $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
            $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber' )";
            $register_user_query = mysqli_query($connection, $query);

            confirmQuery($register_user_query);

            $message = "Your registration has been submited";
        
}

function login_user($username, $password){
    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection,$query);

    if(!$select_user_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_password = $row['user_password'];
        $db_user_email = $row['user_email'];

        if(password_verify($password,$db_user_password)){
            if (session_status() == PHP_SESSION_NONE) session_start();
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['user_email'] = $db_user_email;
            
            redirect("/cms/admin");
        }
        else{
            return false;
        }
    }
    return true;
}

    /*ANTERIOR FORMA DE HACERLO CON EL RANDSALT EN BASE DE DATOS Y ENCRYPTACION NORMAL
    $password = crypt($password, $db_user_password); 
    //crypt solo coge los 22 primeros digitos del segundo parametro. Despues del Hash, que en este caso es $2y$10$
    //En el registro le pasamos el $Salt como segundo parametro, que ya tiene 2 digitos
    //Ahora en vez de pasar $Salt, enviamos la contraseña encriptada, que tiene $Salt como 22 primeros digitos
    //Asi que coge esos 22 digitos y encripta el primer parametro
    //Despues abajo comparamos esta nueva encriptacion con la que ya hay en la base de datos

    if($username === $db_username && $password === $db_user_password){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: ../admin/index.php");
    }
    else{
        header("Location: ../index.php");
    }
    */

function imagePlaceholder($image=''){
    if(!$image){
        return 'bebe.jpeg';
    }
    else{
        return $image;
    }
}

    

?>