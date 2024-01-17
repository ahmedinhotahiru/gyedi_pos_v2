<?php

// Identify branch before querying database
    $branch = mysqli_real_escape_string($db, $_SESSION['branch']);
    $branch_id = mysqli_real_escape_string($db, $_SESSION['branch_id']);
    $branch_phone = mysqli_real_escape_string($db, $_SESSION['branch_phone']);

// identify user
    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);


// Identify name of cashier
    $cashier = $_SESSION['first_name'] .' '. $_SESSION['last_name'];
    $cashier = mysqli_real_escape_string($db, $cashier);
    


// Identify current date before quering database
    date_default_timezone_set('Africa/Accra');
    $current_date = mysqli_real_escape_string($db, date('d-m-Y'));





// mail sender
function send_mail($to, $subject, $body) {

    // send using PHP mailer
                
    require "../PHPMailer/PHPMailerAutoload.php";
                


    
    
    $from = 'info@gyedienterprise.com';
    $from_name = 'Gyedi Enterprise';
    

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
                            
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gyedienterprise.com';
    $mail->Port = 2525;  
    $mail->Username = 'info@gyedienterprise.com';
    $mail->Password = 'Oe34e7397';
                            
    $mail->IsHTML(true);
    $mail->WordWrap = 50;
    $mail->From = "info@gyedienterprise.com";
    $mail->FromName = $from_name;
    $mail->Sender = $from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);

    
    if($resultMail = $mail->Send()) {
        return true;
    }
    else {
        echo "<script>alert('Please try sending email Later, Error Occured while Processing...');</script>";
        return false;
    }

    // try {
        
        
    //     $mail = new PHPMailer();
    //     $mail->IsSMTP();
    //     $mail->SMTPAuth = true; 
                                
    //     $mail->Host = 'smtp-pulse.com';
    //     $mail->Port = 2525;  
    //     $mail->Username = 'optsys9@gmail.com';
    //     $mail->Password = 'gbogpAL7NKb';
                                
    //     $mail->IsHTML(true);
    //     $mail->WordWrap = 50;
    //     $mail->From = "support@ngsapp.com";
    //     $mail->FromName = $from_name;
    //     $mail->Sender = $from;
    //     $mail->AddReplyTo($from, $from_name);
    //     $mail->Subject = $subject;
    //     $mail->Body = $body;
    //     $mail->AddAddress($to);
    //     $resultMail = $mail->Send();
    //     return true;

    // } catch (Exception $e) {
    //     echo "<script>alert('Please try sending email Later, Error Occured while Processing...');</script>";
    // }
}








// Show all workers in branch function
function show_workers(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for number of orders
    $query = "SELECT * FROM users WHERE branch_id = '$branch_id'";
    $users = mysqli_query($db, $query);

    if(mysqli_num_rows($users) > 0){
        while($user = mysqli_fetch_assoc($users)){
            $user_id = $user['user_id'];
            $full_name = $user['first_name'] .' '. $user['last_name'];

            // Check if worker is selected, if yes echo selected attribute on service
            if(isset($_GET['worker_id'])){
                $selected_id = $_GET['worker_id'];
                if($user_id == $selected_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
            }else{
                    $selected = "";
                }

            echo '<option value="'.$user_id.'"'.$selected.'>'.$full_name.'</option>';
        }
    }
}



// Show all attendants in branch function
function show_attendants(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for number of orders
    $query = "SELECT * FROM users WHERE branch_id = '$branch_id' AND position != 'cashier'";
    $users = mysqli_query($db, $query);

    if(mysqli_num_rows($users) > 0){
        while($user = mysqli_fetch_assoc($users)){
            $user_id = $user['user_id'];
            $full_name = $user['first_name'] .' '. $user['last_name'];

            // Check if attendant is selected, if yes echo selected attribute on service
            if(isset($_GET['attendant_id'])){
                $selected_id = $_GET['attendant_id'];
                if($user_id == $selected_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
            }else{
                    $selected = "";
                }

            echo '<option value="'.$user_id.'"'.$selected.'>'.$full_name.'</option>';
        }
    }
}



// Show all services function
function show_services(){
    global $db; global $branch; global $branch_id; global $current_date;


    // Query the database all services
    $query = "SELECT * FROM services ORDER BY `service_name` ASC";
    $services = mysqli_query($db, $query);


    if(mysqli_num_rows($services) > 0){
        while($service = mysqli_fetch_assoc($services)){
            $service_id = $service['service_id'];
            $service_name = $service['service_name'];

            // Check if service is selected, if yes echo selected attribute on service
            if(isset($_GET['service_id'])){
                $selected_id = $_GET['service_id'];
                if($service_id == $selected_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
            }else{
                    $selected = "";
                }

            echo '<option value="'.$service_id.'"'.$selected.'>'.$service_name.'</option>';
        }
    }
}



// Number of orders function
function no_of_orders(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for number of orders
    $query = "SELECT * FROM orders WHERE branch_id = '$branch_id' AND order_date = '$current_date'";
    $orders = mysqli_query($db, $query);
    $no_of_orders = mysqli_num_rows($orders);
      
    echo $no_of_orders;
}



// Number of checkouts function
function no_of_checkouts(){
    global $db; global $branch; global $branch_id; global $current_date;
    
    // Query the database for number of checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$current_date'";
    $checkouts = mysqli_query($db, $query);
    $no_of_checkouts = mysqli_num_rows($checkouts);
    echo $no_of_checkouts;
}



// Number of checkouts function
function no_of_checkouts2($date){
    global $db; global $branch; global $branch_id;
    
    // Query the database for number of checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$date'";
    $checkouts = mysqli_query($db, $query);
    $no_of_checkouts = mysqli_num_rows($checkouts);
    return $no_of_checkouts;
}



// Number of expenses function
function no_of_expenses(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for number of expenses
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$current_date' AND approval=1";
    $expenses = mysqli_query($db, $query);
    $no_of_expenses = mysqli_num_rows($expenses);
      
    echo $no_of_expenses;
}



// Number of expenses function
function no_of_expenses2($date){
    global $db; global $branch; global $branch_id;

    // Query the database for number of expenses
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$date' AND approval=1";
    $expenses = mysqli_query($db, $query);
    $no_of_expenses = mysqli_num_rows($expenses);
      
    return $no_of_expenses;
}



// Display branch search checkouts function
function checkouts2($date){
    global $db; global $branch_id;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    // Query the database for checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$date' ORDER BY checkout_id DESC;";

    $latest_checkouts = mysqli_query($db, $query);
    
    if(mysqli_num_rows($latest_checkouts) < 1){
        echo '<div class="card-body">
                <p class="text-primary">No checkouts made</p>
              </div>';
    }
    else{
        echo '<div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Order No.</th>
                      <th>Customer Name</th>
                      <th>Amount</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>';
                $counter = 1;
                while($checkout = mysqli_fetch_assoc($latest_checkouts)){
                    $checkout_id = $checkout['checkout_id'];
                    $customer_name = $checkout['customer_name'];
                    $order_no = $checkout['order_no'];
                    $branch_id = $checkout['branch_id'];
                    $order_amount = $checkout['order_amount'];
                    $order_amount = number_format($order_amount, 2);
                  echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$order_no.'</td>
                      <td>'.$customer_name.'</td>
                      <td>'.$order_amount.'</td>
                      <td><a href="orderDetails.php?checkout_id='.$checkout_id.'&branch_id='.$branch_id.'" class="btn btn-sm btn-outline-secondary"><span class="fa fa-angle-double-right"></span> Details</a></td>
                    </tr>';
                $counter ++;
                }
                echo '
                  </tbody>
                </table>
              </div>';
    }
}



// Cancel order modal function
function cancel_order_modal(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for all ongoing orders
    $query = "SELECT * FROM orders WHERE branch_id = '$branch_id' AND order_date = '$current_date' ORDER BY order_id DESC";
    $orders = mysqli_query($db, $query);
    
    if(mysqli_num_rows($orders) < 1){
        echo '<p class="modal-text" style="font-weight:500;">There are no ongoing orders</p>';
    }
    else{
        while($order = mysqli_fetch_assoc($orders)){
            $order_id = $order['order_id'];
            $order_no = $order['order_no'];
            $customer_name = $order['customer_name'];
            $attendant = $order['attendant'];
            echo '<fieldset>
                            <div class="radio">
                                <label>
                                <input type="radio" name="cancel_order_id" value="'.$order_id.'"> <h6 class="d-inline">Order No: '.$order_no.'</h6>
                                </label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="modal-text">Customer name: '.$customer_name.'</p>
                                <p class="modal-text">Attendant: '.$attendant.'</p>
                            </div>
                        </fieldset><hr>';
        }
            echo '<div class="text-right mb-0">
                    <button type="submit" class="btn btn-danger"><span class="fa fa-remove"></span> Delete Order</button>
                    <button class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  </div>';
        
    }
}



// View cart modal function
function view_cart_modal(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for all ongoing orders
    $query = "SELECT * FROM orders WHERE branch_id = '$branch_id' AND order_date = '$current_date' ORDER BY order_id DESC";
    $orders = mysqli_query($db, $query);
    
    if(mysqli_num_rows($orders) < 1){
        echo '<p class="modal-text" style="font-weight:500;">There are no orders in cart</p>';
    }
    else{
        while($order = mysqli_fetch_assoc($orders)){
            $order_id = $order['order_id'];
            $order_no = $order['order_no'];
            $customer_name = $order['customer_name'];
            $customer_phone = $order['customer_phone'];
            $attendant_id = $order['attendant_id'];
            $attendant = $order['attendant'];
            echo '<div class="d-flex justify-content-between">
                    <div>
                        <h6>Order No: '.$order_no.'</h6>
                        <p class="modal-text">Customer name: '.$customer_name.'</p>
                    </div>
                    <div>
                        <a href="cart.php?order_id='.$order_id.'&attendant_id='.$attendant_id.'&customer_name='.$customer_name.'&customer_phone='.$customer_phone.'" class="btn btn-sm btn-outline-success"><span class="fa fa-shopping-cart"></span> View cart</a>
                    </div>
                  </div><hr>';
        }
    }
}



// Search for ongoing orders function
function search_order($search_keywords){
    global $db; global $branch; global $branch_id; global $current_date;

    $search_keywords = mysqli_real_escape_string($db, $search_keywords);

    // Query the database for search input
    $query = "SELECT * FROM orders WHERE customer_name LIKE '%$search_keywords%' OR order_no LIKE '%$search_keywords%' AND branch_id = '$branch_id' ORDER BY order_id DESC";
    $orders = mysqli_query($db, $query);

    if( (mysqli_num_rows($orders) < 1) || empty($_GET['search_keywords'])){
        echo '
        <div class="col-md-12 mb-3">

          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4>Search Results (0)</h4>
              <a href="orders.php" class="mt-2"><span class="fa fa-angle-double-left"></span> Back to orders</a>
            </div>
            <div class="card-body">
              <b><p class="text-danger">No results found for your search</p></b>
            </div>
        </div>';
    }
    else{
        
                echo '
                <div class="col-md-12 mb-3">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    <h4>Search Results ('.mysqli_num_rows($orders).')</h4>
                    <a href="orders.php" class="mt-2"><span class="fa fa-angle-double-left"></span> Back to orders</a>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>';
                    $counter = 1;
                    while($order = mysqli_fetch_assoc($orders)){
                        $order_id = $order['order_id'];
                        $customer_name = $order['customer_name'];
                        $order_no = $order['order_no'];
                        $order_amount = $order['order_amount'];
                        $order_amount = number_format($order_amount, 2);
                        echo '
                        <tr>
                            <td>'.$counter.'</td>
                            <td>'.$order_no.'</td>
                            <td>'.$customer_name.'</td>
                            <td>'.$order_amount.'</td>
                            <td><a href="cart.php?order_id='.$order_id.'" class="btn btn-sm btn-outline-success"><span class="fa fa-shopping-cart"></span> View cart</a></td>
                        </tr>';
                        $counter ++;
                    }
                        echo '
                        </tbody>
                    </table>
                    </div>
                </div>

                </div>
                <!-- Search results ends here -->';
                
                
    }

}



// Search for checkouts function
function search_checkout($search_keywords){
    global $db; global $branch; global $branch_id; global $current_date;

    $search_keywords = mysqli_real_escape_string($db, $search_keywords);    

    // Query the database for search input
    $query = "SELECT * FROM checkouts WHERE customer_name LIKE '%$search_keywords%' OR order_no LIKE '%$search_keywords%' OR checkout_date LIKE '%$search_keywords%' AND branch_id = '$branch_id' ORDER BY checkout_id DESC";
    $checkouts = mysqli_query($db, $query);

    if( (mysqli_num_rows($checkouts) < 1) || empty($_GET['search_keywords'])){
        echo '
        <div class="col-md-12 mb-3">

          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4>Search Results (0)</h4>
              <a href="checkouts.php" class="mt-2"><span class="fa fa-angle-double-left"></span> Back to checkouts</a>
            </div>
            <div class="card-body">
              <b><p class="text-danger">No results found for your search</p></b>
            </div>
        </div>';
    }
    else{
        
                echo '
                <div class="col-md-12 mb-3">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    <h4>Search Results ('.mysqli_num_rows($checkouts).')</h4>
                    <a href="checkouts.php" class="mt-2"><span class="fa fa-angle-double-left"></span> Back to checkouts</a>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>';
                    $counter = 1;
                    while($checkout = mysqli_fetch_assoc($checkouts)){
                        $checkout_id = $checkout['checkout_id'];
                        $customer_name = $checkout['customer_name'];
                        $order_no = $checkout['order_no'];
                        $order_amount = $checkout['order_amount'];
                        $checkout_date = $checkout['checkout_date'];
                        $order_amount = number_format($order_amount, 2);
                        echo '
                        <tr>
                            <td>'.$counter.'</td>
                            <td>'.$order_no.'</td>
                            <td>'.$customer_name.'</td>
                            <td>'.$order_amount.'</td>
                            <td>'.$checkout_date.'</td>
                            <td><a href="orderDetails.php?checkout_id='.$checkout_id.'" class="btn btn-sm btn-outline-secondary"><span class="fa fa-angle-double-right"></span> Details</a></td>
                        </tr>';
                        $counter ++;
                    }
                        echo '
                        </tbody>
                    </table>
                    </div>
                </div>

                </div>
                <!-- Search results ends here -->';
                
                
    }

}



// Search for expenses function
function search_expense($search_keywords){
    global $db; global $branch; global $branch_id; global $current_date;

    $search_keywords = mysqli_real_escape_string($db, $search_keywords);    

    // Query the database for search input
    $query = "SELECT * FROM expense WHERE expense_name LIKE '%$search_keywords%' OR executed_by LIKE '%$search_keywords%' OR expense_date LIKE '%$search_keywords%' AND branch_id = '$branch_id' ORDER BY expense_id DESC";
    $expenses = mysqli_query($db, $query);

    if( (mysqli_num_rows($expenses) < 1) || empty($_GET['search_keywords'])){
        echo '
        <div class="col-md-12 mb-3">

          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4>Search Results (0)</h4>
              <a href="expenses.php" class="mt-2"><span class="fa fa-angle-double-left"></span> Back to expenses</a>
            </div>
            <div class="card-body">
              <b><p class="text-danger">No results found for your search</p></b>
            </div>
        </div>';
    }
    else{
        
                echo '
                <div class="col-md-12 mb-3">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    <h4>Search Results ('.mysqli_num_rows($expenses).')</h4>
                    <a href="expenses.php" class="mt-2"><span class="fa fa-angle-double-left"></span> Back to expenses</a>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Expenditure</th>
                            <th>Amount</th>
                            <th>Executed by</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>';
                    $counter = 1;
                    while($expense = mysqli_fetch_assoc($expenses)){
                        $expense_id = $expense['expense_id'];
                        $expense_name = $expense['expense_name'];
                        $expense_amount = $expense['expense_amount'];
                        $executed_by = $expense['executed_by'];
                        $expense_date = $expense['expense_date'];
                        $expense_time = $expense['expense_time'];
                        $expense_amount = number_format($expense_amount, 2);
                        echo '
                        <tr>
                            <td>'.$counter.'</td>
                            <td>'.$expense_name.'</td>
                            <td>'.$expense_amount.'</td>
                            <td>'.$executed_by.'</td>
                            <td>'.$expense_date.'</td>
                            <td>'.$expense_time.'</td>
                        </tr>';
                        $counter ++;
                    }
                        echo '
                        </tbody>
                    </table>
                    </div>
                </div>

                </div>
                <!-- Search results ends here -->';
                
                
    }

}


// Display latest checkouts function
function latest_checkouts(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$current_date' ORDER BY checkout_id DESC;";

    $latest_checkouts = mysqli_query($db, $query);
    
    if(mysqli_num_rows($latest_checkouts) < 1){
        echo '<div class="card-body">
                <b><p class="text-primary">No checkouts made for today</p></b>
              </div>';
    }
    else{
        echo '<div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Order No.</th>
                      <th>Customer Name</th>
                      <th>Amount</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>';
                $counter = 1;
                while($checkout = mysqli_fetch_assoc($latest_checkouts)){
                    $checkout_id = $checkout['checkout_id'];
                    $customer_name = $checkout['customer_name'];
                    $order_no = $checkout['order_no'];
                    $order_amount = $checkout['order_amount'];
                    $order_amount = number_format($order_amount, 2);
                  echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$order_no.'</td>
                      <td>'.$customer_name.'</td>
                      <td>'.$order_amount.'</td>
                      <td><a href="orderDetails.php?checkout_id='.$checkout_id.'" class="btn btn-sm btn-outline-secondary"><span class="fa fa-angle-double-right"></span> Details</a></td>
                    </tr>';
                $counter ++;
                }
                echo '
                  </tbody>
                </table>
              </div>';
    }
}



// Display ongoing function
function ongoing_orders(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for all ongoing orders
    $query = "SELECT * FROM orders WHERE branch_id = '$branch_id' AND order_date = '$current_date' ORDER BY order_id DESC;";

    $ongoing_orders = mysqli_query($db, $query);
    
    if(mysqli_num_rows($ongoing_orders) < 1){
        echo '<div class="card-body">
                <b><p class="text-primary">There are no ongoing orders</p></b>
              </div>';
    }
    else{
        echo '<div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Order No.</th>
                      <th>Customer Name</th>
                      <th>Amount</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>';
                $counter = 1;
        
                while($order = mysqli_fetch_assoc($ongoing_orders)){
                    $order_id = $order['order_id'];
                    $customer_name = $order['customer_name'];
                    $customer_phone = $order['customer_phone'];
                    $attendant_id = $order['attendant_id'];
                    $order_no = $order['order_no'];

                    // Calculate order amount
                    $query = "SELECT * FROM order_cart WHERE branch_id = '$branch_id' AND order_no = '$order_no'";
                    $result6 = mysqli_query($db, $query);

                    $order_amount = 0;
                    while($order_c = mysqli_fetch_assoc($result6)){
                        $order_amount += $order_c['cart_amount'];
                    }


                    
                    $order_amount = number_format($order_amount, 2);
                  echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$order_no.'</td>
                      <td>'.$customer_name.'</td>
                      <td>'.$order_amount.'</td>
                      <td><a href="cart.php?order_id='.$order_id.'&attendant_id='.$attendant_id.'&customer_name='.$customer_name.'&customer_phone='.$customer_phone.'" class="btn btn-sm btn-outline-success"><span class="fa fa-shopping-cart"></span> View cart</a></td>
                    </tr>';
                $counter ++;
                }
                echo '
                  </tbody>
                </table>
              </div>';
    }
}



// Salary login page function
function salary_login(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Check if any field is left empty

    if(empty($_POST['username']) || empty($_POST['password'])){
        echo '<div class="row">
                <div class="col-md-6 offset-md-3 text-center"><p id="error">All fields are required</p></div>
             </div>';
    }
    // Get username and password user inputs

    else{
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $position = mysqli_real_escape_string($db, $_SESSION['position']);
        $user = mysqli_real_escape_string($db, $_SESSION['user_id']);

        // Check if user exists in database

        $query = "SELECT * FROM users WHERE username = '$username' AND position='$position' AND user_id='$user';";
        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result) < 1){
            echo '<div class="row">
                    <div class="col-md-6 offset-md-3 text-center"><p id="error">Invalid username</p></div>
                </div>';          
        }
        // Verify user password

        elseif(mysqli_num_rows($result) == 1){
            if($user = mysqli_fetch_assoc($result)){
                $hashedPassword = $user['password'];
                $verify_password = password_verify($password, $hashedPassword);

                if($verify_password == false){
                    echo '<div class="row">
                            <div class="col-md-6 offset-md-3 text-center"><p id="error">Invalid password</p></div>
                        </div>';
                }
                // Log the user in
                elseif($verify_password == true){
                    $_SESSION['salary'] = $user['salary'];
                    echo '<div class="row">
                            <div class="col-md-6 offset-md-3 text-center"><a href="salary.php" class="btn btn-block btn-primary" style="font-weight: 500;"><span class="fa fa-list"></span> View Salary Report</a></div>
                        </div>';

                }
            }
        }
    }
}



// Generate random order number function
function order_no_generate(){
    global $db; global $branch; global $current_date; global $cashier;
    
    // Generate order number
    $order_no = strtoupper(date('Mdy')) .rand(10000, 50000);
    $order_no = mysqli_real_escape_string($db, $order_no);

    // Query the database to see if order number exists
    $query = "SELECT * FROM checkouts WHERE order_no = '$order_no'";
    $result = mysqli_query($db, $query);

    // while order number exists, generate new one
    while(mysqli_num_rows($result) > 0){
        $order_no = strtoupper(date('Mdy')) .rand(10000, 50000);
        $query = "SELECT * FROM checkouts WHERE order_no = '$order_no'";
        $result = mysqli_query($db, $query);  
    }

    return $order_no;
}



// Add service(item) to cart function
function add_to_cart($service_id, $quantity){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;


    // Get service and quantity entered by user
    $service_id = mysqli_real_escape_string($db, $service_id);
    $quantity = mysqli_real_escape_string($db, $quantity);
    
     // Identify service name and unit price
     $query = "SELECT * FROM services WHERE service_id=$service_id";
     $result = mysqli_query($db, $query);

     if($service = mysqli_fetch_assoc($result)){
         $service_name = $service['service_name'];
         $service_unit_price = $service['service_unit_price'];
         
         // Calculate price for service
         $service_amount = $service_unit_price * $quantity;

        //  Insert service into cart
        $query = "INSERT INTO `cart` (`cart_item_id`,`cart_item_name`, `cart_item_price`, `cart_quantity`, `cart_amount`, `cashier`, `branch`, `branch_id`) VALUES ('$service_id', '$service_name', '$service_unit_price', '$quantity', '$service_amount', '$cashier', '$branch', '$branch_id')";
        $result = mysqli_query($db, $query);
     }
}



// Remove service(item) from cart function
function remove_from_cart($cart_id){
    global $db; global $branch; global $current_date; global $cashier;


    // Get cart item clicked by user
    $cart_id = mysqli_real_escape_string($db, $cart_id);

    // Remove item from cart
    $query = "DELETE FROM `cart` WHERE `cart`.`cart_id` = $cart_id;";
    $result = mysqli_query($db, $query);

    if($result == false){
        die("An error occured. Try again");
    }
}



// Remove service(item) from order_cart function
function remove_from_order_cart($cart_id){
    global $db; global $branch; global $current_date; global $cashier;


    // Get cart item clicked by user
    $cart_id = mysqli_real_escape_string($db, $cart_id);


    // Remove item from cart
    $query = "DELETE FROM `order_cart` WHERE `order_cart`.`cart_id` = $cart_id;";
    $result = mysqli_query($db, $query);

    if($result == false){
        die("An error occured. Try again");
    }

}


// Check number of items in cart function
function check_in_cart(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Query database for all items in cart
    $query = "SELECT * FROM cart WHERE branch_id='$branch_id' AND cashier='$cashier'";
    $cart = mysqli_query($db, $query);
    $no_of_items = mysqli_num_rows($cart);
    return $no_of_items;
}


// Display cart function
function display_cart(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Query database for all items in cart and display them
    $query = "SELECT * FROM cart WHERE branch_id='$branch_id' AND cashier='$cashier'";
    $cart = mysqli_query($db, $query);
    $no_of_cart_items = mysqli_num_rows($cart);
    
    if($no_of_cart_items > 0){
        echo '<p class="text-muted">Items added ('.$no_of_cart_items.') </p>
                <div class="table-responsive w-75">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="">
                            <tr>
                                <th>Service</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
        // Accumulator to store order total
        $order_total_amount = 0;
        while($item = mysqli_fetch_assoc($cart)){
            $cart_id = $item['cart_id'];
            $service = $item['cart_item_name'];
            $unit_price = $item['cart_item_price'];
            $quantity = $item['cart_quantity'];
            $amount = $item['cart_amount'];

                        echo '<tr>
                                <td>'.$service.'</td>
                                <td>'.$unit_price.'</td>
                                <td>'.$quantity.'</td>
                                <td>'.$amount.'</td>
                                <td><button type="submit" name="remove_from_cart" value="'.$cart_id.'" class="btn btn-sm btn-outline-danger" style="border:none;"><span class="fa fa-remove"></span> Remove</button></td>
                            </tr>';
            $order_total_amount += $amount;
        }
            $order_total_amount = number_format($order_total_amount, 2);
                    echo '<tr>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td><strong>GH¢ '.$order_total_amount.'</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div><br>';
    }
}



// Empty cart function
function empty_cart(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Empty cart
    $query = "DELETE FROM `cart` WHERE branch_id='$branch_id' AND cashier='$cashier';";
    $result = mysqli_query($db, $query);

    if($result == false){
        die("An error occured. Try again");
    }
}


// Cancel order function
function cancel_order($cancel_order_id){
    global $db; global $branch; global $branch_id; global $current_date;

    $cancel_order_id = mysqli_real_escape_string($db, $cancel_order_id);

    // Identify order no.
    $query = "SELECT * FROM `orders` WHERE `orders`.`order_id` = '$cancel_order_id'";
    $result1 = mysqli_query($db, $query);
    if($order = mysqli_fetch_assoc($result1)){
        $order_no = $order['order_no'];
    }

    // Clear order_cart table first
    $query = "DELETE FROM `order_cart` WHERE `order_cart`.`order_no` = '$order_no' AND branch_id='$branch_id'";
    $result = mysqli_query($db, $query);

    // Delete order from orders table in database
    $query = "DELETE FROM `orders` WHERE `orders`.`order_id` = '$cancel_order_id'";
    $result = mysqli_query($db, $query);

    if($result == false){
        die("Database query failed");
    }
    else{
        header("Location: index.php?cancel=success");
    }
}



// Confirm order (addOrder.php) function
function confirm_order($customer_name, $customer_phone, $order_no, $attendant_id){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Convert name to lowercase
    $customer_name = strtolower($customer_name);

    // Escape all values before querying database
    $customer_name = mysqli_real_escape_string($db, ucwords($customer_name));
    $customer_phone = mysqli_real_escape_string($db, $customer_phone);
    $order_no = mysqli_real_escape_string($db, $order_no);
    $attendant_id = mysqli_real_escape_string($db, $attendant_id);

    // Identify attendant
    $query = "SELECT * FROM users WHERE user_id='$attendant_id';";
    $users = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($users)){
        $attendant = $user['first_name'] .' '. $user['last_name'];
    }
    // Generate order time.
    $order_time = date('g:i A');
    
    $query = "SELECT * FROM cart WHERE branch_id='$branch_id' AND cashier='$cashier'";
    $cart = mysqli_query($db, $query);

    if(mysqli_num_rows($cart) > 0){

        // Get each item and insert into order_cart
        while($item = mysqli_fetch_assoc($cart)){
            $cart_item_id = $item['cart_item_id'];
            $cart_item_name = $item['cart_item_name'];
            $cart_item_price = $item['cart_item_price'];
            $cart_quantity = $item['cart_quantity'];
            $cart_amount = $item['cart_amount'];

            $query = "INSERT INTO `order_cart` (`cart_item_id`, `cart_item_name`, `cart_item_price`, `cart_quantity`, `cart_amount`, `order_no`, `cashier`, `branch`, `branch_id`) VALUES ('$cart_item_id', '$cart_item_name', '$cart_item_price', '$cart_quantity', '$cart_amount', '$order_no', '$cashier', '$branch', '$branch_id')";

            $result = mysqli_query($db, $query);
        }

        // Insert order details into orders
        $query = "INSERT INTO `orders` (`customer_name`, `customer_phone`, `order_no`, `order_date`, `branch`, `branch_id`, `attendant`, `attendant_id`) VALUES ('$customer_name', '$customer_phone', '$order_no', '$current_date', '$branch', '$branch_id', '$attendant', '$attendant_id')";

        $result2 = mysqli_query($db, $query);

        // Clear cart after inserting and confirming order
        $query = "DELETE FROM `cart` WHERE cashier='$cashier' AND branch_id='$branch_id'";
        $result = mysqli_query($db, $query);

        // Get order id inserted and return it
        $query = "SELECT * FROM orders WHERE order_no='$order_no' AND branch_id='$branch_id'";
        $result3 = mysqli_query($db, $query);
        if($order = mysqli_fetch_assoc($result3)){
            $order_id = $order['order_id'];
            return $order_id;
        }
    }

    
}




// Confirm checkout (cart.php) function
function confirm_checkout($customer_name, $customer_phone, $order_no, $attendant_id, $order_id){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Checkouts inserted values should be static(Hard inserted)

    // Convert name to lowercase
    $customer_name = strtolower($customer_name);

    // Escape all values before querying database
    $customer_name = mysqli_real_escape_string($db, ucwords($customer_name));
    $customer_phone = mysqli_real_escape_string($db, $customer_phone);
    $order_no = mysqli_real_escape_string($db, $order_no);
    $attendant_id = mysqli_real_escape_string($db, $attendant_id);
    $order_id = mysqli_real_escape_string($db, $order_id);
    $cashier_id = mysqli_real_escape_string($db, $_SESSION['user_id']);
    $branch_phone = mysqli_real_escape_string($db, $_SESSION['branch_phone']);
    

    // Generate checkout time
    $checkout_time = date('g:i A');
    
    $query = "SELECT * FROM order_cart WHERE branch_id='$branch_id' AND cashier='$cashier' AND order_no='$order_no'";
    $order_cart = mysqli_query($db, $query);

    if(mysqli_num_rows($order_cart) > 0){

        // Insert all items into checkout_items
        $order_amount = 0;
        while($item = mysqli_fetch_assoc($order_cart)){
                $service_id = $item['cart_item_id'];
                $service_name = $item['cart_item_name'];
                $quantity = $item['cart_quantity'];
                $unit_price = $item['cart_item_price'];
                $amount = $item['cart_amount'];
                $order_amount += $amount;

                $query = "INSERT INTO checkout_items(`item_id`, `item_name`, `item_price`, `item_quantity`, `item_amount`, `order_no`, `cashier`, `branch`, `branch_id`, `checkout_date`) VALUES('$service_id', '$service_name', '$unit_price', '$quantity', '$amount', '$order_no', '$cashier', '$branch', '$branch_id', '$current_date')";
                $result = mysqli_query($db, $query);
        }

        
        // Identify attendant
        $query = "SELECT * FROM users WHERE user_id='$attendant_id';";
        $users = mysqli_query($db, $query);

        if($user = mysqli_fetch_assoc($users)){
            $attendant = $user['first_name'] .' '. $user['last_name'];
        }

        // Insert checkout details into database (checkouts table)
        $query = "INSERT INTO `checkouts` (`customer_name`, `customer_phone`, `order_no`, `order_amount`, `checkout_date`, `checkout_time`, `branch`, `branch_id`, `branch_phone`, `attendant`, `attendant_id`, `cashier`, `cashier_id`) VALUES ('$customer_name', '$customer_phone', '$order_no', '$order_amount', '$current_date', '$checkout_time', '$branch', '$branch_id', '$branch_phone', '$attendant', '$attendant_id', '$cashier', '$cashier_id')";

        $result = mysqli_query($db, $query);

        // Delete all individual order_cart items from order_cart table in db
        $query = "DELETE FROM order_cart WHERE branch_id='$branch_id' AND order_no='$order_no'";
        $result = mysqli_query($db, $query);

        if($result == false){
            die("An error occured, try again");  
        }
        else{
            // Delete order from orders table
            $query = "DELETE FROM orders WHERE branch_id='$branch_id' AND order_id='$order_id';";
            $result = mysqli_query($db, $query);
        }


        // If successful, get checkout id of inserted checkout, and return it
        $query = "SELECT * FROM checkouts WHERE branch_id='$branch_id' AND order_no='$order_no'";
        $result2 = mysqli_query($db, $query);

        if(mysqli_num_rows($result2) == 1){
            if($checkout = mysqli_fetch_assoc($result2)){
                $checkout_id = $checkout['checkout_id'];
                return $checkout_id;
            }
        }


    }
    
}



// Display order items (cart.php) function
function display_order_items($order_id){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Get order id and identify order
    $order_id = mysqli_real_escape_string($db, $order_id);

    // Identify order no.
    $query = "SELECT * FROM `orders` WHERE `orders`.`order_id` = '$order_id'";
    $result1 = mysqli_query($db, $query);
    if($order = mysqli_fetch_assoc($result1)){
        $order_no = $order['order_no'];
    }else{
        die("Invalid order id");
    }

    echo '<h4>Order No: '.$order_no.'</h4><br>';


    // Query database for order items and display them
    $query = "SELECT * FROM order_cart WHERE branch_id='$branch_id' AND order_no='$order_no'";
    $orders_items = mysqli_query($db, $query);

    if(mysqli_num_rows($orders_items) > 0){
        echo '<div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
    
        $order_total_amount = 0;
        while($order_item = mysqli_fetch_assoc($orders_items)){
            $cart_id = $order_item['cart_id'];
            $cart_item_name = $order_item['cart_item_name'];
            $cart_item_price = $order_item['cart_item_price'];
            $cart_quantity = $order_item['cart_quantity'];
            $cart_amount = $order_item['cart_amount'];

                        echo '<tr>
                                <td>'.$cart_item_name.'</td>
                                <td>'.$cart_item_price.'</td>
                                <td>'.$cart_quantity.'</td>
                                <td>'.$cart_amount.'</td>
                                <td><button type="submit" name="remove_from_cart" value="'.$cart_id.'" class="btn btn-sm btn-outline-danger" style="border:none;"><span class="fa fa-remove"></span> Remove</button></td>
                            </tr>';
            $order_total_amount += $cart_amount;
        }
            $order_total_amount = number_format($order_total_amount, 2);
                    echo '<tr>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td><strong>GH¢ '.$order_total_amount.'</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div><br>';
    }
}


// Identify order id function
function identify_order_id($cart_id){
    global $db; global $branch; global $current_date; global $cashier;

    $cart_id = mysqli_real_escape_string($db, $cart_id);

    // Identify order no. and use it to identify order_id
    $query = "SELECT * FROM `order_cart` WHERE `order_cart`.`cart_id` = '$cart_id'";
    $result5 = mysqli_query($db, $query);

    if($cart_item = mysqli_fetch_assoc($result5)){
        $order_no = $cart_item['order_no'];
    }

    // Use order no. to identify order_id
    $query = "SELECT * FROM `orders` WHERE `orders`.`order_no` = '$order_no'";
    $orders = mysqli_query($db, $query);
        
    if($order = mysqli_fetch_assoc($orders)){
        $order_id = $order['order_id'];
        return $order_id;
    }
}


// Identify order number function
function identify_order_no($order_id){
    global $db; global $branch; global $current_date; global $cashier;

    $order_id = mysqli_real_escape_string($db, $order_id);

    // Use order id to identify order_no
    $query = "SELECT * FROM orders WHERE order_id='$order_id'";
    $orders = mysqli_query($db, $query);

    if($order = mysqli_fetch_assoc($orders)){
        // Get the order no.
        $order_no = $order['order_no'];
        return $order_no;
    }
}


// Identify order details(customer, attendant) (cart.php) function
function identify_order_details($order_id){
    global $db; global $branch; global $current_date; global $cashier;
    
    global $attendant_id; global $customer_name; global $customer_phone;

    // Get order id
    $order_id = mysqli_real_escape_string($db, $order_id);

    // Identify order details using order_id
    $query = "SELECT * FROM orders WHERE order_id='$order_id'";
    $orders = mysqli_query($db, $query);

    if($order = mysqli_fetch_assoc($orders)){
        $attendant_id = $order['attendant'];
        $customer_name = $order['customer_name'];
        $customer_phone = $order['customer_phone'];
    }
}



// Add an order to order_cart (cart.php) function
function add_to_order_cart($service_id, $quantity, $order_no){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;


    // Get service and quantity entered by user
    $service_id = mysqli_real_escape_string($db, $service_id);
    $quantity = mysqli_real_escape_string($db, $quantity);
    $order_no = mysqli_real_escape_string($db, $order_no);
    
     // Identify service name and unit price
     $query = "SELECT * FROM services WHERE service_id=$service_id";
     $result = mysqli_query($db, $query);

     if($service = mysqli_fetch_assoc($result)){
         $service_name = $service['service_name'];
         $service_unit_price = $service['service_unit_price'];
         
         // Calculate price for service
         $service_amount = $service_unit_price * $quantity;

        //  Insert service into cart
        $query = "INSERT INTO `order_cart` (`cart_item_id`,`cart_item_name`, `cart_item_price`, `cart_quantity`, `cart_amount`, `order_no`, `cashier`, `branch`, `branch_id`) VALUES ('$service_id', '$service_name', '$service_unit_price', '$quantity', '$service_amount', '$order_no','$cashier', '$branch', '$branch_id')";
        $result = mysqli_query($db, $query);
     }
}



// Empty cart function
function empty_order_cart($order_no){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    $order_no = mysqli_real_escape_string($db, $order_no);

    // Empty cart for branch
    $query = "DELETE FROM `order_cart` WHERE order_no='$order_no' AND branch_id='$branch_id' AND cashier='$cashier';";
    $result = mysqli_query($db, $query);

    if($result == false){
        die("An error occured. Try again");
    }
}



// Check number of items in order_cart function
function check_in_order_cart($order_no){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    $order_no = mysqli_real_escape_string($db, $order_no);

    // Query database for all items in order_cart
    $query = "SELECT * FROM order_cart WHERE branch_id='$branch_id' AND cashier='$cashier' AND order_no='$order_no'";
    $order_cart = mysqli_query($db, $query);
    $no_of_items = mysqli_num_rows($order_cart);
    return $no_of_items;
}



// Display receipt for checkout id(orderDetails.php)
function display_receipt($checkout_id){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    $checkout_id = mysqli_real_escape_string($db, $checkout_id);

    // Query database for checkout details(checkouts table)
    $query = "SELECT * FROM checkouts WHERE branch_id='$branch_id' AND checkout_id='$checkout_id'";
    $checkouts = mysqli_query($db, $query);
    
    if($checkout = mysqli_fetch_assoc($checkouts)){
        $order_no = $checkout['order_no'];
        $checkout_date = $checkout['checkout_date'];
        $checkout_time = $checkout['checkout_time'];
        $customer_name = $checkout['customer_name'];
        $customer_phone = $checkout['customer_phone'];
        $attendant = $checkout['attendant'];
        $branch_phone = $checkout['branch_phone'];
        $branch = $checkout['branch'];
        $cashier_id = mysqli_real_escape_string($db, $_SESSION['user_id']);

        // Later use location of user(cashier ) signature in started session for signature

        // Display order no. and checkout date
        echo '<div class="d-flex justify-content-between">
               <h4>Order No: '.$order_no.'</h4> 
               <h5 class="mt-auto">Date: '.$checkout_date.' / '.$checkout_time.'</h5>
              </div><br>';
        
        // Display order details table
        echo '<table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Service</th>
                          <th>Unit Price</th>
                          <th>Quantity</th>
                          <th>Amount</th>
                      </tr>
                  </thead>
                  <tbody>';
        
        // Read for item details from chechout_items table using the order_no
        $query = "SELECT * FROM checkout_items WHERE branch_id='$branch_id' AND order_no='$order_no'";
        $items = mysqli_query($db, $query);

        $order_amount = 0;
        while($item = mysqli_fetch_assoc($items)){
            $item_name = $item['item_name'];
            $unit_price = $item['item_price'];
            $quantity = $item['item_quantity'];
            $item_amount = $item['item_amount'];
            $order_amount += $item_amount;
            $order_amount = number_format($order_amount, 2);

                echo '<tr>
                          <td>'.$item_name.'</td>
                          <td>'.$unit_price.'</td>
                          <td>'.$quantity.'</td>
                          <td>'.$item_amount.'</td>
                      </tr>';
        }

        // Display total amount
                echo '<tr>
                          <td><strong>Branch: </strong>'.$branch.'</td>
                          <td></td>
                          <td><strong>Total</strong></td>
                          <td><strong>GH¢ '.$order_amount.'</strong></td>
                      </tr>
                  </tbody>
              </table><br>';
        
        // Show other details for checkout
        echo '<div class="row lead">
                    <div class="col-4 customerName">
                        <p><strong>Customer: </strong>'.$customer_name.'</p>
                    </div>
                    <div class="col-4 customerName text-center">
                        <p><strong>Attendant: </strong>'.$attendant.'</p>
                    </div>
                    <div class="col-4 customerName text-right">
                        <p><strong>Cashier\'s signature: </strong></p>
                    </div>
                </div>';
        
          echo '<div class="row lead mt-2">
                    <div class="col-4 telephone">
                        <p><strong>Phone: </strong>'.$customer_phone.'</p>
                    </div>
                    <div class="col-4 contact text-center">
                        <p><strong>Contact us: </strong>'.$branch_phone.'</p>
                    </div>
                    
                </div>';
    }
    else{
        header("Location: checkouts.php");
    }
}



// Display salary months (all months)
function display_salary_months(){
    global $db; global $branch; global $current_date; global $cashier;

    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);
    $current_year = mysqli_real_escape_string($db, date('Y'));
    $current_month = mysqli_real_escape_string($db, date('M'));

    
    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

    $position = 1;
    foreach($months as $month){
        // Check paid salaries
        $query = "SELECT * FROM salary WHERE user_id='$user_id' AND salary_month='$month' AND salary_year='$current_year'";
        $result = mysqli_query($db, $query);


        if($pay = mysqli_fetch_assoc($result)){
            $status = 'fa-check';
            $salary_date = $pay['salary_date'];
            $salary_amount = $pay['salary_amount'];
            $salary_id = $pay['salary_id'];
            // Check if it is current month
            if($month != $current_month){
                $color = 'btn-outline-success';
            }else{
                $color = 'btn-success';
                $current_pos = $position;             
            }
        }
        else{
            $status = 'fa-remove';
            $salary_date = '';
            $salary_amount = '';
            $salary_id = '';            
            // Check if it is current month            
            if($month != $current_month){
                $color = 'btn-outline-danger';
            }else{
                $color = 'btn-danger';                
            }
        }

        if($position > date('n')){
            $reached = 'disabled';
            $color = 'text-muted';
            $status = '';                 
            
        }else{
            $reached = '';                       
        }
    
        echo '<div class="col-lg-2 col-md-3 mb-5">
                  <div class="card text-center">
                    <a href="salary_details.php?salary_id='.$salary_id.'" class="btn '.$reached.' '.$color.'">
                      <div class="card-body">
                        <h1 class="month">'.$month.'</h1>
                        <p class="card-text">Status: <span class="status"><i class="fa '.$status.'"></i></span></p>
                      </div>
                    </a>
                  </div>
                </div>';
        $position ++;
    }
}



// Display salary details (when month is clicked)
function salary_details($salary_id){
    global $db; global $branch; global $current_date; global $cashier;
    
    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);
    $salary_id = mysqli_real_escape_string($db, $salary_id);
    $full_name = $_SESSION['first_name'] .' '. $_SESSION['last_name'];
    
    $query = "SELECT * FROM salary WHERE salary_id='$salary_id'";
    $result = mysqli_query($db, $query);

    if($salary = mysqli_fetch_assoc($result)){
        $salary_month = $salary['salary_month'];
        $salary_year = $salary['salary_year'];
        $salary_date = $salary['salary_date'];
        $salary_due = $salary['salary_due'];
        $salary_amount = $salary['salary_amount'];
        $balance = $salary_due - $salary_amount;
        $balance = number_format($balance, 2);
        

        // Generate full month names
        switch ($salary_month) {
            case 'Jan':
                $salary_full_month = 'January';
                break;

            case 'Feb':
                $salary_full_month = 'February';
                break;
            
            case 'Mar':
                $salary_full_month = 'March';
                break;
            
            case 'Apr':
                $salary_full_month = 'April';
                break;
            
            case 'May':
                $salary_full_month = 'May';
                break;

            case 'Jun':
                $salary_full_month = 'June';
                break;

            case 'Jul':
                $salary_full_month = 'July';
                break;

            case 'Jan':
                $salary_full_month = 'January';
                break;

            case 'Aug':
                $salary_full_month = 'August';
                break;

            case 'Sep':
                $salary_full_month = 'September';
                break;

            case 'Oct':
                $salary_full_month = 'October';
                break;

            case 'Nov':
                $salary_full_month = 'November';
                break;

            case 'Dec':
                $salary_full_month = 'December';
                break;

            default:
                $salary_full_month = $salary_month;                
                break;
        }

        echo '<div class="col-12">
                <h3>'.$salary_full_month.' '.$salary_year.' Salary</h3><br>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <p class="lead"><strong>Date of payment:</strong> '.$salary_date.'</p>
                <p class="lead"><strong>Received by:</strong> '.$full_name.'</p>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <p class="lead"><strong>Salary Due:</strong> GH¢ '.$salary_due.'</p>
                <p class="lead"><strong>Amount Paid:</strong> GH¢ '.$salary_amount.'</p>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <p class="lead"><strong>Balance:</strong> GH¢ '.$balance.'</p>
              </div>
              <div class="col-12 d-flex flex-column text-right">
                <p class="lead"><img src="../img/sign.png"></p>
              </div>
              <!-- Action buttons here -->
              <div class="col-12 text-right">
                <div>
                    <p class="lead">Thomas Bruce Suallah</p>
                </div>
              </div>
              <div class="py-2 print col-12 text-right">
                <button type="button" class="btn btn-primary" onclick="print();"><span class="fa fa-print"></span> Print</button>
              </div>
                
              ';
    }
}



// User's profile picture
function user_pic($user_id){
    global $db; global $branch; global $current_date; global $cashier;
    
    $user_id = mysqli_real_escape_string($db, $user_id);

    // Identify directory of user_pic
    $query = "SELECT * FROM users WHERE user_id='$user_id';";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $user_pic = $user['user_pic'];
        return $user_pic;
    }
}



// Add expenditure to expense_cart function
function add_to_expense($expenditure_name, $amount, $worker_id){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;


    // Get service and quantity entered by user
    $expenditure_name = strtolower($expenditure_name);
    $expenditure_name = mysqli_real_escape_string($db, ucwords($expenditure_name));
    $amount = mysqli_real_escape_string($db, $amount);
    $worker_id = mysqli_real_escape_string($db, $worker_id);

    // Identify who executed expense
    $query = "SELECT * FROM users WHERE `users`.`user_id`='$worker_id' AND branch_id='$branch_id';";
    $result = mysqli_query($db, $query);
    if($user = mysqli_fetch_assoc($result)){
        $worker_name = $user['first_name'] .' '. $user['last_name'];
    }
    

    //  Insert expense into expense_cart
    $query = "INSERT INTO `expense_cart` (`expense_name`, `expense_amount`, `executed_by`, `executed_by_id`, `cashier`, `branch`, `branch_id`, `expense_date`) VALUES ('$expenditure_name', '$amount', '$worker_name', '$worker_id', '$cashier', '$branch', '$branch_id', '$current_date')";
    $result = mysqli_query($db, $query);

}



// Display cart function
function display_expense_cart(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Query database for all items in cart and display them
    $query = "SELECT * FROM expense_cart WHERE branch_id='$branch_id' AND cashier='$cashier' AND expense_date='$current_date'";
    $cart = mysqli_query($db, $query);
    $no_added = mysqli_num_rows($cart);
    
    if($no_added > 0){
        echo '<p class="text-muted">Expenses added ('.$no_added.') </p>
                <div class="table-responsive w-75">
                    <table class="table  table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Expenditure</th>
                                <th>Amount</th>
                                <th>Executed by</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
        // Accumulator to store expense total
        $expense_total_amount = 0;
        while($expense = mysqli_fetch_assoc($cart)){
            $expense_id = $expense['expense_id'];
            $expense_name = $expense['expense_name'];
            $expense_amount = $expense['expense_amount'];
            $executed_by = $expense['executed_by'];

                        echo '<tr>
                                <td>'.$expense_name.'</td>
                                <td>'.$expense_amount.'</td>
                                <td>'.$executed_by.'</td>
                                <td><button type="submit" name="remove_from_expense" value="'.$expense_id.'" class="btn btn-sm btn-outline-danger" style="border:none;"><span class="fa fa-remove"></span> Remove</button></td>
                            </tr>';
            $expense_total_amount += $expense_amount;
        }
            $expense_total_amount = number_format($expense_total_amount, 2);
                    echo '<tr>
                            <td><strong>Total</strong></td>
                            <td><strong>GH¢ '.$expense_total_amount.'</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div><br>';
    }
}



// Remove expenditure from expense_cart function
function remove_from_expense_cart($expense_id){
    global $db; global $branch; global $current_date; global $cashier;


    // Get cart item clicked by user
    $expense_id = mysqli_real_escape_string($db, $expense_id);

    // Remove item from cart
    $query = "DELETE FROM `expense_cart` WHERE `expense_cart`.`expense_id` = $expense_id;";
    $result = mysqli_query($db, $query);

    if($result == false){
        die("An error occured. Try again");
    }
}



// Check number of items in expense_cart function
function check_in_expense_cart(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Query database for all items in expense_cart
    $query = "SELECT * FROM expense_cart WHERE branch_id='$branch_id' AND cashier='$cashier'";
    $cart = mysqli_query($db, $query);
    $no_of_items = mysqli_num_rows($cart);
    return $no_of_items;
}



// Confirm expenses (add_expenses.php) function
function confirm_expenses(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;


    // Escape all values before querying database
    $worker_id = mysqli_real_escape_string($db, $worker_id);

    // Generate order time, and put order items in array
    $expense_time = date('g:i A');
    
    $query = "SELECT * FROM expense_cart WHERE branch_id='$branch_id' AND cashier='$cashier'";
    $cart = mysqli_query($db, $query);

    if(mysqli_num_rows($cart) > 0){


        while($expense = mysqli_fetch_assoc($cart)){
                $expense_name = $expense['expense_name'];
                $expense_amount = $expense['expense_amount'];
                $executed_by = $expense['executed_by'];
                $executed_by_id = $expense['executed_by_id'];

                // Insert expenses into database(expense table)
                $query = "INSERT INTO `expense` (`expense_name`, `expense_amount`, `executed_by`, `executed_by_id`, `expense_date`, `expense_time`, `cashier`, `branch`, `branch_id`) VALUES ('$expense_name', '$expense_amount', '$executed_by', '$executed_by_id', '$current_date', '$expense_time', '$cashier', '$branch', '$branch_id')";

                $result = mysqli_query($db, $query);
                
        }

        // Clear expense_cart after confirming expense
        $query = "DELETE FROM `expense_cart` WHERE branch='$branch' AND cashier='$cashier'";
        $result = mysqli_query($db, $query);
        
    }

    
}



// Display expenses function
function expenses_today(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for all expenses for the day
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$current_date' AND approval=1";

    $expenses = mysqli_query($db, $query);
    
    if(mysqli_num_rows($expenses) < 1){
        echo '<div class="card-body">
                <b><p class="text-primary">No expenditure made today</p></b>
              </div>';
    }
    else{
        echo '<div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Expenditure</th>
                      <th>Amount</th>
                      <th>Executed by</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>';
                $counter = 1;
                while($expense = mysqli_fetch_assoc($expenses)){
                    $expense_id = $expense['expense_id'];
                    $expense_name = $expense['expense_name'];
                    $expense_amount = $expense['expense_amount'];
                    $executed_by = $expense['executed_by'];
                    $expense_time = $expense['expense_time'];
                    $expense_amount = number_format($expense_amount, 2);
                  echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$expense_name.'</td>
                      <td>'.$expense_amount.'</td>
                      <td>'.$executed_by.'</td>
                      <td>'.$expense_time.'</td>
                    </tr>';
                $counter ++;
                }
                echo '
                  </tbody>
                </table>
              </div>';
    }
}



// Display expenses function
function expenses_2($date){
    global $db; global $branch; global $branch_id;

    // Query the database for all expenses for the day
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$date' AND approval=1";

    $expenses = mysqli_query($db, $query);
    
    if(mysqli_num_rows($expenses) < 1){
        echo '<div class="card-body">
                <b><p class="text-primary">No expenditure made</p></b>
              </div>';
    }
    else{
        echo '<div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Expenditure</th>
                      <th>Amount</th>
                      <th>Executed by</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>';
                $counter = 1;
                while($expense = mysqli_fetch_assoc($expenses)){
                    $expense_id = $expense['expense_id'];
                    $expense_name = $expense['expense_name'];
                    $expense_amount = $expense['expense_amount'];
                    $executed_by = $expense['executed_by'];
                    $expense_time = $expense['expense_time'];
                    $expense_amount = number_format($expense_amount, 2);
                  echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$expense_name.'</td>
                      <td>'.$expense_amount.'</td>
                      <td>'.$executed_by.'</td>
                      <td>'.$expense_time.'</td>
                    </tr>';
                $counter ++;
                }
                echo '
                  </tbody>
                </table>
              </div>';
    }
}




function display_year_salary($year){
    global $db; global $branch; global $current_date;
    
    $year = mysqli_real_escape_string($db, $year);
    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);
    

    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');


    foreach($months as $month){
        // Check paid salaries for that year
        $query = "SELECT * FROM salary WHERE user_id='$user_id' AND salary_month='$month' AND salary_year='$year'";
        $result = mysqli_query($db, $query);


        if($pay = mysqli_fetch_assoc($result)){
            $status = 'fa-check';
            $salary_date = $pay['salary_date'];
            $salary_amount = $pay['salary_amount'];
            $salary_id = $pay['salary_id'];

            $color = 'btn-outline-success';
        }
        else{
            $status = 'fa-remove';
            $salary_date = '';
            $salary_amount = '';
            $salary_id = '';            
            
            $color = 'btn-outline-danger';
        }

    
        echo '<div class="col-lg-2 col-md-3 mb-5">
                  <div class="card text-center">
                    <a href="salary_details.php?salary_id='.$salary_id.'" class="btn '.$color.'">
                      <div class="card-body">
                        <h1 class="month">'.$month.'</h1>
                        <p class="card-text">Status: <span class="status"><i class="fa '.$status.'"></i></span></p>
                      </div>
                    </a>
                  </div>
                </div>';
    }
}


// Check if salary id matches logged in user
function check_user($salary_id){
    global $db; global $branch; global $current_date;
    
    $salary_id = mysqli_real_escape_string($db, $salary_id);
    $user_id = mysqli_real_escape_string($db, $_SESSION['user_id']);

    $query = "SELECT * FROM salary WHERE salary_id='$salary_id'";
    $result = mysqli_query($db, $query);

    if($salary = mysqli_fetch_assoc($result)){
        $salary_user = $salary['user_id'];
        if($salary_user != $user_id){
            echo '<div class="container mb-4">  
                    <h4 class="text-center">';
            die("Error... Not found");
            echo '</h4></div>';
        }
    }
}




// Check if checkout id matches logged in branch
function check_checkout_branch($checkout_id){
    global $db; global $branch; global $branch_id; global $current_date;
    
    $checkout_id = mysqli_real_escape_string($db, $checkout_id);

    $query = "SELECT * FROM checkouts WHERE checkout_id='$checkout_id'";
    $result = mysqli_query($db, $query);

    if($checkout = mysqli_fetch_assoc($result)){
        $checkout_branch = $checkout['branch_id'];
        if($checkout_branch != $branch_id){
            echo '<div class="container mb-4">  
                    <h4 class="text-center">';
            die("Error... Not found");
            echo '</h4></div>';
        }
    }
}



// Check if order id matches logged in branch
function check_order_branch($order_id){
    global $db; global $branch; global $branch_id; global $current_date;
    
    $order_id = mysqli_real_escape_string($db, $order_id);

    $query = "SELECT * FROM orders WHERE order_id='$order_id'";
    $result = mysqli_query($db, $query);

    if($order = mysqli_fetch_assoc($result)){
        $order_branch_id = $order['branch_id'];
        if($order_branch_id != $branch_id){
            echo '<div class="container mb-4">  
                    <h4 class="text-center">';
            die("Error... Not found");
            echo '</h4></div>';
        }
    }
}



// Display expense (for approval) function
function display_expense(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Query database for all items in cart and display them
    $query = "SELECT * FROM expense WHERE expense_date='$current_date' AND branch_id='$branch_id' AND approval=0";
    $cart = mysqli_query($db, $query);
    
    if(mysqli_num_rows($cart) > 0){
        echo '<div class="table-responsive">
                    <table class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Expenditure</th>
                                <th>Amount</th>
                                <th>Executed by</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
        // Accumulator to store expense total
        $expense_total_amount = 0;
        while($expense = mysqli_fetch_assoc($cart)){
            $expense_id = $expense['expense_id'];
            $expense_name = $expense['expense_name'];
            $expense_amount = $expense['expense_amount'];
            $executed_by = $expense['executed_by'];

                        echo '<tr>
                                <td>'.$expense_name.'</td>
                                <td>'.$expense_amount.'</td>
                                <td>'.$executed_by.'</td>
                                <td><button type="submit" name="remove_from_expense" value="'.$expense_id.'" class="btn btn-sm btn-outline-danger" style="border:none;"><span class="fa fa-remove"></span> Decline</button></td>
                            </tr>';
            $expense_total_amount += $expense_amount;
        }
            $expense_total_amount = number_format($expense_total_amount, 2);
                    echo '<tr>
                            <td><strong>Total</strong></td>
                            <td><strong>GH¢ '.$expense_total_amount.'</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div><br>';
    }
    else{
        echo '<div class="container"><h4>No pending approvals...</h4></div>';
    }
}



// Remove expenditure from expense (decline) function
function remove_from_expense($expense_id){
    global $db; global $branch; global $current_date; global $cashier;


    // Get cart item clicked by user
    $expense_id = mysqli_real_escape_string($db, $expense_id);

    // Remove item from cart
    $query = "DELETE FROM `expense` WHERE `expense`.`expense_id` = $expense_id;";
    $result = mysqli_query($db, $query);

    if($result == false){
        die("An error occured. Try again");
    }
}



// Check number of items in expensefunction
function check_in_expense(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    // Query database for all items in expense_cart
    $query = "SELECT * FROM expense WHERE branch_id='$branch_id' AND expense_date='$current_date'";
    $cart = mysqli_query($db, $query);
    $no_of_items = mysqli_num_rows($cart);
    return $no_of_items;
}



// approve expenses (approve_expenses.php) function
function approve_expenses(){
    global $db; global $branch; global $branch_id; global $current_date; global $cashier;

    
    $query = "UPDATE `expense` SET `approval` = '1' WHERE branch_id='$branch_id' AND expense_date='$current_date' AND approval = 0";
    $cart = mysqli_query($db, $query);


    
}



// Number of approvals pending for expenses function
function no_of_approvals_pending(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for number of expenses
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$current_date' AND approval=0";
    $expenses = mysqli_query($db, $query);
    $no_of_approvals_pending = mysqli_num_rows($expenses);
      
    echo $no_of_approvals_pending;
}



// Total daily sales function
function total_sales(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for number of expenses
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$current_date'";
    $result = mysqli_query($db, $query);
    
    $total_sales = 0;
    while($checkout = mysqli_fetch_assoc($result)){
        $amount = $checkout['order_amount'];
        $total_sales += $amount;
    }
      
    return $total_sales;
}



// Total daily sales function (2 for sales report page)
function total_sales2($date){
    global $db; global $branch; global $branch_id;

    // Query the database for number of expenses
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$date'";
    $result = mysqli_query($db, $query);
    
    $total_sales = 0;
    while($checkout = mysqli_fetch_assoc($result)){
        $amount = $checkout['order_amount'];
        $total_sales += $amount;
    }
      
    return $total_sales;
}



// Total daily expenditure function
function total_expenditure(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for number of expenses
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$current_date' AND approval=1";
    $result = mysqli_query($db, $query);
    
    $total_expenditure = 0;
    while($expense = mysqli_fetch_assoc($result)){
        $amount = $expense['expense_amount'];
        $total_expenditure += $amount;
    }
      
    return $total_expenditure;
}



// Total daily expenditure function (my activity)
function my_total_expenses(){
    global $db; global $branch; global $branch_id; global $current_date; global $user_id;

    // Query the database for number of expenses
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$current_date' AND executed_by_id='$user_id' AND approval=1";
    $result = mysqli_query($db, $query);
    
    $total_expenditure = 0;
    while($expense = mysqli_fetch_assoc($result)){
        $amount = $expense['expense_amount'];
        $total_expenditure += $amount;
    }
      
    return $total_expenditure;
}



// Daily sales summary function
function sales_summary(){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$current_date' ORDER BY checkout_id DESC;";

    $latest_checkouts = mysqli_query($db, $query);
    
    if(mysqli_num_rows($latest_checkouts) < 1){
        echo '<div class="card-body">
                <b><p class="text-primary">No sales made for today</p></b>
              </div>';
    }

    else{

        echo '<div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Service</th>
                      <th>No. of customers</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>';

        // Query database for all services
        $query = "SELECT * FROM services";
        $services = mysqli_query($db, $query);

        $counter = 1;
        while($service = mysqli_fetch_assoc($services)){
            $service_id = $service['service_id'];
            $service_name = $service['service_name'];

            // Query the database for checkouts made for that service on current date
            $query = "SELECT * FROM checkout_items WHERE branch_id = '$branch_id' AND checkout_date = '$current_date' AND item_id = $service_id";
            $checkout_items = mysqli_query($db, $query);
            $no_of_checkout_items = mysqli_num_rows($checkout_items);

            if($no_of_checkout_items > 0){
                $service_amount = 0;
                while($item = mysqli_fetch_assoc($checkout_items)){
                    $item_amount = $item['item_amount'];
                    $service_amount += $item_amount;
                }
                $service_amount = number_format($service_amount, 2);

                // display details for service 
                echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$service_name.'</td>
                      <td>'.$no_of_checkout_items.'</td>
                      <td>'.$service_amount.'</td>
                    </tr>';
              $counter ++;
            }
            
        }

        echo '
                  </tbody>
                </table>
              </div>';
    }

    
}



// Daily sales summary function (search)
function sales_summary2($date){
    global $db; global $branch; global $branch_id; global $current_date;

    // Query the database for checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$date' ORDER BY checkout_id DESC;";

    $latest_checkouts = mysqli_query($db, $query);
    
    if(mysqli_num_rows($latest_checkouts) < 1){
        echo '<div class="card-body">
                <b><p class="text-primary">No sales made</p></b>
              </div>';
    }

    else{

        echo '<div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Service</th>
                      <th>No. of customers</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>';

        // Query database for all services
        $query = "SELECT * FROM services";
        $services = mysqli_query($db, $query);

        $counter = 1;
        while($service = mysqli_fetch_assoc($services)){
            $service_id = $service['service_id'];
            $service_name = $service['service_name'];

            // Query the database for checkouts made for that service on current date
            $query = "SELECT * FROM checkout_items WHERE branch_id = '$branch_id' AND checkout_date = '$date' AND item_id = $service_id";
            $checkout_items = mysqli_query($db, $query);
            $no_of_checkout_items = mysqli_num_rows($checkout_items);

            if($no_of_checkout_items > 0){
                $service_amount = 0;
                while($item = mysqli_fetch_assoc($checkout_items)){
                    $item_amount = $item['item_amount'];
                    $service_amount += $item_amount;
                }
                $service_amount = number_format($service_amount, 2);

                // display details for service 
                echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$service_name.'</td>
                      <td>'.$no_of_checkout_items.'</td>
                      <td>'.$service_amount.'</td>
                    </tr>';
              $counter ++;
            }
            
        }

        echo '
                  </tbody>
                </table>
              </div>';
    }

    
}



// Total daily expenses function (search)
function total_expenses2($date){
    global $db; global $branch_id;

    // Query the database for all checkouts in branch
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$date' AND approval=1";
    $result = mysqli_query($db, $query);
    
    $total_expenses = 0;
    while($expense = mysqli_fetch_assoc($result)){
        $amount = $expense['expense_amount'];
        $total_expenses += $amount;
    }
      
    return $total_expenses;
}



// Display my sales today checkouts function
function my_sales_today(){
    global $db; global $branch_id; global $current_date; global $user_id;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    // Query the database for checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$current_date' AND attendant_id='$user_id' ORDER BY checkout_id DESC;";

    $latest_checkouts = mysqli_query($db, $query);
    
    if(mysqli_num_rows($latest_checkouts) < 1){
        echo '<div class="card-body">
                <p class="text-primary">No sales made</p>
              </div>';
    }
    else{
        echo '<div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Order No.</th>
                      <th>Customer Name</th>
                      <th>Amount</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>';
                $counter = 1;
                while($checkout = mysqli_fetch_assoc($latest_checkouts)){
                    $checkout_id = $checkout['checkout_id'];
                    $customer_name = $checkout['customer_name'];
                    $order_no = $checkout['order_no'];
                    $branch_id = $checkout['branch_id'];
                    $order_amount = $checkout['order_amount'];
                    $order_amount = number_format($order_amount, 2);
                  echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$order_no.'</td>
                      <td>'.$customer_name.'</td>
                      <td>'.$order_amount.'</td>
                      <td><a href="orderDetails.php?checkout_id='.$checkout_id.'&branch_id='.$branch_id.'" class="btn btn-sm btn-outline-secondary"><span class="fa fa-angle-double-right"></span> Details</a></td>
                    </tr>';
                $counter ++;
                }
                echo '
                  </tbody>
                </table>
              </div>';
    }
}



// Number of checkouts function (my checkouts)
function my_checkouts(){
    global $db; global $branch; global $branch_id; global $current_date; global $user_id;
    
    // Query the database for number of checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$current_date' AND attendant_id='$user_id'";
    $checkouts = mysqli_query($db, $query);
    $no_of_checkouts = mysqli_num_rows($checkouts);
    return $no_of_checkouts;
}



// Number of checkouts function (my checkouts)
function my_expenses(){
    global $db; global $branch; global $branch_id; global $current_date; global $user_id;
    
    // Query the database for number of checkouts
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$current_date' AND executed_by_id='$user_id' AND approval='1'";
    $checkouts = mysqli_query($db, $query);
    $no_of_checkouts = mysqli_num_rows($checkouts);
    return $no_of_checkouts;
}



function my_total_sales(){
    global $db; global $branch; global $branch_id; global $current_date; global $user_id;

    // Query the database for number of expenses
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$current_date' AND attendant_id='$user_id'";
    $result = mysqli_query($db, $query);
    
    $total_sales = 0;
    while($checkout = mysqli_fetch_assoc($result)){
        $amount = $checkout['order_amount'];
        $total_sales += $amount;
    }
      
    return $total_sales;
}



// Display expenses function (my expenses)
function my_expenses_today(){
    global $db; global $branch; global $branch_id; global $current_date; global $user_id;

    // Query the database for all expenses for the day
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$current_date' AND executed_by_id='$user_id' AND approval=1";

    $expenses = mysqli_query($db, $query);
    
    if(mysqli_num_rows($expenses) < 1){
        echo '<div class="card-body">
                <b><p class="text-primary">No expenditure made today</p></b>
              </div>';
    }
    else{
        echo '<div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Expenditure</th>
                      <th>Amount</th>
                      <th>Executed by</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>';
                $counter = 1;
                while($expense = mysqli_fetch_assoc($expenses)){
                    $expense_id = $expense['expense_id'];
                    $expense_name = $expense['expense_name'];
                    $expense_amount = $expense['expense_amount'];
                    $executed_by = $expense['executed_by'];
                    $expense_time = $expense['expense_time'];
                    $expense_amount = number_format($expense_amount, 2);
                  echo '
                    <tr>
                      <td>'.$counter.'</td>
                      <td>'.$expense_name.'</td>
                      <td>'.$expense_amount.'</td>
                      <td>'.$executed_by.'</td>
                      <td>'.$expense_time.'</td>
                    </tr>';
                $counter ++;
                }
                echo '
                  </tbody>
                </table>
              </div>';
    }
}