<?php
  $page_title = 'Gyedi | Profile';
  include 'includes/header.php';



//   Change Password script
  if(isset($_POST['change_password'])){
    //   Get input from user
    $old_password = mysqli_real_escape_string($db, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($db, $_POST['new_password']);
    $new_password_confirm = mysqli_real_escape_string($db, $_POST['new_password_confirm']);
    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);

    // Check if old password is valid
    $query = "SELECT * FROM users WHERE `users`.`user_id` = $user_id;";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $hashedPassword = $user['password'];
        $verify_password = password_verify($old_password, $hashedPassword);

        if($verify_password == false){
            header("Location: profile.php?error=wrongPassword");
            exit();
        }
        elseif($verify_password == true){
            // Check if new passwords match
            if($new_password != $new_password_confirm){
                header("Location: profile.php?error=matchPassword");
                exit();
            }
            else{
                // Hash new password
                $new_password = password_hash($new_password_confirm, PASSWORD_DEFAULT);

                // Update user password with new hashed password
                $query = "UPDATE `users` SET `password` = '$new_password' WHERE `users`.`user_id` = $user_id";
                $result = mysqli_query($db, $query);
                if(!$result){
                    header("Location: profile.php?change=error");
                    exit();
                }
                else{
                    header("Location: profile.php?change=success");
                    exit();  
                }
                
            }
        }

    }
  }





//   Identify user details
  $full_name = $_SESSION['first_name'] .' '. $_SESSION['last_name'];
  $email = $_SESSION['email'];
  $gender = $_SESSION['gender'];
  $position = $_SESSION['position'];




//   Update profile details
  if(isset($_POST['save_changes'])){
    //   Get new details
    $new_email = mysqli_real_escape_string($db, $_POST['email']);
    $new_gender = mysqli_real_escape_string($db, $_POST['gender']);
    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);
    
        // If changes were made, update db
    if($new_email != $email){

        // check if email is already in use

        $sql = "SELECT * FROM users WHERE email = $new_email";
        $userEmails = mysqli_query($db, $query);
        if(mysqli_num_rows($userEmails) > 0) {
            header("Location: profile.php?update=emailExists");
        }
        else {
            $query = "UPDATE `users` SET `email` = '$new_email' WHERE `users`.`user_id` = $user_id;";
            $result2 = mysqli_query($db, $query);
            $_SESSION['email'] = $new_email;
            $email = $_SESSION['email'];        
        }

        
        
    }
    if($new_gender != $gender){
        $query = "UPDATE `users` SET `gender` = '$new_gender' WHERE `users`.`user_id` =$user_id;";
        $result3 = mysqli_query($db, $query);
        $_SESSION['gender'] = $new_gender;
        $gender = $_SESSION['gender'];
        
    }
    
    
    header("Location: profile.php?update=success");
  }


?>



  <!-- Main Body Starts here -->
  
  <section>
    <div class="container my-5">

        <form action="profile.php" method="POST" enctype="multipart/form-data">  

            <!-- Action buttons here -->
            <div class="row mb-5">
                <div class="col-md-4 col-lg-3 text-center py-2">
                    <a href="index.php" class="btn btn-block btn-outline-dark"><span class="fa fa-arrow-left"></span> Back to Dashboard</a>
                </div>
                <div class="col-md-4 col-lg-3 offset-lg-3 text-center py-2">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#changePasswordModal"><span class="fa fa-lock"></span> Change Password</button>
                </div>
                <div class="col-md-4 col-lg-3 text-center py-2">
                    <button type="submit" name="save_changes" class="btn btn-block btn-success"><span class="fa fa-check"></span> Save changes</button>
                </div>
            </div>
            <!-- Action buttons ends here -->


            <!-- Display success/error messages here -->
            <?php
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    if($error == 'wrongPassword'){
                        echo '<p id="error" class="text-center">Old password is invalid</p>';
                    }
                    elseif($error == 'matchPassword'){
                        echo '<p id="error" class="text-center">New passwords do not match</p>';  
                    }
                    elseif($error == 'fileType'){
                        echo '<p id="error" class="text-center">Image format should be .jpg or .png</p>';  
                    }
                    elseif($error == 'fileSize'){
                        echo '<p id="error" class="text-center">Image Image should not be larger than 2MB</p>';  
                    }
                    elseif($error == 'fileError'){
                        echo '<p id="error" class="text-center">Unsupported image. Please choose another image</p>';  
                    }
                }
                elseif(isset($_GET['change'])){
                    $change = $_GET['change'];
                    if($change == 'success'){
                        echo '<p style="color: green; font-weight: 500;" class="text-center">Password changed successfully</p>';
                    }
                    if($change == 'error'){
                        echo '<p id="error" class="text-center">An error occured. Try again</p>'; 
                    }
                }
                elseif(isset($_GET['update'])){
                    $update = $_GET['update'];
                    if($update == 'success'){
                        echo '<p style="color: green; font-weight: 500;" class="text-center">Profile updated successfully</p>';
                    }
                    elseif($update == "emailExists") {
                        echo '<p id="error" class="text-center">Email is already taken</p>'; 
                    }
                }
            ?>
            <!-- Display change passwor error messages ends here -->
            

        
            <!-- Main section starts here -->
            <div class="row">

                <!-- Profile Starts here -->
                <div class="col-md-9 mb-3">
                    <!-- Card starts here -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Your Profile</h4>
                        </div>
                        <!-- Card body starts here -->
                        <div class="card-body">

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $full_name; ?>" disabled id="name">
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" id="email" required validate>
                            </div>

                            <!-- Gender -->
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select gender...</option>
                                    <option value="Male" <?php if($gender == 'Male'){echo 'selected';} ?>>Male</option>
                                    <option value="Female" <?php if($gender == 'Female'){echo 'selected';} ?>>Female</option>
                                </select>
                            </div>

                            <!-- Position -->
                            <div class="form-group">
                                <label for="position">Position</label>
                                <select name="position" id="position" class="form-control" disabled>
                                    <option value="">Select position...</option>
                                    <option value="Cashier" <?php if($position == 'Cashier'){echo 'selected';} ?>>Cashier</option>
                                    <option value="Attendant" <?php if($position == 'Attendant'){echo 'selected';} ?>>Attendant</option>
                                    <option value="Manager" <?php if($position == 'Manager'){echo 'selected';} ?>>Manager</option>
                                </select>
                            </div>
                        </div>
                        <!-- Card body ends here -->
        
                    </div>
                    <!-- Card ends here -->
                </div>
                <!-- Profile ends here -->


                <!-- Profile picture starts here -->
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <a href="<?php echo user_pic($_SESSION['user_id']); ?>" class="img-thumbnail mb-3"><img src="<?php echo user_pic($_SESSION['user_id']); ?>" alt="profile_pic" class="profile_pic d-block img-fluid" style="max-height:300px;"></a>
  
                </div>
                <!-- Profile picture ends here -->

            </div>
            <!-- Main section ends here -->
        
        </form>
        <!-- Form ends here -->

    </div>
    <!-- Container ends here -->

  </section>

  <!-- Main Body Starts here -->



<?php include 'includes/footer.php'; ?>