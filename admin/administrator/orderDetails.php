<?php
  $page_title = 'Checkouts | Receipt';
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
      

      



      <!-- Main content starts here -->
      <div class="row">

        <!-- Side bar starts here -->
        <div class="col-lg-3 mb-3 sidebar">
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
                            <a href="<?php echo 'branch.php?branch_id='.$branch_id ?>" class="list-group-item list-group-item-action">
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
                        <a href="<?php echo 'checkouts.php?branch_id='.$branch_id; ?>" class="btn text-white btn-block"><span class="fa fa-arrow-left"></span> Back to checkouts</a>
                    </div>
                    <!-- Back button ends here -->
                    



                    
                    
                </div>
        </div>
        <!-- Side bar ends here -->



        <!-- Order details starts here -->
        <div class="col-lg-9 mb-3">

            <div class="card">

                <div class="card-header receiptHead">
                    <p class="card-text"><span class="fa fa-list-alt"></span> Receipt</p>
                </div>

                <div class="card-body p-5">


                    <!-- Receipt header starts here -->
                    <div class="d-flex justify-content-between">
                        <div class="" style="height:80px; overflow:hidden;">
                            <img src="../../img/logo.png" alt="logo" class="logo img-fluid" style="height:100%;">
                        </div>
                        <div class="my-auto">
                            <h4>OFFICIAL RECEIPT</h4>
                        </div>
                        <div class="">
                            <p class="text-right">
                                <?php echo $_SESSION['address_1'] . '<br>' . $_SESSION['address_2'] . '<br>' . $_SESSION['address_3']; ?>
                            </p>
                        </div>
                    </div><hr><br>
                    <!-- Receipt header ends here -->


                    <!-- Display services rendered starts here -->
                    <?php
                        if(isset($_GET['checkout_id'])){
                            // Get checkout id
                            $checkout_id = $_GET['checkout_id'];
                            
                            // display receipt for checkout id
                            display_receipt($checkout_id);
                        }
                        else{
                            header("Location: branches.php");
                        }

                    ?><br>
                    <!-- Display services rendered ends here -->


                        <!-- Action buttons here -->
                    <div class="row mb-5 actionButtons print">
                        <div class="col-md-3 offset-md-9 text-center py-2">
                            <button type="button" class="btn btn-block btn-primary" onclick="print();"><span class="fa fa-print"></span> Print</button>
                        </div>
                    </div>
                    <!-- Action buttons ends here -->
                

                </div>

            </div>

        </div>
        <!-- Order details ends here -->


      

      </div><br>
      <!-- Main content ends here -->







    </div>
    <!-- Container ends here -->

  </section>

  <!-- Main Body Starts here -->





<?php include 'includes/footer.php'; ?>