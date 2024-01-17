<?php
    session_start();
    include 'dbh/db.php';
    include 'functions.php';

?>

<!DOCTYPE html>
<html class="d-flex flex-column justify-content-center align-items-center" id="login_page" style="height:100%;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gyedi | Login</title>
  <link rel="icon" type="image/png" href="img/logo2.png">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body style="background:none;">

    <div class="container">
        <section id="overlay" class="py-5 px-4" style="border:1px solid #d3d2d2; border-radius: 10px;">
            
        
            <div class="content text-center">
                <img src="img/logo.png" alt="logo" class="img-fluid" style="height:80px"><hr>
                
                <form action="<?php echo u(h('login.php')) ?>" method="POST" class="p-4 px-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-user"></span>
                        </div>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?php echo $_GET['username'] ?? ''; ?>" size="30">
                    </div><br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-lock"></span>
                        </div>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control" size="30">
                    </div><br>



                    <!-- Error messages start here -->
                    
                    <?php
                        if(isset($_GET['error'])){
                            $error = mysqli_real_escape_string($db, $_GET['error']);

                            switch ($error) {
                                case 'login':
                                    echo '<p id="error">Login is required!</p>';
                                    break;
                                
                                case 'empty':
                                    echo '<p id="error">All fields are required</p>';
                                    break;

                                case 'username':
                                    echo '<p id="error">Invalid username</p>';
                                    break;

                                case 'password':
                                    echo '<p id="error">Invalid password</p>';
                                    break;

                                case 'loginError':
                                    echo '<p id="error">An error occured. Try again</p>';
                                    break;
                                
                                default:
                                    echo '<p id="error">An error occured. Try again</p>';
                                    break;
                            }
                        }
                    ?>
                    
                    <!-- Error messages End here -->



                    <button type="submit" name="login" class="btn btn-block btn-primary mt-3" style="font-weight: 500;"><span class="fa fa-sign-in"></span> Login</button><br>
                    <a href="resetPassword.php" style="font-weight:500;">Forgot password?</a>
                </form>
            </div>
            
        </section>

        
        <div class="d-flex justify-content-between">
            <div class="my-2 text-muted" style="font-size:12px;">
                <?php echo company_name() . ' Staff'; ?>
            </div>
            <div class="text-right my-2 text-muted" style="font-size:12px;">
                &copy; <?php echo date("Y"); ?> | Powered by <a href="" class="text-muted">Ahmed Designs</a>
            </div>
            
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
