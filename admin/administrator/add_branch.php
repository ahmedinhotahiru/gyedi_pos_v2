<?php
  $page_title = 'Admin | Add branch';
  include 'includes/header.php';



//   add branch form

    if(isset($_GET['add_branch'])){
        $branch_name = ucwords($_GET['branch_name']);
        $branch_phone = $_GET['branch_phone'];

        // Check if all required fields are filled
        if( empty($branch_name) ){
            header("Location: add_branch.php?error=emptyName&branch_phone=$branch_phone");
        }
        elseif( empty($branch_phone) ){
            header("Location: add_branch.php?error=emptyPhone&branch_name=$branch_name");            
        }
        else{
            // Check if branch name and phone are valid
            if( !preg_match("/^[a-z A-Z]*$/", $branch_name) ){
                header("Location: add_branch.php?error=branchName&branch_name=$branch_name&branch_phone=$branch_phone");                
            }
            elseif( !preg_match("/^[[0]{1}[0-9]{9}]*$/", $branch_phone) ){
                header("Location: add_branch.php?error=branchPhone&branch_name=$branch_name&branch_phone=$branch_phone");                                
            }
            else{

                // Insert branch into db
                $branch_pos = no_of_branches() + 1;
                $branch_position = "branch_$branch_pos";
                add_branch($branch_name, $branch_phone, $branch_position);
                header("Location: branches.php?add=success");
            }
        }
    }
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
                        <a href="<?php echo u(h('branches.php')); ?>" class="btn text-white btn-block mb-3"><span class="fa fa-arrow-left"></span> Back to branches</a>
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
                                <p class="card-text"><span class="fa fa-plus"></span> Add branch</p>
                            </div>

                            <form action="<?php echo u(h('add_branch.php')); ?>" method="GET">
                            
                                <!-- Padding for form -->
                                <div class="p-3">
                                    <div class="card-body">

                                        <!-- Display error messaages starts here -->
                                        <?php
                                            if(isset($_GET['error'])){
                                                $error = $_GET['error'];

                                                switch ($error) {
                                                    case 'emptyName':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Branch name is required</p>';
                                                        break;

                                                    case 'emptyPhone':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Branch phone is required</p>';
                                                        break;
                                                    
                                                    case 'branchName':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid branch name</p>';
                                                        break;

                                                    case 'branchPhone':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid branch phone</p>';
                                                        break;
                                                    
                                                    default:
                                                        # code...
                                                        break;
                                                }
                                            }
                                        ?>
                                        <!-- Display error messaages ends here -->


                                        <!-- Form content starts here -->
                                            <div class="form-row">
                                                
                                                <div class="col-lg-6 col-md-6 mb-5">
                                                    <label for="branch_name" class="col-form-label">Branch name <span class="required">*</span></label>
                                                    <input type="text" name="branch_name" id="branch_name" placeholder="Enter branch name" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyName'){echo 'input-required';} ?>" value="<?php if(isset($_GET['branch_name'])){echo $_GET['branch_name'];} ?>">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-5">
                                                    <label for="branch_phone" class="col-form-label">Phone <span class="required">*</span></label>
                                                    <input type="text" name="branch_phone" id="branch_phone" placeholder="Enter branch phone number" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyPhone'){echo 'input-required';} ?>" maxlength="10" minlength="10" pattern="[0]{1}[0-9]{9}" value="<?php if(isset($_GET['branch_phone'])){echo $_GET['branch_phone'];} ?>">
                                                </div>


                                            </div>
                                        <!-- Form content ends here -->
                                            
                                    </div>
                                </div>

                              <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <button class="btn btn-success btn-lg btn-block" type="submit" name="add_branch"><span class="fa fa-check"></span> Create branch</button>
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
