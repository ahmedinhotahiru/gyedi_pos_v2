<?php
  $page_title = 'Gyedi | Cart';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->

  <section>

    <!-- Order details starts here -->
    <div class="container my-5">
       
        <form action="checkout.php" class="form" method="GET">

            <!-- Identify order. If there is no order, redirect to add order page -->
            <?php
                if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
                    $order_id = $_GET['order_id'];

                    // Use order id to identify order details(attendant, customer)
                    $attendant_id="";
                    $customer_name="";
                    $customer_phone="";
                    identify_order_details($order_id);

                }else{
                    header("Location: addOrder.php");
                }
            ?>

            <!-- Action buttons here -->
            <div class="row mb-5">
                <div class="col-lg-3 col-md-4 text-center py-2">
                    <button type="submit" name="checkout" value="<?php echo $order_id; ?>" class="btn btn-block btn-success" onclick="return confirm('Are you sure you want to checkout?');"><span class="fa fa-shopping-cart"></span> Checkout</button>
                </div>
                <div class="col-lg-3 col-md-4 offset-lg-6 offset-md-4 text-center py-2">
                    <button type="submit" name="cancel_order" value="<?php echo $order_id; ?>" class="btn btn-block btn-danger"><span class="fa fa-remove"></span> Cancel order</button>
                </div>
            </div>
            <!-- Action buttons ends here -->
            

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


            <?php
                // Check validity of branch before displaying items
                check_order_branch($order_id);

                display_order_items($order_id);
            ?>

  
            
              
            <!-- Select service -->
            <div class="form-group">
                <label for="service">Add Services</label><br>
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
                        <button class="btn btn-outline-success" type="submit" name="add_to_cart" value="<?php echo $order_id; ?>"><span class="fa fa-cart-plus"></span> Add...</button>
                    </div>
                            
                </div><br>
            </div>
            
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between">
                    <h4>Edit Details</h4>
                </div>
                <div class="card-body">
                    
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
                        <input type="text" name="customer_name" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='customerName'){echo 'input-required';} ?>" placeholder="Enter customer name" id="name" value="<?php if(isset($_GET['customer_name'])){echo $_GET['customer_name'];} ?>">
                    </div>


                    <!-- Enter Customer number -->
                    <div class="form-group">
                        <label for="customer_phone">Phone number</label>
                        <input type="tel" name="customer_phone" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='customerPhone'){echo 'input-required';} ?>" placeholder="024xxxxxxx" id="customer_phone" maxlength="10" minlength="10" pattern="[0]{1}[0-9]{9}" value="<?php if(isset($_GET['customer_phone'])){echo $_GET['customer_phone'];} ?>">
                    </div>

                </div>
            </div>
                
        </form>

    </div>
    <!-- Order details ends here -->

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
