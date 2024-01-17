<?php
  $page_title = 'Gyedi | Add Order';
  include 'includes/header.php';

  
?>



  <!-- Main Body Starts here -->
  
  <section>
    <div class="container my-5">

        <!-- Form starts here -->
        <form action="add_to_cart.php" method="GET">  

            <!-- Action buttons here -->
            <div class="row mb-5">
                <div class="col-lg-3 col-md-4 text-center py-2">
                    <a href="index.php" class="btn btn-block btn-outline-dark"><span class="fa fa-arrow-left"></span> Back to Dashboard</a>
                </div>
                <div class="col-lg-3 col-md-4 offset-lg-3 text-center py-2">
                    <button type="submit" name="confirm_order" class="btn btn-block btn-success"><span class="fa fa-cart-plus"></span> Confirm Order</button>
                </div>
                <div class="col-lg-3 col-md-4 text-center py-2">
                    <button type="submit" name="cancel_order" class="btn btn-block btn-danger"><span class="fa fa-remove"></span> Cancel order</button>
                </div>
            </div>
            <!-- Action buttons ends here -->

        
            <!-- Card starts here -->
            <div class="card">
                <div class="card-header">
                    <h4>Fill in order details</h4>
                </div>
                <!-- Card body starts here -->
                <div class="card-body">

                    <!-- Display error messages here -->
                    <?php
                        if(isset($_GET['error'])){
                            $error = $_GET['error'];

                            switch ($error) {
                                case 'emptyCart':
                                    echo '<p id="error" class="text-center">Add a service</p>';
                                    break;

                                case 'emptyService':
                                    echo '<p id="error" class="text-center">Select a service</p>';
                                    break;
                                
                                case 'emptyQuantity':
                                    echo '<p id="error" class="text-center">Enter a quantity</p>';
                                    break;

                                case 'attendant':
                                    echo '<p id="error" class="text-center">Select an attendant</p>';
                                    break;

                                case 'customerName':
                                    echo '<p id="error" class="text-center">Invalid Customer Name</p>';
                                    break;

                                case 'customerPhone':
                                    echo '<p id="error" class="text-center">Invalid Customer Phone</p>';
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        }
                    ?>


                    <!-- Select service -->
                    <div class="form-group">
                        <label for="service">Add Services <span class="required">*</span></label><br>
                        <div class="input-group <?php if(isset($_GET['error']) && $_GET['error']=='emptyCart'){echo 'input-required';} ?>">
                            <select name="service_id" id="service" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyService'){echo 'input-required';} ?>" style="width:45%;">
                                <option value="">Select service...</option>
                                
                                
                                <!-- Display services -->
                                <?php show_services(); ?>

                            </select>
                            <!-- Services end here -->

                            <!-- Enter Quantity -->
                            <input type="number" name="quantity" id="quantity" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyQuantity'){echo 'input-required';} ?>" placeholder="Quantity" min="1" value="<?php if(isset($_GET['quantity'])){echo $_GET['quantity'];} ?>">


                            <!-- Add service button -->
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit" name="add_to_cart"><span class="fa fa-cart-plus"></span> Add...</button>
                            </div>
                            
                        </div><br>
                    </div>

                    

                    <!-- Display cart here -->
                    <?php
                        display_cart();
                    ?>


                    <!-- Select Attendant -->
                    <div class="form-group">
                        <label for="attendant_id">Attendant <span class="required">*</span></label>
                        <select name="attendant_id" id="attendant_id" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='attendant'){echo 'input-required';} ?>">
                            <option value="">Select Attendant...</option>
                            
                            <!-- Display attendants in branch -->
                            <?php show_attendants(); ?>

                        </select>
                    </div>


                    <!-- Enter Customer name -->
                    <div class="form-group">
                        <label for="name">Customer</label>
                        <input type="text" name="customer_name" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='customerName'){echo 'input-required';} ?>" placeholder="Enter customer name" id="name" pattern="[a-z A-Z]+" value="<?php if(isset($_GET['customer_name'])){echo $_GET['customer_name'];} ?>">
                    </div>


                    <!-- Enter Customer number -->
                    <div class="form-group">
                        <label for="customer_phone">Phone number</label>
                        <input type="tel" name="customer_phone" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='customerPhone'){echo 'input-required';} ?>" placeholder="024xxxxxxx" id="customer_phone" maxlength="10" minlength="10" pattern="[0]{1}[0-9]{9}" value="<?php if(isset($_GET['customer_phone'])){echo $_GET['customer_phone'];} ?>">
                    </div>
                    
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
