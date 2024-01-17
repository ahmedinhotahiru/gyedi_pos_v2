<?php
  $page_title = 'Admin | Profile';
  include 'includes/header.php';



//   Change Password script
  if(isset($_POST['change_password'])){
    //   Get input from user
    $old_password = mysqli_real_escape_string($db, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($db, $_POST['new_password']);
    $new_password_confirm = mysqli_real_escape_string($db, $_POST['new_password_confirm']);
    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);

    // Check if old password is valid
    $query = "SELECT * FROM admin WHERE `admin`.`user_id` = $user_id;";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $hashedPassword = $user['password'];
        $verify_password = password_verify($old_password, $hashedPassword);

        if($verify_password == false){
            header("Location: admin_profile.php?error=wrongPassword");
            exit();
        }
        elseif($verify_password == true){
            // Check if new passwords match
            if($new_password != $new_password_confirm){
                header("Location: admin_profile.php?error=matchPassword");
                exit();
            }
            else{
                // Hash new password
                $new_password = password_hash($new_password_confirm, PASSWORD_DEFAULT);

                // Update user password with new hashed password
                $query = "UPDATE `admin` SET `password` = '$new_password' WHERE `admin`.`user_id` = $user_id";
                $result = mysqli_query($db, $query);
                if(!$result){
                    header("Location: admin_profile.php?change=error");
                    exit();
                }
                else{
                    header("Location: admin_profile.php?change=success");
                    exit();
                }

            }
        }

    }
  }





//   Identify user details
  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
  $other_name = $_SESSION['other_name'];
  $email = $_SESSION['email'];
  $user_id = $_SESSION['user_id'];




//   Update profile details
  if(isset($_POST['save_changes'])){
    //   Get new details
    $new_email = mysqli_real_escape_string($db, $_POST['email']);
    $new_first_name = mysqli_real_escape_string($db, ucwords(strtolower($_POST['first_name'])));
    $new_last_name = mysqli_real_escape_string($db, ucwords(strtolower($_POST['last_name'])));
    $new_other_name = mysqli_real_escape_string($db, ucwords(strtolower($_POST['other_name'])));
    $username = mysqli_real_escape_string($db, $_POST['username']);

        // If changes were made, update db

    if($new_email != $email){
        $query = "UPDATE `admin` SET `email` = '$new_email' WHERE `admin`.`user_id` = $user_id;";
        $result2 = mysqli_query($db, $query);
        $_SESSION['email'] = $new_email;
        $email = $_SESSION['email'];

    }

    if($new_first_name != $first_name){
        $query = "UPDATE `admin` SET `first_name` = '$new_first_name' WHERE `admin`.`user_id` = $user_id;";
        $result3 = mysqli_query($db, $query);
        $_SESSION['first_name'] = $new_first_name;
        $first_name = $_SESSION['first_name'];

    }

    if($new_last_name != $last_name){
        $query = "UPDATE `admin` SET `last_name` = '$new_last_name' WHERE `admin`.`user_id` = $user_id;";
        $result4 = mysqli_query($db, $query);
        $_SESSION['last_name'] = $new_last_name;
        $last_name = $_SESSION['last_name'];

    }

    if($new_other_name != $other_name){
        $query = "UPDATE `admin` SET `other_name` = '$new_other_name' WHERE `admin`.`user_id` = $user_id;";
        $result5 = mysqli_query($db, $query);
        $_SESSION['other_name'] = $new_other_name;
        $other_name = $_SESSION['other_name'];

    }

    if(!empty($username)){
        if( preg_match("/^[a-zA-Z]*$/", $username) ){
            $query = "UPDATE `admin` SET `username` = '$username' WHERE `admin`.`user_id` = $user_id;";
            $result6 = mysqli_query($db, $query);
        }
        else{
            die("Username is invalid");
        }
    }


    if( isset($_FILES['user_pic']) && !$_FILES['user_pic']=="" ){
        $file = $_FILES['user_pic'];
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
            header("Location: admin_profile.php?error=fileType");
        }
        // Check if file size is allowed
        elseif($file_size > 3000000){
            header("Location: admin_profile.php?error=fileSize");
        }
        // Check if there was an error
        elseif($file_error > 0){
            header("Location: admin_profile.php?error=fileError");
            exit();
        }
        // Give unique new name to file (prefix with file extension)
        else{
            $file_new_name = $_SESSION['first_name'] .'_'. uniqid('', true) .'.' .$file_ext;
            $user_id = $_SESSION['user_id'];

            // Specify new location to store file in
            $file_dir = "../../img/$file_new_name";

            // Move file to upload folder
            move_uploaded_file($file_tmp_name, $file_dir);

            // Update db with new file name
            $query = "UPDATE `admin` SET `user_pic` = '$file_dir' WHERE `admin`.`user_id` = $user_id";
            $result = mysqli_query($db, $query);


        }

    }
    header("Location: admin_profile.php?update=success");
  }


?>



  <!-- Main Body Starts here -->

  <section>
    <div class="container my-5">

        <form action="admin_profile.php" method="POST" enctype="multipart/form-data">

            <!-- Action buttons here -->
            <div class="row mb-5">
                <div class="col-md-3 text-center py-2">
                    <a href="index.php" class="btn btn-block btn-outline-light"><span class="fa fa-arrow-left"></span> Back to Dashboard</a>
                </div>
                <div class="col-md-3 offset-md-3 text-center py-2">
                    <button type="button" class="btn btn-block btn-light" data-toggle="modal" data-target="#changePasswordModal"><span class="fa fa-lock"></span> Change Password</button>
                </div>
                <div class="col-md-3 text-center py-2">
                    <button type="submit" name="save_changes" class="btn btn-block btn-success"><span class="fa fa-check"></span> Save changes</button>
                </div>
            </div>
            <!-- Action buttons ends here -->

            <div class="row">
                <div class="col-md-9">
                    <!-- Display success/error messages here -->
                    <?php
                        if(isset($_GET['error'])){
                            $error = $_GET['error'];
                            if($error == 'wrongPassword'){
                                echo '<p class="text-center text-warning"><span class="fa fa-warning"></span> Old password is invalid</p>';
                            }
                            elseif($error == 'matchPassword'){
                                echo '<p class="text-center text-warning"><span class="fa fa-warning"></span> New passwords do not match</p>';
                            }
                            elseif($error == 'fileType'){
                                echo '<p class="text-center text-warning"><span class="fa fa-warning"></span> Image format should be .jpg or .png</p>';
                            }
                            elseif($error == 'fileSize'){
                                echo '<p class="text-center text-warning"><span class="fa fa-warning"></span> Image should not be larger than 3MB</p>';
                            }
                            elseif($error == 'fileError'){
                                echo '<p class="text-center text-warning"><span class="fa fa-warning"></span> Unsupported image. Please choose another image</p>';
                            }
                        }
                        elseif(isset($_GET['change'])){
                            $change = $_GET['change'];
                            if($change == 'success'){
                                echo '<p class="text-center text-white"><span class="fa fa-check"></span> Password changed successfully</p>';
                            }
                            if($change == 'error'){
                                echo '<p class="text-center text-warning"><span class="fa fa-warning"></span> An error occured. Try again</p>';
                            }
                        }
                        elseif(isset($_GET['update'])){
                            $update = $_GET['update'];
                            if($update == 'success'){
                                echo '<p class="text-center text-white"><span class="fa fa-check"></span> Profile updated successfully</p>';
                            }
                        }
                    ?>
                    <!-- Display change password error messages ends here -->
                </div>
            </div>


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


                            <div class="form-row">

                                <!-- Basic information start here -->
                                <div class="col-12">
                                    <h6 class="text-center text-muted">Basic Info</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>
                                </div>
                                <!-- Basic information ends here -->


                                <div class="offset-md-1 col-md-4 mb-5">
                                    <label for="first_name" class="col-form-label">First name </label>
                                    <input type="text" name="first_name" id="first_name" placeholder="Enter first name" class="form-control" pattern="[a-z A-Z]+" value="<?php echo $first_name; ?>" required>
                                </div>

                                <div class="offset-md-1 col-md-4 mb-5">
                                    <label for="last_name" class="col-form-label">Last name </label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Enter last name" class="form-control" pattern="[a-z A-Z]+" value="<?php echo $last_name; ?>" required>
                                </div>

                                <div class="offset-md-1 col-md-4 mb-5">
                                    <label for="other_name" class="col-form-label">Other name </label>
                                    <input type="text" name="other_name" id="other_name" placeholder="Other name(s) if any" class="form-control" pattern="[a-z A-Z]+" value="<?php echo $other_name; ?>">
                                </div>

                                <div class="offset-md-1 col-md-4 mb-5">
                                    <label for="email" class="col-form-label">Email address </label>
                                    <input type="email" name="email" id="email" placeholder="Enter email address" class="form-control" value="<?php echo $email; ?>" required>
                                </div>

                                <!-- Credentials start here -->
                                <div class="col-12 mt-5">
                                    <h6 class="text-center text-muted">Credentials</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>
                                </div>

                                <div class="offset-md-1 col-md-5 mb-5 mt-1">
                                    <p class="lead"><strong>Username: </strong><?php echo username($user_id); ?></p>
                                </div>

                                <div class="col-md-4 mb-5">
                                    <input type="text" name="username" id="username" placeholder="Enter new username" pattern="[a-zA-Z]+" class="form-control">
                                </div>


                                <!-- Credentials end here -->



                            </div><br>


                        </div>
                        <!-- Card body ends here -->

                    </div>
                    <!-- Card ends here -->
                </div>
                <!-- Profile ends here -->


                <!-- Profile picture starts here -->
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <a href="<?php echo user_pic($_SESSION['user_id']); ?>" class="img-thumbnail mb-3"><img src="<?php echo user_pic($_SESSION['user_id']) ; ?>" alt="profile_pic" onerror="this.onerror=null;this.src='../../img/profile.jpg';" class="profile_pic d-block img-fluid" style="max-height:300px;"></a>

                    <div class="input-group" id="changeDp">
                      <div class="custom-file">
                        <input type="file" accept="image/*" name="user_pic" id="user_pic" class="custom-file-input">
                        <label for="user_pic" class="custom-file-label text-center bg-light text-dark"><span class="fa fa-camera"></span> Change Image</label>
                      </div>
                    </div><br><br>
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
