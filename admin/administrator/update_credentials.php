<?php
$page_title = 'Admin | Worker';
include 'includes/header.php';

if(isset($_GET['edit_credentials'])){
    $user_id = mysqli_real_escape_string($db, $_GET['edit_credentials']);
    $branch = mysqli_real_escape_string($db, $_GET['branch']);
    $position = mysqli_real_escape_string($db, $_GET['position']);
    $username = mysqli_real_escape_string($db, strtolower($_GET['username']));


    if(!empty($user_id)){
        
            // CHeck for username
            if(!empty($username)){
                if( !preg_match("/^[a-zA-Z]*$/", $username) ){
                    header("Location: credentials.php?user_id=$user_id&error=invalidUsername");
                    exit();
                }
                else{
                    $query = "UPDATE `users` SET `username` = '$username' WHERE user_id='$user_id'";
                    $result = mysqli_query($db, $query);
                    
                }
            }

            // CHeck for username
            if(!empty($position)){
                if( !preg_match("/^[a-zA-Z]*$/", $position) ){
                    header("Location: credentials.php?user_id=$user_id&error=invalidPosition");
                    exit();
                }
                else{
                    $query = "UPDATE `users` SET `position` = '$position' WHERE user_id='$user_id'";
                    $result = mysqli_query($db, $query);
                    
                }
            }

            // check for branch
            if(!empty($branch)){
                // identify branch name
                $query = "SELECT * FROM branches WHERE branch_id='$branch'";
                $branches = mysqli_query($db, $query);

                if(mysqli_num_rows($branches) > 0){
                    if($result = mysqli_fetch_assoc($branches)){
                        $branch_name = $result['branch_name'];

                        // update the branch
                        $query = "UPDATE `users` SET `branch` = '$branch_name', `branch_id` = '$branch' WHERE `users`.`user_id` = '$user_id'";
                        $result = mysqli_query($db, $query);
                        
                    }
                }
                else{
                    header("Location: credentials.php?user_id=$user_id&error=invalidBranch");
                    
                }
                
                
            }

            header("Location: credentials.php?user_id=$user_id&update=");
            
        
    }

    else{
        header("Location: workers.php");
    }
    
}