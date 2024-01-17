<?php
  $page_title = 'Gyedi | Receipt';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->
  
  <section>
    <div class="container my-5">
      

      <!-- Receipt header starts here -->
      <div class="d-flex justify-content-between">
        <div class="">
            <img src="../img/logo.png" alt="logo" class="logo img-fluid">
        </div>
        <div class="my-auto">
            <h4>OFFICIAL RECEIPT</h4>
        </div>
        <div class="">
            <p class="text-right">
              <?php echo $_SESSION['address_1'] . '<br>' . $_SESSION['address_2'] . '<br>' . $_SESSION['address_3']; ?>
            </p>
        </div>
      </div><hr><br>
      <!-- Receipt header ends here -->



      <!-- Main content starts here -->
      <div class="row">

        <!-- Order details starts here -->
        <div class="col-md-12 mb-3">


            <!-- Display services rendered starts here -->
            <?php
                if(isset($_GET['checkout_id'])){
                    // Get checkout id
                    $checkout_id = $_GET['checkout_id'];
                    check_checkout_branch($checkout_id);
                    
                    // display receipt for checkout id
                    display_receipt($checkout_id);
                }
                else{
                    header("Location: checkouts.php");
                }

            ?>
            <!-- Display services rendered ends here -->
            

        </div>
        <!-- Order details ends here -->


      

      </div><br>
      <!-- Main content ends here -->


      <!-- Action buttons here -->
      <div class="row mb-5 actionButtons print">
        <div class="col-md-3 offset-md-9 text-center py-2">
            <button type="button" class="btn btn-block btn-primary" onclick="print();"><span class="fa fa-print"></span> Print</button>
        </div>
      </div>
      <!-- Action buttons ends here -->

    </div>

  </section>

  <!-- Main Body Starts here -->





<?php include 'includes/footer.php'; ?>