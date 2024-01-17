<?php

session_start();
include 'dbh/db.php';
include 'functions.php';



if(isset($_POST['login'])){
    // Check if any field is left empty

    if(empty($_POST['username']) || empty($_POST['password'])){
        $tempName = $_POST['username'];
        header("Location: index.php?error=empty&username=$tempName");
        exit();
    }
    // Get username and password user inputs

    else{
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Check if user exists in database

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result) < 1){
            header("Location: index.php?error=username&username=$username");  
            exit();          
        }
        // Verify user password

        elseif(mysqli_num_rows($result) == 1){
            if($user = mysqli_fetch_assoc($result)){
                $hashedPassword = $user['password'];
                $verify_password = password_verify($password, $hashedPassword);

                if($verify_password == false){
                    header("Location: index.php?error=password&username=$username");
                    exit();
                }
                // Log the user in
                elseif($verify_password == true){
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['gender'] = $user['gender'];
                    $_SESSION['position'] = $user['position'];
                    $_SESSION['branch_id'] = $user['branch_id'];
                    $branch_id = $user['branch_id'];
                    $_SESSION['branch'] = $user['branch'];
                    
                    $sql2 = "SELECT * FROM details";
                    $results2 = mysqli_query($db, $sql2);
                    if($detail = mysqli_fetch_assoc($results2)) {
                        $company_name = $detail['company_name'];
                        $_SESSION['c_name'] = $company_name;
                        $_SESSION['address_1'] = $detail['address_1'];
                        $_SESSION['address_2'] = $detail['address_2'];
                        $_SESSION['address_3'] = $detail['address_3'];

                    }

                    // Identify branch phone
                    $query = "SELECT * FROM branches WHERE branch_id='$branch_id'";
                    $branches = mysqli_query($db, $query);
                    if($branch = mysqli_fetch_assoc($branches)){
                        $_SESSION['branch_phone'] = $branch['branch_phone'];
                    }

                    switch ($_SESSION['position']) {
                        case 'Cashier':
                            header("Location: cashier/index.php");
                            exit();
                            break;

                        case 'Attendant':
                            header("Location: attendant/index.php");
                            exit();
                            break;

                        case 'Manager':
                            header("Location: manager/index.php");
                            exit();
                            break;
                        
                        default:
                            header("Location: index.php?error=loginError");
                            break;
                    }
                }
            }
        }
    }

}





mysqli_close($db);
