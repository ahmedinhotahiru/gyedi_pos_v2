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
                            <a href="#" class="list-group-item list-group-item-action bg-light text-primary">
                                <span class="fa fa-info-circle"></span> Worker Info
                            </a>
                            <a href="<?php echo 'credentials.php?user_id='.$user_id ?>" class="list-group-item list-group-item-action">
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
                                <p class="card-text"><span class="fa fa-info-circle"></span> Worker</p>
                            </div>

                            <div class="card-body">
                                <form action="update_worker.php" class="form">
                                    <h6 class="text-center text-muted">Basic Information</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>
                                    <div class="row">
                                        <div class="col-md-8 text-center">

                                            <!-- Display error/success messages starts here -->
                                            <?php
                                                if(isset($_GET['error'])){
                                                    $error = $_GET['error'];

                                                    switch ($error) {
                                                        case 'empty':
                                                            echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> All fields (except other name) are required</p>';
                                                            break;

                                                        case 'invalidName':
                                                            echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Name contains invalid characters</p>';
                                                            break;

                                                        case 'residence':
                                                            echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Residence contains invalid characters</p>';
                                                            break;

                                                        case 'phone_no':
                                                            echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Phone number is invalid</p>';
                                                            break;
                                                        
                                                        default:
                                                            # code...
                                                            break;
                                                    }
                                                }

                                                elseif(isset($_GET['update']) && $_GET['update']=='success'){
                                                    
                                                    echo '<p class="text-center text-success"><span class="fa fa-check"></span> Basic info updated successfully</p>';
                                                    
                                                    
                                                }
                                            ?>
                                            <!-- Display error/success messages ends here -->
                                            
                                        </div>
                                    </div>
                                    <div class="row">

                                        <?php worker_info($user_id); ?>
                                        
                                    

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
