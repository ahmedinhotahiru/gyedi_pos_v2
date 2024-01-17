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
          <a href="addOrder.php" class="btn btn-block btn-outline-primary"><span class="fa fa-plus"></span> Add Order</a>
        </div>

        <!-- Cancel order button -->
        <div class="col-lg-3 col-md-4 text-center py-2">
          <button class="btn btn-block btn-outline-danger" data-toggle="modal" data-target="#cancelOrderModal"><span class="fa fa-remove"></span> Cancel Order</button>
        </div>

        <!-- View cart button -->
        <div class="col-lg-3 col-md-4 text-center py-2">
          <button class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#viewCartModal"><span class="fa fa-shopping-cart"></span> View Cart</button>
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
              <h3>Orders</h3>
              <h1 class="display-4"><span class="fa fa-users"></span> <?php no_of_orders(); ?></h1>
              <a href="orders.php" class="btn btn-sm btn-outline-light">View</a>
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
