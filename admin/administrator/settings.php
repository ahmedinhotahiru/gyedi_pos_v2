<?php
  $page_title = 'Admin | Settings';
  include 'includes/header.php';





$c_name = $_SESSION['c_name'];
$addr_1 = $_SESSION['address_1'];
$addr_2 = $_SESSION['address_2'];
$addr_3 = $_SESSION['address_3'];



  if(isset($_POST['update_company_details'])) {

    $company_name = mysqli_real_escape_string($db, ucwords(strtolower(h($_POST['company_name']))));
    $address_1 = mysqli_real_escape_string($db, ucwords(strtolower(h($_POST['address_1']))));
    $address_2 = mysqli_real_escape_string($db, ucwords(strtolower(h($_POST['address_2']))));
    $address_3 = mysqli_real_escape_string($db, ucwords(strtolower(h($_POST['address_3']))));

    $query = "UPDATE `details` SET company_name = '$company_name', address_1 = '$address_1', address_2 = '$address_2', address_3 = '$address_3' WHERE id=1";
    $updated_details = mysqli_query($db, $query);

    if($updated_details) {
        $_SESSION['c_name'] = $company_name;
        $_SESSION['address_1'] = $address_1;
        $_SESSION['address_2'] = $address_2;
        $_SESSION['address_3'] = $address_3;

        header("Location: settings.php?update=success");
    }
    else {
        header("Location: settings.php?error=details");
    }
  }


  if(isset($_POST['change_logo'])) {

    if( isset($_FILES['c_logo'])  ){
        $file = $_FILES['c_logo'];
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
            header("Location: settings.php?error=fileType");
        }
        // Check if file size is allowed
        elseif($file_size > 3000000){
            header("Location: settings.php?error=fileSize");
        }
        // Check if there was an error
        elseif($file_error > 0){
            header("Location: settings.php?error=fileError");
            exit();
        }
        // Give new name to file (prefix with file extension)
        else{
            $file_new_name = 'logo.png';
            $user_id = $_SESSION['user_id'];

            // Specify new location to store file in
            $file_dir = "../../img/$file_new_name";

            // Move file to upload folder
            if(move_uploaded_file($file_tmp_name, $file_dir)) {

                header("Location: settings.php?changeLogo=success");

            }
            else{
                header("Location: settings.php?error=logoError");
            }


        }

    }

  }






?>



  <!-- Main Body Starts here -->

  <section>
    <div class="container my-5">


            <!-- Action buttons here -->
            <div class="row mb-5">
                <div class="col-md-3 text-center py-2">
                    <a href="index.php" class="btn btn-block btn-outline-light"><span class="fa fa-arrow-left"></span> Back to Dashboard</a>
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
                    ?>
                    <!-- Display change password error messages ends here -->
                </div>
            </div>


            <!-- Main section starts here -->
            <div class="row">

                <!-- Company details Starts here -->
                <div class="col-md-9 mb-3">
                    <form action="settings.php" method="POST">

                        <!-- Card starts here -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Settings</h4>
                            </div>
                            <!-- Card body starts here -->
                            <div class="card-body">


                                <div class="form-row">

                                    <!-- Basic information start here -->
                                    <div class="col-12">
                                        <h6 class="text-center text-muted">Company details</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>
                                    </div>
                                    <!-- Basic information ends here -->


                                    <div class="offset-md-1 col-md-10 mb-5">
                                        <label for="first_name" class="col-form-label">Company name <span class="required">*</span> </label>
                                        <input type="text" name="company_name" id="company_name" placeholder="Enter company name" class="form-control" pattern="[a-z A-Z]+" value="<?php echo $c_name; ?>" required>
                                    </div>

                                    <div class="offset-md-1 col-md-10 mb-3">
                                        <label for="address" class="col-form-label">Address Box 1 <span class="required">*</span> </label>
                                        <input type="text" name="address_1" id="address_1" placeholder="Address Name" class="form-control" value="<?php echo $addr_1; ?>" required>
                                    </div>

                                    <div class="offset-md-1 col-md-10 mb-3">
                                        <label for="address" class="col-form-label">Address Box 2 <span class="required">*</span> </label>
                                        <input type="text" name="address_2" id="last_name" placeholder="P. O. Box xxx" class="form-control" value="<?php echo $addr_2; ?>" required>
                                    </div>

                                    <div class="offset-md-1 col-md-10 mb-5">
                                        <label for="address" class="col-form-label">Address Box 3 <span class="required">*</span> </label>
                                        <input type="text" name="address_3" id="address_3" placeholder="Town/City" class="form-control" value="<?php echo $addr_3; ?>" required>
                                    </div>

                                    <!-- submit button here -->
                                    <div class="col-md-8 offset-md-2 mt-3">
                                        <button type="submit" class="btn btn-success btn-block" name="update_company_details"><span class="fa fa-check"></span> Update Details</button>

                                    </div>



                                </div><br>


                            </div>
                            <!-- Card body ends here -->

                        </div>
                        <!-- Card ends here -->

                    </form>
                    <!-- Form ends here -->
                </div>
                <!-- Company details ends here -->


                <!-- Profile picture starts here -->
                <div class="col-md-3 text-white">


                    <div class="card mb-3">
                        <div class="card-body d-flex align-content-center justify-content-center">
                            <img src="<?php echo '../../img/logo.png?'.mt_rand(); ?>" alt="profile_pic" onerror="this.onerror=null;this.src='../../img/profile.jpg';" class="profile_pic d-block img-fluid" style="max-height:300px;">
                        </div>
                    </div>

                    <div class="input-group text-white" id="changeDp">
                      <form action="settings.php" method="post" enctype="multipart/form-data">

                        <div class="custom-file mb-3">
                            <input type="file" accept="image/*" name="c_logo" id="c_logo">
                        </div>

                        <button type="submit" name="change_logo" class="btn btn-block btn-dark"><span class="fa fa-camera"></span> Change Logo </button>

                      </form>
                    </div><br><br>


                </div>
                <!-- Profile picture ends here -->

            </div>
            <!-- Main section ends here -->



    </div>
    <!-- Container ends here -->

  </section>

  <!-- Main Body Starts here -->



<?php include 'includes/footer.php'; ?>
