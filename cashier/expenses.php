<?php
  $page_title = 'Gyedi | Expenses';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->

  <section>
    <div class="container my-5">
      
      <!-- Add order button and Search bar starts here -->
      
      <div class="row mb-5">
        <div class="col-md-3 text-center py-2">
          <a href="add_expenses.php" class="btn btn-block btn-warning"><span class="fa fa-plus"></span> Add Expenses</a>
        </div>

        <div class="col-md-6 offset-md-3 py-2">
          <form action="<?php echo u(h('search_expense.php')); ?>" method="get">
            <div class="input-group">
                <input type="search" name="search_keywords" id="search" class="form-control" placeholder="Search expenses...">
                <div class="input-group-append">
                    <button type="submit" name="search_expense" class="btn btn-warning"><span class="fa fa-search"></span> Search</button>
                </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Add button and Search bar ends here -->


      <!-- Main content starts here -->
      <div class="row">

        <!-- Expenses start here -->
        <div class="col-md-12 mb-3">

          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4>Expenditure Today</h4>
              <button class="btn"><span class="fa fa-pencil-square-o"></span> Pending Approvals <span class="badge badge-dark badge-pill"><?php no_of_approvals_pending() ?></span></button>
            </div>


            <!-- Fetch checkouts from database starts here -->
              <?php
                expenses_today();
              ?>
              <!-- Fetch checkouts from database ends here -->
            

          </div>

        </div>
        <!-- Expenses ends here -->

        <div class="col text-center mt-3">
          <h3>Total Expenditure: GH¢ <?php $total_expenditure = number_format(total_expenditure(), 2); echo $total_expenditure; ?></h3>
        </div>
      

      </div>
      <!-- Main content ends here -->

    </div>

  </section>

  <!-- Main Body ends here -->






<?php include 'includes/footer.php'; ?>