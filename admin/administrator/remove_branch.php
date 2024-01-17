<?php
  $page_title = 'Admin | Remove branch';
  include 'includes/header.php';



//   remove branch form

    if(isset($_GET['remove_branch'])){
        $branch_id = $_GET['branch_id'];

        // Check if all required fields are filled
        if( empty($branch_id) ){
            header("Location: remove_branch.php?error=emptyBranch");
        }
        else{
            // Remove branch from db
            remove_branch($branch_id);
            header("Location: branches.php?remove=success");
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
                            <a href="index.php" class="list-group-item list-group-item-action">
                                <span class="fa fa-cog"></span> Dashboard
                            </a>
                            <a href="workers.php" class="list-group-item list-group-item-action">
                                <span class="fa fa-user"></span> Workers <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_workers(); ?></span>
                            </a>
                            <a href="branches.php" class="list-group-item list-group-item-action">
                                <span class="fa fa-home"></span> Branches <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_branches(); ?></span>
                            </a>
                            <a href="services.php" class="list-group-item list-group-item-action">
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
                                <p class="card-text"><span class="fa fa-trash"></span> Remove branch</p>
                            </div>

                            <form action="remove_branch.php" method="GET">
                            
                                <!-- Padding for form -->
                                <div class="p-3">
                                    <div class="card-body">

                                        <!-- Display error messaages starts here -->
                                        <?php
                                            if(isset($_GET['error'])){
                                                $error = $_GET['error'];

                                                switch ($error) {
                                                    case 'emptyBranch':
                                                        echo '<p class="text-danger text-center">Select a branch</p>';
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
                                                
                                                <div class="col-12 mb-5">
                                                    <label for="branch" class="col-form-label">Branch <span class="required">*</span></label>
                                                    <select name="branch_id" id="branch" class="form-control">
                                                        <option value="">Select branch...</option>
                                                        <?php select_branches();  ?>
                                                    </select>
                                                </div>


                                            </div>
                                        <!-- Form content ends here -->
                                            
                                    </div>
                                </div>

                              <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <button class="btn btn-danger btn-lg btn-block" type="submit" name="remove_branch" onclick="return confirm('Are you sure you want to remove selected branch?');"><span class="fa fa-remove"></span> Remove branch</button>
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
