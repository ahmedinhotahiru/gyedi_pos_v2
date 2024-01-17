<?php
  $page_title = 'Gyedi | Sales Report';
  include 'includes/header.php';




  
?>






  <!-- Main Body Starts here -->
  
  <section>
    <div class="container my-5">


      <div class="row">
        <!-- Main content starts here -->
            <div class="col-md-12">

                <!-- Search button starts here -->
                <div class="row mb-4">
                    <div class="col-12">
                        <form action='<?php echo "search_sales_report.php"; ?>' method="get">
                            <div class="form-row">
                                <div class="col-md-6 d-flex">
                                    <p class="lead float-left mr-3"><span class="fa fa-calendar"></span> Pick a Date: </p>
                                    <input type="date" name="date" id="" min="2019-05-01" max="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm w-50" required>
                                </div>
                                <div class="col-md-3 offset-md-3">
                                    <button type="submit" name="search_date" class="btn btn-sm btn-block btn-default"><span class="fa fa-search"></span> Search</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <!-- Search button ends here -->


                <!-- SALES REPORT for the day starts here -->
                <div class="row">

                    <div class="col-12 text-center mb-5">
                        <h5>Date: Today</h5>
                    </div>

                    <!-- Sales summary -->
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            <p class="card-title"><span class="fa fa-book"></span> Sales Summary</p>
                            <a href="<?php echo u(h('checkouts.php'));?>"><span class="fa fa-angle-double-right"></span> Details</a>
                            </div>


                            <!-- Sales summary from database starts here -->
                            <?php
                                sales_summary();
                            ?>
                            <!-- Sales summary from database ends here -->
                            
                            <div class="card-footer d-flex justify-content-between">
                                <p>Total number of checkouts: <?php echo no_of_checkouts(); ?></p>
                                <p>Total Sales: GH¢ <?php $total_sales = number_format(total_sales(), 2); echo $total_sales; ?></p>
                            </div>

                        </div>
                    </div>


                    <!-- Expenses -->
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <p class="card-title"><span class="fa fa-pencil-square-o"></span> Expenditure Today</p>
                            </div>


                            <!-- expenses starts here -->
                            <?php
                                expenses_today();
                            ?>
                            <!-- expenses ends here -->

                            <div class="card-footer d-flex justify-content-between">
                                <p>Total number of expenditure: <?php echo no_of_expenses(); ?></p>
                                <p>Total Expenditure: GH¢ <?php $total_expenditure = number_format(total_expenditure(), 2); echo $total_expenditure; ?></p>
                            </div>
                            

                        </div>
                    </div>


                    <!-- total balance -->
                    <div class="col text-center mb-5">
                        <?php $total_balance = total_sales() - total_expenditure(); ?>
                        <h4 class="display-5">Total Balance: GH¢ <?php echo number_format($total_balance, 2); ?></h4>
                    </div>
                                       
                </div>
                <!-- SALES REPORT for the day ends here -->
                
                
            </div>
            <!-- Main content ends here -->
      </div>

    </div>
    <!-- Container ends here -->

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
