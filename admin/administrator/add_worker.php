<?php
  $page_title = 'Admin | Add worker';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->

  <section>

    <div class="container my-5">

        <div class="row mb-5">

            <!-- Side bar starts here -->
            <div class="col-md-3 mb-3">
                <div class="row">

                    <!-- Side navigation starts here -->
                    <div class="col-md-12 mb-3">
                        <div class="list-group ">
                            <a href="<?php echo u(h('index.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-cog"></span> Dashboard
                            </a>
                            <a href="<?php echo u(h('workers.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-user"></span> Workers <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_workers(); ?></span>
                            </a>
                            <a href="<?php echo u(h('branches.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-home"></span> Branches <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_branches(); ?></span>
                            </a>
                            <a href="<?php echo u(h('services.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-globe"></span> Services <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_services(); ?></span>
                            </a>
                        </div>
                    </div>
                    <!-- Side navigation ends here -->



                    <!-- Action buttons start here -->
                    <div class="col-md-12 mt-5">
                        <a href="<?php echo u(h('workers.php')); ?>" class="btn text-white btn-block mb-3"><span class="fa fa-arrow-left"></span> Back to workers</a>
                    </div>
                    <!-- Action buttons start here -->


                    
                </div>
            </div>
            <!-- Side bar ends here -->


            <!-- Main content starts here -->
            <div class="col-md-9">
                <div class="row">

                    <div class="col-md-12 mb-4">

                        <div class="card">
                            <div class="card-header">
                                <p class="card-text"><span class="fa fa-plus"></span> Add worker</p>
                            </div>

                            <form action="<?php echo u(h('add_new_worker.php')); ?>" method="post" enctype="multipart/form-data">

                                <!-- Padding for form -->
                                <div class="p-3">
                                    <div class="card-body">



                                        <!-- Display error/success messaages starts here -->
                                        <?php
                                            if(isset($_GET['error'])){
                                                $error = $_GET['error'];

                                                switch ($error) {
                                                    case 'empty':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> All fields marked * are required</p>';
                                                        break;

                                                    case 'invalidName':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid name</p>';
                                                        break;
                                                    
                                                    case 'residence':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid residence</p>';
                                                        break;

                                                    case 'phone_no':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid phone number</p>';
                                                        break;

                                                    case 'branch':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid branch. Please select a branch.</p>';
                                                        break;

                                                    case 'salary':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid salary</p>';
                                                        break;

                                                    case 'invalidUsername':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid username</p>';
                                                        break;

                                                    case 'password':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Passwords do not match</p>';
                                                        break;

                                                    case 'passport_pic':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Passport picture is required</p>';
                                                        break;

                                                    case 'emailTaken':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Email address already taken</p>';
                                                        break;

                                                    case 'file_type':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Image format should be .jpg or .png</p>';
                                                        break;

                                                    case 'file_size':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Image should not be larger than 3MB</p>';
                                                        break;

                                                    case 'file_error':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Unsupported image. Please choose another image</p>';
                                                        break;

                                                    case 'usernameTaken':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Username already taken</p>';
                                                        break;
                                                    
                                                    
                                                    default:
                                                        # code...
                                                        break;
                                                }
                                            }

                                            elseif(isset($_GET['register']) && $_GET['register']=='success'){
                                                
                                                echo '<p class="text-center text-success"><span class="fa fa-check"></span> Worker account created successfully. <strong><a href="workers.php">View workers</a></strong></p>';
                                                
                                            }
                                        ?>
                                        <!-- Display error messaages ends here -->



                                        <!-- Form content starts here -->
                                            <div class="form-row">
                                                
                                                <!-- First name -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="first_name" class="col-form-label">First name <span class="required">*</span></label>
                                                    <input type="text" name="first_name" id="first_name" placeholder="Enter first name" class="form-control" pattern="[a-z A-Z]+" value="<?php if(isset($_GET['first_name'])){echo $_GET['first_name'];} ?>" required>
                                                </div>

                                                <!-- last name -->                                                
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="last_name" class="col-form-label">Last name <span class="required">*</span></label>
                                                    <input type="text" name="last_name" id="last_name" placeholder="Enter last name" class="form-control" pattern="[a-z A-Z]+" value="<?php if(isset($_GET['last_name'])){echo $_GET['last_name'];} ?>" required>
                                                </div>

                                                <!-- other name -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="other_name" class="col-form-label">Other name(s)</label>
                                                    <input type="text" name="other_name" id="other_name" placeholder="Enter other name (if any)" class="form-control" pattern="[a-z A-Z]+" value="<?php if(isset($_GET['other_name'])){echo $_GET['other_name'];} ?>">
                                                </div>

                                                <!-- date of birth -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="DOB" class="col-form-label">Date of birth <span class="required">*</span></label>
                                                    <input type="date" max="<?php echo date("Y-m-d"); ?>" name="DOB" id="DOB" class="form-control" value="<?php if(isset($_GET['DOB'])){echo $_GET['DOB'];} ?>" required>
                                                </div>

                                                <!-- gender -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="gender" class="col-form-label">Gender <span class="required">*</span></label>
                                                    <select name="gender" id="gender" class="form-control" required>
                                                        <option value="">Select gender...</option>

                                                        <option value="Male" <?php if(isset($_GET['gender']) && $_GET['gender']=='Male'){echo 'selected';} ?>>Male</option>

                                                        <option value="Female" <?php if(isset($_GET['gender']) && $_GET['gender']=='Female'){echo 'selected';} ?>>Female</option>

                                                    </select>
                                                </div>

                                                <!-- residence -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="residence" class="col-form-label">Residence <span class="required">*</span></label>
                                                    <input type="text" name="residence" id="residence" placeholder="Where do you stay?" class="form-control" pattern="[a-z A-Z 0-9]+" value="<?php if(isset($_GET['residence'])){echo $_GET['residence'];} ?>" required>
                                                </div>

                                                <!-- Email -->
                                                <div class="col-lg-6 col-md-6 mb-5">
                                                    <label for="email" class="col-form-label">Email <span class="required">*</span></label>
                                                    <input type="email" name="email" id="email" placeholder="Enter email address" class="form-control" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" required>
                                                </div>

                                                <!-- Phone number -->
                                                <div class="col-lg-6 col-md-6 mb-5">
                                                    <label for="phone_no" class="col-form-label">Phone <span class="required">*</span></label>
                                                    <input type="text" name="phone_no" id="phone_no" placeholder="Enter phone number" class="form-control" maxlength="10" minlength="10" pattern="[0]{1}[0-9]{9}" value="<?php if(isset($_GET['phone_no'])){echo $_GET['phone_no'];} ?>"  required>
                                                </div>

                                                <!-- Branch -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="branch" class="col-form-label">Branch <span class="required">*</span></label>
                                                    <select name="branch" id="branch" class="form-control" required>
                                                        <option value="">Select branch...</option>
                                                        <?php select_branches();  ?>
                                                    </select>
                                                </div>

                                                <!-- Position -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="position" class="col-form-label">Position <span class="required">*</span></label>
                                                    <select name="position" id="position" class="form-control" required>
                                                        <option value="">Select position...</option>

                                                        <option value="Cashier" <?php if(isset($_GET['position']) && $_GET['position']=='Cashier'){echo 'selected';} ?>>Cashier</option>

                                                        <option value="Attendant" <?php if(isset($_GET['position']) && $_GET['position']=='Attendant'){echo 'selected';} ?>>Attendant</option>

                                                        <option value="Manager" <?php if(isset($_GET['position']) && $_GET['position']=='Manager'){echo 'selected';} ?>>Manager</option>
                                                    </select>
                                                </div>

                                                <!-- Salary -->
                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="salary" class="col-form-label">Salary <span class="required">*</span></label>
                                                    <input type="number" name="salary" id="salary" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptySalary'){echo 'input-required';} ?>" placeholder="Enter initial salary" min="0.10" step="0.10" value="<?php if(isset($_GET['salary'])){echo $_GET['salary'];} ?>" required>
                                                </div>

                                                <!-- Passport pic -->
                                                <div class="col-12 mb-5">
                                                    <label for="passport_pic" class="col-form-label">Passport picture <span class="required">*</span></label>
                                                    <input type="file" name="passport_pic" accept="image/*" id="passport_pic" required>
                                                    <p class="col-form-label text-muted" style="font-size:12px;">Max File Size: 3MB</p>
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="username" class="col-form-label">Username <span class="required">*</span></label>
                                                    <input type="text" name="username" id="username" placeholder="Enter username" class="form-control" pattern="[a-zA-Z]+" value="<?php if(isset($_GET['username'])){echo $_GET['username'];} ?>" required>
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="password" class="col-form-label">Password <span class="required">*</span></label>
                                                    <input type="password" name="password" id="password" placeholder="Enter password" class="form-control" required>
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-5">
                                                    <label for="confirm_password" class="col-form-label">Confirm password <span class="required">*</span></label>
                                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Re-enter password" class="form-control" required>
                                                </div>


                                            </div>
                                        <!-- Form content ends here -->
                                            
                                    </div>
                                </div>

                              <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <button class="btn btn-success btn-lg btn-block" type="submit" name="register"><span class="fa fa-check"></span> Create account</button>
                                        </div>
                                    </div>
                              </div>

                            </form>

                        </div>

                    </div> 

                    
                    
                </div>
                
                
            </div>
            <!-- Main content ends here -->
            

        </div>

    </div>

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
