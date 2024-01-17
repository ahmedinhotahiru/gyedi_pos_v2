<?php
  $page_title = 'Gyedi | Checkouts';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->

  <section>
    <div class="container my-5">
      
      <!-- View button & Search bar starts here -->
      
      <div class="row mb-5">
        <div class="col-md-3 text-center py-2">
          <button class="btn btn-block btn-success" data-toggle="modal" data-target="#viewCartModal"><span class="fa fa-shopping-cart"></span> View cart</button>
        </div>
        <div class="col-md-6 offset-md-3 py-2">
          <form action="<?php echo u(h('search_checkout.php')); ?>" method="get">
            <div class="input-group">
                <input type="search" name="search_keywords" id="search" class="form-control" placeholder="Search checkouts...">
                <div class="input-group-append">
                    <button type="submit" name="search_checkout" class="btn btn-success"><span class="fa fa-search"></span> Search</button>
                </div>
            </div>
          </form>
        </div>
      </div>
      <!-- View button & Search bar ends here -->


      <!-- Main content starts here -->
      <div class="row">

        <!-- Latest Checkouts starts here -->
        <div class="col-md-12 mb-3">

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

        <div class="col text-center mt-3">
          <h3>Total Sales: GH¢ <?php $total_sales = number_format(total_sales(), 2); echo $total_sales; ?></h3>
        </div>
      

      </div>
      <!-- Main content ends here -->

    </div>

  </section>

 
 
 



<?php include 'includes/footer.php'; ?>
