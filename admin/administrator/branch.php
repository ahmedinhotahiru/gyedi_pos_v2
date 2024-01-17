<?php
  $page_title = 'Branch | Branch Info';
  include 'includes/header.php';

  if(!isset($_GET['branch_id'])){
      header("Location: branches.php");
  }
  else{
    
    //   Identify the branch using the branch ID
    $branch_id = mysqli_real_escape_string($db, $_GET['branch_id']);
    $branch_name = branch_name($branch_id);

    // If no branch is found, redirect to branches
    if(empty($branch_name)){
      header("Location: branches.php");        
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

                    
                    <!-- Branch name starts here -->
                    <div class="col-md-12 mb-1">
                        <h5 class="text-center text-white"><?php echo $branch_name; ?></h5>
                    </div>
                    <!-- Branch name ends here -->

                    
                    <!-- Branch navigation options starts here -->
                    <div class="col-md-12 mb-4">
                        <div class="list-group ">
                            <a href="#" class="list-group-item list-group-item-action bg-light text-success">
                                <span class="fa fa-info-circle"></span> Branch Info
                            </a>
                            <a href="<?php echo 'checkouts.php?branch_id='.$branch_id ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-shopping-cart"></span> Checkouts
                            </a>
                            <a href="<?php echo 'expenses.php?branch_id='.$branch_id ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-pencil-square-o"></span> Expenditure
                            </a>
                            <a href="<?php echo 'sales_report.php?branch_id='.$branch_id ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-book"></span> Sales Report
                            </a>
                        </div>
                    </div>
                    <!-- Branch navigation options ends here -->


                    <!-- Back button starts here -->
                    <div class="col-md-12 mb-5 mt-3">
                        <a href="<?php echo 'branches.php?branch_id='.$branch_id; ?>" class="btn text-white btn-block"><span class="fa fa-arrow-left"></span> Back to branches</a>
                    </div>
                    <!-- Back button ends here -->
                    



                    
                    
                </div>
            </div>
            <!-- Side bar ends here -->


            <!-- Main content starts here -->
            <div class="col-md-9">


                <!-- Branch info starts here -->
                <div class="row">

                    <div class="col-md-12 mb-4">

                        <div class="card">
                            <div class="card-header">
                                <p class="card-text"><span class="fa fa-info-circle"></span> Branch Info</p>
                            </div>


                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div><p><strong>Branch Name: </strong><?php echo $branch_name; ?></p></div>
                                    <div><p><strong>Phone: </strong><?php echo branch_phone($branch_id); ?></p></div>
                                </div><br>

                                <h6 class="text-center text-muted">Workers</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>

                                <!-- workers start here -->
                                <div class="row">
                                    <?php branch_workers($branch_id); ?>
                                </div>
                                <!-- workers ends here -->

                                <h6 class="text-center text-muted">Edit Branch Info</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>

                                    <!-- display success/error messages here -->
                                <?php
                                        if(isset($_GET['update'])){
                                            echo '<p class="text-center text-success mb-3">Branch Info updated successfully</p>';
                                        }

                                        if(isset($_GET['error'])){
                                            $error = $_GET['error'];

                                            switch ($error) {
                                                case 'invalidName':
                                                    echo '<p class="text-center text-danger mb-3">Branch name contains invalid characters</p>';
                                                    break;

                                                case 'invalidPhone':
                                                    echo '<p class="text-center text-danger mb-3">Phone number is invalid</p>';
                                                    break;
                                                
                                                
                                                default:
                                                    # code...
                                                    break;
                                            }
                                        }
                                ?>

                                <form action="update_branch.php" method="get">
                                    <div class="form-row">
                                            
                                            
                                            <div class="col-md-4 offset-md-2 mb-5">
                                                <label for="branch_name">Branch name</label>
                                                <input type="text" name="branch_name" id="branch_name" placeholder="Enter new branch name" pattern="[a-z A-Z]+" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-5">
                                                <label for="phone_no">Phone </label>
                                                <input type="text" name="phone_no" id="phone_no" placeholder="Enter new phone number" class="form-control" maxlength="10" minlength="10" pattern="[0]{1}[0-9]{9}">
                                            </div>

                                            <div class="col-md-4 offset-md-4 mb-5">
                                                <button class="btn btn-block btn-success" type="submit" name="edit_branch" value="<?php echo $branch_id; ?>"><span class="fa fa-check"></span> Save changes</button>
                                            </div>

                                    </div>
                                </form>

                            </div>


                            

                        </div>

                    </div> 

                    
                    
                </div>
                <!-- Branch info ends here -->
                
                
            </div>
            <!-- Main content ends here -->
            

        </div>

    </div>

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
