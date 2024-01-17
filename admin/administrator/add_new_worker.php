<?php
$page_title = 'Admin | Add worker';
include 'includes/header.php';


if(isset($_POST['register'])){
    $first_name = mysqli_real_escape_string($db, ucwords(strtolower($_POST['first_name'])));
    $last_name = mysqli_real_escape_string($db, ucwords(strtolower($_POST['last_name'])));
    $other_name = mysqli_real_escape_string($db, ucwords(strtolower($_POST['other_name'])));
    $DOB = mysqli_real_escape_string($db, $_POST['DOB']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $residence = mysqli_real_escape_string($db, ucwords(strtolower($_POST['residence'])));
    $email = mysqli_real_escape_string($db, strtolower($_POST['email']));
    $phone_no = mysqli_real_escape_string($db, $_POST['phone_no']);
    $branch = mysqli_real_escape_string($db, $_POST['branch']);
    $position = mysqli_real_escape_string($db, $_POST['position']);
    $salary = mysqli_real_escape_string($db, $_POST['salary']);
    $username = mysqli_real_escape_string($db, strtolower($_POST['username']));
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);

    if( empty($first_name) || empty($last_name) || empty($DOB) || empty($gender) || empty($residence) || empty($email) || empty($phone_no) || empty($branch) || empty($position) || empty($salary) || empty($username) || empty($password) || empty($confirm_password) ){
        header("Location: add_worker.php?error=empty&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
    }
    else{
        
        // Validate input
        if( !preg_match("/^[a-z A-Z]*$/", $first_name) || !preg_match("/^[a-z A-Z]*$/", $last_name) || !preg_match("/^[a-z A-Z]*$/", $other_name) ){
            header("Location: add_worker.php?error=invalidName&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
        }
        elseif( !preg_match("/^[a-z A-Z]*$/", $residence) ){
            header("Location: add_worker.php?error=residence&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
        }
        elseif( !preg_match("/^[[0]{1}[0-9]{9}]*$/", $phone_no) ){
            header("Location: add_worker.php?error=phone_no&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
        }
        elseif( !preg_match("/^[0-9]*$/", $branch) ){
            header("Location: add_worker.php?error=branch&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
        }
        elseif( $salary < 0.1 ){
            header("Location: add_worker.php?error=salary&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");                                
        }
        elseif( !preg_match("/^[a-zA-Z]*$/", $username) ){
            header("Location: add_worker.php?error=invalidUsername&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
        }
        elseif( $password != $confirm_password ){
            header("Location: add_worker.php?error=password&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
        }
        elseif( isset($_FILES['passport_pic']) && $_FILES['passport_pic']=="" ){
            header("Location: add_worker.php?error=passport_pic&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
        }
        else{

            // Check if username is already taken
            $query = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) > 0){
                header("Location: add_worker.php?error=usernameTaken&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
            }

            else{

                // check if email is already taken
                $query = "SELECT * FROM users WHERE email='$email'";
                $emails = mysqli_query($db, $query);
                if(mysqli_num_rows($emails) > 0){
                    header("Location: add_worker.php?error=emailTaken&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
                }
                else{
                    
                    $file = $_FILES['passport_pic'];
                    $file_name = $file['name'];
                    $file_type = $file['type'];
                    $file_tmp_name = $file['tmp_name'];
                    $file_error = $file['error'];
                    $file_size = $file['size'];

                    // Specify allowed file types
                    $allowed_type = array('jpg', 'jpeg', 'png');

                    // Get file type of uploaded file
                    $file_ext_extract = explode('.', $file_name);
                    $file_ext = strtolower(end($file_ext_extract));

                    // Check if file extension is allowed
                    if(!in_array($file_ext, $allowed_type)){
                        header("Location: add_worker.php?error=file_type&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");
                    }
                    // Check if file size is allowed
                    elseif($file_size > 3000000){
                        header("Location: add_worker.php?error=file_size&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");            
                    }
                    // Check if there was an error
                    elseif($file_error > 0){
                        header("Location: add_worker.php?error=file_error&first_name=$first_name&last_name=$last_name&other_name=$other_name&DOB=$DOB&gender=$gender&residence=$residence&email=$email&phone_no=$phone_no&branch=$branch&position=$position&salary=$salary&username=$username");            
                    }
                    // Give unique new name to file (prefix with file extension)
                    else{
                        $file_new_name = $username .'_'. uniqid('', true) .'.' .$file_ext;
                        
                        // Specify new location to store file in
                        $file_dir = "../../img/$file_new_name";

                        // Move file to upload folder
                        move_uploaded_file($file_tmp_name, $file_dir);
                        $user_pic = "../img/$file_new_name";

                        // Hash password
                        $hashedPassword = password_hash($confirm_password, PASSWORD_DEFAULT);

                        // Identify branch name
                        $query = "SELECT * FROM branches WHERE branch_id='$branch'";
                        $branches = mysqli_query($db, $query);
                        if($oneBranch = mysqli_fetch_assoc($branches)){
                            $branch_name = $oneBranch['branch_name'];
                        }

                        // Insert new user into db
                        $query = "INSERT INTO users(`first_name`, `last_name`, `other_name`, `DOB`,  `username`, `password`, `email`, `phone_no`, `gender`, `residence`, `position`, `branch`, `branch_id`, `salary`, `user_pic`) VALUES('$first_name', '$last_name', '$other_name', '$DOB', '$username', '$hashedPassword', '$email', '$phone_no', '$gender', '$residence', '$position', '$branch_name', '$branch', '$salary', '$user_pic')";
                        $result = mysqli_query($db, $query);

                        if($result){
                            header("Location: add_worker.php?register=success");
                        }
                        elseif(!$result){
                            die("An error occured, try again");
                        }

                        
                    }
                }
            
                
            }
        }
        
    }
}