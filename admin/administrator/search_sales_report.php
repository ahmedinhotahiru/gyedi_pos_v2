<?php
  $page_title = 'Branch | Sales Report';
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
                <div class="row mb-4">
                    <div class="col-12">
                        <form action='<?php echo "search_sales_report.php"; ?>' method="get">
                            <div class="form-row">
                                <div class="col-md-6 d-flex">
                                    <p class="lead float-left mr-3 text-white"><span class="fa fa-calendar"></span> Pick a Date: </p>
                                    <input type="date" name="date" id="" min="2019-05-01" max="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm w-50" required>
                                </div>
                                <div class="col-md-3 offset-md-3">
                                    <button type="submit" name="search_date" class="btn btn-sm btn-block btn-default"><span class="fa fa-search"></span> Search</button>
                                </div>
                            </div>
                            <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">
                        </form>
                    </div>
                </div>
                <!-- Search button ends here -->


                <!-- Search results starts here -->
                <div class="row">


                    <!-- Fetch search results from database starts here -->
                    <?php
                        if(isset($_GET['search_date'])){
                            // Get search input from user
                            $search_keywords = $_GET['date'];
                            $search_date = explode("-", $search_keywords);
                            $search_date = array_reverse($search_date);
                            $search_date = implode("-", $search_date);
                            
                            $no_of_checkouts = no_of_checkouts($branch_id, $search_date);
                            if($no_of_checkouts < 1){
                                echo '<div class="col-12 text-center text-white">
                                        <h5>No sales record found for '.$search_date.'</h5>
                                      </div>';
                            }
                            else{

                                
                                // Date starts here
                                echo '<div class="col-12 text-center text-white mb-5">
                                        <h5>Date: '.$search_date.'</h5>
                                      </div>';
                                // Date ends here
                                


                                // Checkouts starts here
                                echo '<div class="col-md-12 mb-5">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <p class="card-title"><span class="fa fa-shopping-cart"></span> Checkouts</p>
                                            </div>';

                                checkouts($branch_id, $search_date);

                                echo '  </div>
                                      </div>';
                                // Checkouts ends here



                                // sales summary starts here
                                $total_sales = number_format(total_sales($branch_id, $search_date), 2);            
                                echo '<div class="col-md-12 mb-5">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <p class="card-title"><span class="fa fa-book"></span> Sales Summary</p>
                                            </div>';

                                sales_summary($branch_id, $search_date);
                                            
                                            
                                echo '            
                                            <div class="card-footer d-flex justify-content-between">
                                                <p>Total number of checkouts: '.$no_of_checkouts.'</p>
                                                <p>Total Sales: GH¢ '.$total_sales.'</p>
                                            </div>

                                        </div>
                                      </div>';
                                // sales summary ends here
                                


                                // Expenditure starts here                                
                                echo '<div class="col-md-12 mb-5">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <p class="card-title"><span class="fa fa-pencil-square-o"></span> Expenditure</p>
                                            </div>';

                                expenses_today($branch_id, $search_date);
                                $no_of_expenses = no_of_expenses($branch_id, $search_date);
                                $total_expenditure = number_format(total_expenses($branch_id, $search_date), 2);
                                            
                                            
                                echo '            
                                            <div class="card-footer d-flex justify-content-between">
                                                <p>Total number of expenditure: '.$no_of_expenses.'</p>
                                                <p>Total Expenditure: GH¢ '.$total_expenditure.'</p>
                                            </div>

                                        </div>
                                      </div>';
                                // Expenditure ends here   
                                
                                

                                // Total balance starts here
                                $total_balance = total_sales($branch_id, $search_date) - total_expenses($branch_id, $search_date);
                                $total_balance = number_format($total_balance, 2);
                                
                                echo '<div class="col text-center mb-5 text-white">
                                        <h4 class="display-5">Total Balance: GH¢ '.$total_balance.'</h4>
                                      </div>';
                                // Total balance ends here
                                
                            }
                            
                        }
                    ?>
                    <!-- Fetch search results from database ends here --> 

                                       
                </div>
                <!-- Search results ends here -->
                
                
            </div>
            <!-- Main content ends here -->
            

        </div>

    </div>

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
