<?php
  $page_title = 'Gyedi | Expenses';
  include 'includes/header.php';




if(isset($_GET['remove_from_expense'])){
    $expense_id = $_GET['remove_from_expense'];
   
    remove_from_expense($expense_id);
    header("Location: approve_expenses.php?remove=success");
}



if(isset($_GET['confirm_expense'])){
    
    // Check if expense_cart is empty
    $in_cart = check_in_expense();

    if($in_cart < 1){
        header("Location: approve_expenses.php?error=noExpense");
        
    }

   else{
        // confirm expense (insert into db)
        approve_expenses();
        header("Location: expenses.php");
    }

    

}


  
?>






  <!-- Main Body Starts here -->
  
  <section>
    <div class="container my-5">

        <!-- Form starts here -->
        <form action="approve_expenses.php" method="GET">  

            <!-- Action buttons here -->
            <div class="row mb-5">
                <div class="col-lg-3 col-md-4 text-center py-2">
                    <a href="expenses.php" class="btn btn-block btn-outline-dark"><span class="fa fa-arrow-left"></span> Back to Expenses</a>
                </div>
                <div class="col-lg-3 col-md-4 offset-lg-6 offset-md-4 text-center py-2">
                    <button type="submit" name="confirm_expense" class="btn btn-block btn-success" onclick="return confirm('Are you sure you want to approve all expenses?');"><span class="fa fa-check"></span> Approve Expenses</button>
                </div>
            </div>
            <!-- Action buttons ends here -->


                    <!-- Display expenses here -->
                    <?php
                        display_expense();
                    ?>


                    
                
                <!-- Card body ends here -->

            
            <!-- Card ends here -->
                
        </form>
        <!-- Form ends here -->

    </div>
    <!-- Container ends here -->

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
