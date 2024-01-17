<?php
  $page_title = 'Admin | Worker';
  include 'includes/header.php';

  if(!isset($_GET['user_id'])){
      header("Location: workers.php");
  }
  else{
    
    //   Identify the worker using the worker ID
    $user_id = mysqli_real_escape_string($db, $_GET['user_id']);
    $user_name = user_name($user_id);

    // If no worker is found, redirect to workers
    if(empty($user_name)){
      header("Location: workers.php");        
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
                    <div class="col-md-12 mb-5">
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

                    

                    <!-- worker name starts here -->
                    <div class="col-md-12 mb-1">
                        <h5 class="text-center text-white"><?php echo $user_name; ?></h5>
                    </div>
                    <!-- worker name ends here -->

                    
                    <!-- worker navigation options starts here -->
                    <div class="col-md-12 mb-4">
                        <div class="list-group ">
                            <a href="<?php echo 'worker.php?user_id='.$user_id ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-info-circle"></span> Worker Info
                            </a>
                            <a href="#" class="list-group-item list-group-item-action bg-light text-primary">
                                <span class="fa fa-sign-in"></span> Credentials
                            </a>
                        </div>
                    </div>
                    <!-- worker navigation options ends here -->


                    <!-- Back button starts here -->
                    <div class="col-md-12 mb-5 mt-3">
                        <a href="<?php echo 'workers.php?user_id='.$user_id; ?>" class="btn text-white btn-block"><span class="fa fa-arrow-left"></span> Back to workers</a>
                    </div>
                    <!-- Back button ends here -->

                    
                </div>
            </div>
            <!-- Side bar ends here -->


            <!-- Main content starts here -->
            <div class="col-md-9">
                <div class="row">

                    <div class="col-md-12 mb-4">

                        <div class="card">

                            <div class="card-header">
                                <p class="card-text"><span class="fa fa-sign-in"></span> Credentials</p>
                            </div>

                            <div class="card-body">
                                <form action="update_credentials.php" class="form">
                                    <h6 class="text-center text-muted">Work credentials</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>
                                    

                                    <?php credentials($user_id); ?>
                                        
                                    <h6 class="text-center text-muted">Edit credentials</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>

                                    <!-- display success/error messages here -->
                                    <?php
                                        if(isset($_GET['update'])){
                                            echo '<p class="text-center text-success mb-3"><span class="fa fa-check"></span> Worker credentials updated successfully</p>';
                                        }

                                        if(isset($_GET['error'])){
                                            $error = $_GET['error'];

                                            switch ($error) {
                                                case 'invalidUsername':
                                                    echo '<p class="text-center text-danger mb-3"><span class="fa fa-warning"></span> Username contains invalid characters</p>';
                                                    break;

                                                case 'invalidBranch':
                                                    echo '<p class="text-center text-danger mb-3"><span class="fa fa-warning"></span> Please select a branch from the list</p>';
                                                    break;

                                                case 'invalidPosition':
                                                    echo '<p class="text-center text-danger mb-3"><span class="fa fa-warning"></span> Please select a position from the list</p>';
                                                    break;

                                                
                                                
                                                default:
                                                    # code...
                                                    break;
                                            }
                                        }
                                    ?>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-5">
                                            <label for="branch">Branch</label>
                                            <select name="branch" id="branch" class="form-control">
                                                <option value="">Select branch...</option>
                                                <?php select_branches(); ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-5">
                                            <label for="position">Position</label>
                                            <select name="position" id="position" class="form-control">
                                                <option value="">Select position...</option>
                                                <option value="Cashier">Cashier</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Attendant">Attendant</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-5">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" placeholder="Enter new username" pattern="[a-zA-Z]+" class="form-control">
                                        </div>

                                        <div class="col-md-4 offset-md-4 mb-5">
                                            <button class="btn btn-block btn-success" type="submit" name="edit_credentials" value="<?php echo $user_id; ?>"><span class="fa fa-check"></span> Save changes</button>
                                        </div>

                                    </div>
                                    

                                    
                                </form>
                            </div>
                       
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
