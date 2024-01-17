<?php
    session_start();    
    include 'dbh/db.php';
    include 'functions.php';    



    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
    
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

?>

<!DOCTYPE html>
<html class="d-flex flex-column justify-content-center align-items-center" id="login_page" style="height:100%;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gyedi | Reset Password</title>
  <link rel="icon" type="image/png" href="img/logo2.png">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body style="background:none;">

    <section id="overlay" class="py-5 px-4" style="border:1px solid #d3d2d2; border-radius: 10px;">
        
    
        <div class="content text-center">
            <img src="img/logo.png" alt="logo" class="img-fluid" style="height:80px"><hr>
            <!-- Login form validated using JS with function Login() below -->
            <form class="p-4 px-5" action="resetPassword.php" method="GET">
                <div class="input-group">
                    <input type="text" name="username" id="username" placeholder="Enter username" class="form-control" size="40" onclick="blank();">
                </div><br>
                <p id="error"></p>
                
                <button type="submit" name="resetPassword" class="btn btn-block btn-success mt-3"><span class="fa fa-unlock"></span> Reset Password</button><br>

                <?php
                    if(isset($_GET['resetPassword'])){
                        $username = mysqli_real_escape_string($db, $_GET['username']);

                        // check if username exists in db
                        $query = "SELECT * FROM users WHERE username = '$username'";
                        $result = mysqli_query($db, $query);

                        if(mysqli_num_rows($result) < 1){
                            die('Username not found');
                        }else{

                            // generate reset token and senD to email
                            if($user = mysqli_fetch_assoc($result)){
                                $email = $user['email'];
                                $db_username = $user['username'];
                                $user_id = $user['user_id'];

                                if($username == $db_username){
                                    $token = random_str(15);
                                    $receipient = $email;
                                    $subject = "ShopMyst Password Reset Code";
                                    $message = "Hello, \nYour new password is: " .$token;
                                    $headers = "From: " . $email;

                                    if(mail($receipient, $subject, $message, $headers)){
                                        echo '<p class="text-success">New password sent to your email</p>';

                                        // Hash new password and Update password in db
                                        $new_password = password_hash($token, PASSWORD_DEFAULT);
                                        $query = "UPDATE `users` SET `password` = '$new_password' WHERE `users`.`user_id` = '$user_id'";
                                        $result = mysqli_query($db, $query);

                                        if(!$result){
                                            die("An error occured. Try again");
                                        }
                                    }
                                    else{
                                        echo '<p class="text-danger">Failed to send message</p>';
                                    }
                                }
                            }
                        }
                    }
                ?>
            </form>
        </div>
        
    </section>
    <div class="row">
        <div class="col-4">
            <a href="index.php" style="font-size:12px;"><span class="fa fa-arrow-left"></span> Back to login</a>
        </div>
        <div class="col-8 text-right my-auto text-muted" style="font-size:12px;">
            &copy; <?php echo date("Y"); ?> | Powered by <a href="" class="text-muted">Ahmed Designs</a>
        </div>
        
    </div>
    
    
    
   
    
  
  
  




  <!-- footer starts here -->

  <!-- footer starts here -->


    <?php mysqli_close($db); ?>






  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
</body>
</html>
