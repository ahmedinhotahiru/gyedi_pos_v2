<?php
$page_title = 'Branch | Branch Info';
include 'includes/header.php';

if(isset($_GET['edit_branch'])){
    $branch_id = mysqli_real_escape_string($db, $_GET['edit_branch']);
    $branch_name = mysqli_real_escape_string($db, ucwords(strtolower($_GET['branch_name'])));
    $phone_no = mysqli_real_escape_string($db, $_GET['phone_no']);


    if(!empty($branch_id)){
        
            // CHeck for branch name
            if(!empty($branch_name)){
                if( !preg_match("/^[a-z A-Z]*$/", $branch_name) ){
                    header("Location: branch.php?branch_id=$branch_id&error=invalidName");
                    exit();
                }
                else{
                    $query = "UPDATE `branches` SET `branch_name` = '$branch_name' WHERE branch_id='$branch_id'";
                    $result = mysqli_query($db, $query);
                    
                }
            }

            // CHeck for branch phone no.
            if(!empty($phone_no)){
                if( !preg_match("/^[[0]{1}[0-9]{9}]*$/", $phone_no) ){
                    header("Location: branch.php?branch_id=$branch_id&error=invalidPhone");                    
                    exit();
                }
                else{
                    $query = "UPDATE `branches` SET `branch_phone` = '$phone_no' WHERE branch_id='$branch_id'";
                    $result = mysqli_query($db, $query);
                    
                }
            }


            header("Location: branch.php?branch_id=$branch_id&update=");
            
        
    }

    else{
        header("Location: branches.php");
    }
    
}