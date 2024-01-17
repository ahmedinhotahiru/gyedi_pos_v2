<?php
  $page_title = 'Gyedi | My Expenses';
  include 'includes/header.php';
  
?>






  <!-- Main Body Starts here -->
  
  <section>
    <div class="container my-5">


      <div class="row">
        <!-- Main content starts here -->
            <div class="col-md-12">

                <!-- SALES REPORT for the day starts here -->
                <div class="row">


                    <!-- Expenses -->
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <p class="card-title"><span class="fa fa-pencil-square-o"></span> My Expenses Today</p>
                            </div>


                            <!-- expenses starts here -->
                            <?php
                                my_expenses_today();
                            ?>
                            <!-- expenses ends here -->

                            <div class="card-footer d-flex justify-content-between">
                                <p>Total number of expenses: <?php echo my_expenses(); ?></p>
                                <p>Total Expenditure: GH¢ <?php $total_expenditure = number_format(my_total_expenses(), 2); echo $total_expenditure; ?></p>
                            </div>
                            

                        </div>
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
