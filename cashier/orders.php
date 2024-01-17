<?php
  $page_title = 'Gyedi | Orders';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->

  <section>
    <div class="container my-5">
      
      <!-- Add order button and Search bar starts here -->
      
      <div class="row mb-5">
        <div class="col-md-3 text-center py-2">
          <a href="addOrder.php" class="btn btn-block btn-primary"><span class="fa fa-plus"></span> Add order</a>
        </div>
        <div class="col-md-6 offset-md-3 py-2">
          <form action="<?php echo u(h('search_order.php')); ?>" method="get">
            <div class="input-group">
                <input type="search" name="search_keywords" id="search" class="form-control" placeholder="Search orders...">
                <div class="input-group-append">
                    <button type="submit" name="search_order" class="btn btn-primary"><span class="fa fa-search"></span> Search</button>
                </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Add button and Search bar ends here -->


      <!-- Main content starts here -->
      <div class="row">

        <!-- Ongoing orders start here -->
        <div class="col-md-12 mb-3">

          <div class="card">
            <div class="card-header">
              <h4>Ongoing Orders</h4>
            </div>


            <!-- Fetch orders from database starts here -->
              <?php
                ongoing_orders();
              ?>
              <!-- Fetch orders from database ends here -->
            

          </div>

        </div>
        <!-- Ongoing orders ends here -->


      

      </div>
      <!-- Main content ends here -->

    </div>

  </section>

  <!-- Main Body ends here -->






<?php include 'includes/footer.php'; ?>