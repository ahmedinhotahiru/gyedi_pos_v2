<?php
$page_title = 'Admin | Worker';
include 'includes/header.php';

if(isset($_GET['save_changes'])){
    $user_id = mysqli_real_escape_string($db, $_GET['save_changes']);
    $first_name = mysqli_real_escape_string($db, ucwords(strtolower($_GET['first_name'])));
    $last_name = mysqli_real_escape_string($db, ucwords(strtolower($_GET['last_name'])));
    $other_name = mysqli_real_escape_string($db, ucwords(strtolower($_GET['other_name'])));
    $DOB = mysqli_real_escape_string($db, $_GET['DOB']);
    $residence = mysqli_real_escape_string($db, ucwords(strtolower($_GET['residence'])));
    $phone_no = mysqli_real_escape_string($db, $_GET['phone_no']);

    if(!empty($user_id)){
        
        // check if required fields are not empty
        if(empty($first_name) || empty($last_name) || empty($DOB) || empty($residence) || empty($phone_no)){
            header("Location: worker.php?user_id=$user_id&error=empty");
            exit();
        }
        else{
            // Validate input
            if( !preg_match("/^[a-z A-Z]*$/", $first_name) || !preg_match("/^[a-z A-Z]*$/", $last_name) || !preg_match("/^[a-z A-Z]*$/", $other_name) ){
                header("Location: worker.php?user_id=$user_id&error=invalidName&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&residence=$residence&phone_no=$phone_no");
                exit();
            }
            elseif( !preg_match("/^[a-z A-Z]*$/", $residence) ){
                header("Location: worker.php?user_id=$user_id&error=residence&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&residence=$residence&phone_no=$phone_no");
                exit();
            }
            elseif( !preg_match("/^[[0]{1}[0-9]{9}]*$/", $phone_no) ){
                header("Location: worker.php?user_id=$user_id&error=phone_no&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&residence=$residence&phone_no=$phone_no");
                exit();
            }
            else{

                // Update db

                $query = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `other_name` = '$other_name', `DOB` = '$DOB', `residence` = '$residence', `phone_no` = '$phone_no' WHERE `users`.`user_id` = '$user_id'";
                $result = mysqli_query($db, $query);

                if($result){
                    header("Location: worker.php?user_id=$user_id&update=success");
                }
                elseif(!$result){
                    die("An error occured. Try again.");
                }

                
                
            }
        }
    }
    else{
        header("Location: workers.php");
    }
    
}