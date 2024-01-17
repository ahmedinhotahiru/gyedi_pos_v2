<?php
  $page_title = 'Branch | Expenses';
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
                        <a href="<?php echo 'branches.php?branch_id='.$branch_id; ?>" class="btn text-white btn-block"><span class="fa fa-arrow-left"></span> Back to branches</a>
                    </div>
                    <!-- Back button ends here -->
                    



                    
                    
                </div>
            </div>
            <!-- Side bar ends here -->


            <!-- Main content starts here -->
            <div class="col-md-9">

                <!-- Search button starts here -->
                <div class="row mb-5">
                    <div class="col-12">
                    <form action='<?php echo "search_expense.php"; ?>' method="get">
                        <div class="input-group">
                            <input type="search" name="search_keywords" id="search" class="form-control" placeholder="Search expenses...">
                            <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">
                            <div class="input-group-append">
                                <button type="submit" name="search_expense" class="btn btn-primary"><span class="fa fa-search"></span> Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Search button ends here -->


                <!-- Checkouts for the day starts here -->
                <div class="row">


                    <!-- Fetch search results from database starts here -->
                    <?php
                        if(isset($_GET['search_expense'])){
                            // Get search input from user
                            $search_keywords = mysqli_real_escape_string($db, $_GET['search_keywords']);
                            search_expense($search_keywords, $branch_id);
                        }
                    ?>
                    <!-- Fetch search results from database ends here --> 

                                       
                </div>
                <!-- Checkouts for the day ends here -->
                
                
            </div>
            <!-- Main content ends here -->
            

        </div>

    </div>

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
