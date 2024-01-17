<?php
  $page_title = 'Gyedi | Dashboard';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->

  <section>
    <div class="container my-5">
      
      <!-- Quick Buttons start here -->
      <div class="row mb-5">
        <!-- Add order button -->
        <div class="col-lg-3 col-md-4 text-center py-2">
          <a href="approve_expenses.php" class="btn btn-block btn-outline-primary"><span class="fa fa-pencil-square-o"></span> Pending Approvals <span class="badge badge-dark badge-pill"><?php no_of_approvals_pending() ?></span></a>
        </div>

        <!-- Cancel order button -->
        <div class="col-lg-3 col-md-4 text-center py-2">
          <a href="my_activity.php" class="btn btn-block btn-outline-dark"><span class="fa fa-bar-chart"></span> My Activity</a>
        </div>

        <!-- View cart button -->
        <div class="col-lg-3 col-md-4 text-center py-2">
          <a href="sales_report.php" class="btn btn-block btn-outline-success"><span class="fa fa-book"></span> Sales Report</a>
        </div>

        <!-- Date -->
        <div class="col-lg-3 col-md-12 text-center py-2">
          <div class="lead pt-1"><strong><?php echo $_SESSION['position']; ?> | </strong><span class="fa fa-calendar"></span>
          <?php date_default_timezone_set('Africa/Accra');
          echo date('d-M-Y'); ?></div>
        </div>
      </div>
      <!-- Quick Buttons end here -->


      <!-- Main content starts here -->
      <div class="row">

        <!-- Latest Checkouts start here -->
        <div class="col-md-8 col-lg-9 mb-3">
          
            <div class="card">
              <div class="card-header">
                <h4>Checkouts Today</h4>
              </div>


              <!-- Fetch checkouts from database starts here -->
              <?php
                latest_checkouts();
              ?>
              <!-- Fetch checkouts from database ends here -->


            </div>
          
        </div>
        <!-- Latest Checkouts ends here -->


        <!-- Side cards start here -->
        <div class="col-md-4 col-lg-3" id="side">

          <div class="card bg-primary mb-3">
            <div class="card-body text-center text-white">
              <h3>Expenses</h3>
              <h1 class="display-4"><span class="fa fa-pencil-square-o"></span> <?php no_of_expenses(); ?></h1>
              <a href="expenses.php" class="btn btn-sm btn-outline-light">View</a>
            </div>
          </div>

          <div class="card bg-success mb-3">
            <div class="card-body text-center text-white">
              <h3>Checkouts</h3>
              <h1 class="display-4"><span class="fa fa-shopping-cart"></span> <?php no_of_checkouts(); ?></h1>
              <a href="checkouts.php" class="btn btn-sm btn-outline-light">View</a>
            </div>
          </div>
          
        </div>
        <!-- Side cards end here -->

      </div>
      <!-- Main content ends here -->

    </div>

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
