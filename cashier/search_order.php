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

      <!-- Search results start here -->


        <!-- Fetch search results from database starts here -->
        <?php
            if(isset($_GET['search_order'])){
                // Get search input from user
                $search_keywords = mysqli_real_escape_string($db, $_GET['search_keywords']);
                search_order($search_keywords);
            }
        ?>
        <!-- Fetch search results from database ends here -->
        

        


      </div>
      <!-- Main content ends here -->

    </div>

  </section>

  <!-- Main Body ends here -->



<?php include 'includes/footer.php'; ?>