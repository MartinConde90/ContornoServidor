<?php  use PHPMailer\PHPMailer\PHPMailer; ?>
<?php use PHPMailer\PHPMailer\Exception; ?>
<?php use PHPMailer\PHPMailer\SMTP; ?>

<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<?php
require './vendor/autoload.php';
require './classes/config.php';

    if(!ifItIsMethod('get') && !isset($_GET['forgot'])){
        redirect('index');
    }
    if(ifItIsMethod('post')){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $length = 50;
            $token =  bin2hex(openssl_random_pseudo_bytes($length));

            if(emailNameRep($email)){
                if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email=?")){
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    /**
                     * configure PHPMailer
                     */
                    $mail = new PHPMailer(true);

                    //LA INFO DE ABAJO ESTÁ EN CONFIG.PHP

                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
                    $mail->isSMTP();                                           //Send using SMTP
                    $mail->Host       = Config::SMTP_HOST;                     //Set the SMTP server to send through
                    $mail->Username   = Config::SMTP_USER;                     //SMTP username
                    $mail->Password   = Config::SMTP_PASSWORD;                 //SMTP password
                    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                    $mail->Port       = Config::SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    $mail->SMTPAuth   = true;  
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';

                    $mail->setFrom('martincondegrande90@gmail.com','Martin Conde');
                    $mail->addAddress($email);
                    $mail->Subject = 'This is a email test';

                    $mail->Body = '<p>Please click to reset your password
                                    <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.'">
                                        http://localhost/cms/reset.php?email='.$email.'&token='.$token.'
                                    </a>
                                   </p>';

                    if($mail->send()){
                        $emailSent = true;
                    }
                    else{
                        echo "NOT SENT";
                    }

                }
                
            }
        }
    }

?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                        <?php if(!isset($emailSent)): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <?php else: ?>

                                    <h2>Please check your email</h2>

                                <?php endIf; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

