<?php
  $page_title = 'Gyedi | Add Expenses';
  include 'includes/header.php';



if(isset($_GET['add_expense'])){
    $expenditure_name = $_GET['expenditure_name'];
    $amount = $_GET['amount'];
    $worker_id = $_GET['worker_id'];
    

    if(empty($expenditure_name)){
        header("Location: add_expenses.php?error=emptyExpName&amount=$amount&worker_id=$worker_id");
    }
    elseif(empty($amount)){
        header("Location: add_expenses.php?error=emptyAmount&expenditure_name=$expenditure_name&worker_id=$worker_id");
    }
    elseif($amount < 0.10){
        header("Location: add_expenses.php?error=amount&expenditure_name=$expenditure_name&amount=$amount&worker_id=$worker_id");
    }
    // Check if attendant is selected
    elseif(empty($worker_id)){
        header("Location: add_expenses.php?error=worker&expenditure_name=$expenditure_name&amount=$amount");
    }
    else{
        add_to_expense($expenditure_name, $amount, $worker_id);
        header("Location: add_expenses.php?expense=success&worker_id=$worker_id");
        
    }
}



if(isset($_GET['remove_from_expense'])){
    $expense_id = $_GET['remove_from_expense'];
    $worker_id = $_GET['worker_id'];
   
    remove_from_expense_cart($expense_id);
    header("Location: add_expenses.php?remove=success&worker_id=$worker_id");
}



if(isset($_GET['confirm_expense'])){
    $worker_id = $_GET['worker_id'];
    $expenditure_name = $_GET['expenditure_name'];
    $amount = $_GET['amount'];
    
    // Check if expense_cart is empty
    $in_cart = check_in_expense_cart();

    if($in_cart < 1){
        header("Location: add_expenses.php?error=noExpense&worker_id=$worker_id&expenditure_name=$expenditure_name&amount=$amount");
        
    }


    // Check if expenditure name is valid
    elseif(isset($_GET['expenditure_name']) && !empty($_GET['expenditure_name'])){
        $expenditure_name = $_GET['expenditure_name'];

        if(!preg_match("/^[a-z A-Z 0-9]*$/", $expenditure_name)){
            header("Location: add_expenses.php?error=ExpName&worker_id=$worker_id");
        }
        else{
            // confirm expense (insert into db)
            $order_id = confirm_expenses($worker_id);
            header("Location: expenses.php");
        }
    }

   else{
        // confirm expense (insert into db)
        confirm_expenses();
        header("Location: expenses.php");
    }

    

}


  
?>






  <!-- Main Body Starts here -->
  
  <section>
    <div class="container my-5">

        <!-- Form starts here -->
        <form action="add_expenses.php" method="GET">  

            <!-- Action buttons here -->
            <div class="row mb-5">
                <div class="col-lg-3 col-md-4 text-center py-2">
                    <a href="index.php" class="btn btn-block btn-outline-dark"><span class="fa fa-arrow-left"></span> Back to Dashboard</a>
                </div>
                <div class="col-lg-3 col-md-4 offset-lg-6 offset-md-4 text-center py-2">
                    <button type="submit" name="confirm_expense" class="btn btn-block btn-success"><span class="fa fa-check"></span> Confirm Expenses</button>
                </div>
            </div>
            <!-- Action buttons ends here -->

        
            <!-- Card starts here -->
            <div class="card">
                <div class="card-header">
                    <h4>Fill in expenditure details</h4>
                </div>
                <!-- Card body starts here -->
                <div class="card-body">

                    <!-- Display error messages here -->
                    <?php
                        if(isset($_GET['error'])){
                            $error = $_GET['error'];

                            switch ($error) {
                                case 'noExpense':
                                    echo '<p id="error" class="text-center">Add an expenditure</p>';
                                    break;

                                case 'emptyExpName':
                                    echo '<p id="error" class="text-center">Enter an expenditure</p>';
                                    break;
                                
                                case 'emptyAmount':
                                    echo '<p id="error" class="text-center">Enter an amount</p>';
                                    break;

                                case 'worker':
                                    echo '<p id="error" class="text-center">Select a worker</p>';
                                    break;

                                case 'ExpName':
                                    echo '<p id="error" class="text-center">Select a worker</p>';
                                    break;

                                
                                default:
                                    # code...
                                    break;
                            }
                        }
                    ?>


                    <!-- Select Attendant -->
                    <div class="form-group">
                        <label for="worker_id">Executed by: <span class="required">*</span></label>
                        <select name="worker_id" id="worker_id" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='worker'){echo 'input-required';} ?>">
                            <option value="">Select worker...</option>
                            
                            <!-- Display attendants in branch -->
                            <?php show_workers(); ?>

                        </select>
                    </div><br>


                    <!-- Enter expenditure -->
                    <div class="form-group">
                        <label for="service">Add Expenditure <span class="required">*</span></label><br>
                        <div class="input-group <?php if(isset($_GET['error']) && $_GET['error']=='noExpense'){echo 'input-required';} ?>">

                            <input type="text" name="expenditure_name" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyExpName' || $_GET['error']=='ExpName'){echo 'input-required';} ?>" placeholder="Enter expenditure name" id="name" pattern="[a-z A-Z 0-9]+" value="<?php if(isset($_GET['expenditure_name'])){echo $_GET['expenditure_name'];} ?>"  style="width:45%;">
                        <!-- Enter expenditure ends here -->

                            <!-- Enter Amount -->
                            <input type="number" name="amount" id="amount" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyAmount'){echo 'input-required';} ?>" placeholder="Amount" min="0.10" step="0.10" value="<?php if(isset($_GET['amount'])){echo $_GET['amount'];} ?>">


                            <!-- Add expense button -->
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit" name="add_expense"><span class="fa fa-plus"></span> Add...</button>
                            </div>
                            
                        </div>
                    </div><br>

                    

                    

                    <!-- Display expenses here -->
                    <?php
                        display_expense_cart();
                    ?>


                    
                </div>
                <!-- Card body ends here -->

            </div>
            <!-- Card ends here -->
                
        </form>
        <!-- Form ends here -->

    </div>
    <!-- Container ends here -->

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
