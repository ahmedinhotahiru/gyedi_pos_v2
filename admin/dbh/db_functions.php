<?php


// Identify current date before quering database
    date_default_timezone_set('Africa/Accra');
    $current_date = mysqli_real_escape_string($db, date('d-m-Y'));




function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
    
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}



    // User's profile picture
function user_pic($user_id){
    global $db; global $current_date;
    
    $user_id = mysqli_real_escape_string($db, $user_id);

    // Identify directory of user_pic
    $query = "SELECT * FROM admin WHERE user_id='$user_id';";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $user_pic = $user['user_pic'];
        return $user_pic;
    }
}



    // User's profile picture
function username($user_id){
    global $db;
    
    $user_id = mysqli_real_escape_string($db, $user_id);

    // Identify username
    $query = "SELECT * FROM admin WHERE user_id='$user_id';";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $username = $user['username'];
        return $username;
    }
}




// User's name
function user_name($user_id){
    global $db;
    
    $user_id = mysqli_real_escape_string($db, $user_id);

    // Identify directory of user_pic
    $query = "SELECT * FROM users WHERE user_id='$user_id';";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $full_name = $user['first_name'] .' '. $user['last_name'] .' '. $user['other_name'];
        return $full_name;
    }
}



// User's name
function user_salary($user_id){
    global $db;
    
    $user_id = mysqli_real_escape_string($db, $user_id);

    // Identify directory of user_pic
    $query = "SELECT * FROM users WHERE user_id='$user_id';";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $current_salary = $user['salary'];
        return $current_salary;
    }
}




// worker info function
function worker_info($user_id){
    global $db;
    
    $user_id = mysqli_real_escape_string($db, $user_id);

    // Identify directory of user_pic
    $query = "SELECT * FROM users WHERE user_id='$user_id';";
    $result = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($result)){
        $user_id = $user['user_id'];
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $other_name = $user['other_name'];
        $DOB = $user['DOB'];
        $email = $user['email'];
        $phone_no = $user['phone_no'];
        $residence = $user['residence'];
        $worker_pic = $user['user_pic'];
        $gender = $user['gender'];
        $max_DOB = date("Y-m-d");
        

        echo '<div class="col-md-8">
                <div class="form-row">

                    <div class="col-md-6 mb-5">
                        <label for="first_name" class="col-form-label">First name </label>
                        <input type="text" name="first_name" id="first_name" placeholder="Enter first name" class="form-control" pattern="[a-z A-Z]+" value="'.$first_name.'" required>
                    </div>

                    <div class="col-md-6 mb-5">
                        <label for="last_name" class="col-form-label">Last name </label>
                        <input type="text" name="last_name" id="last_name" placeholder="Enter first name" class="form-control" pattern="[a-z A-Z]+" value="'.$last_name.'" required>
                    </div>

                    <div class="col-md-6 mb-5">
                        <label for="other_name" class="col-form-label">Other name(s) </label>
                        <input type="text" name="other_name" id="other_name" class="form-control" pattern="[a-z A-Z]+" value="'.$other_name.'">
                    </div>

                    <div class="col-md-6 mb-5">
                        <label for="DOB" class="col-form-label">Date of birth </label>
                        <input type="date" max="'.$max_DOB.'" name="DOB" id="DOB" class="form-control" value="'.$DOB.'" required>
                    </div>

                    <div class="col-md-6 mb-5">
                        <label for="residence" class="col-form-label">Residence </label>
                        <input type="text" name="residence" id="residence" placeholder="Where you stay" class="form-control" pattern="[a-z A-Z 0-9]+" value="'.$residence.'" required>
                    </div>


                    <div class="col-md-6 mb-5">
                        <label for="phone_no" class="col-form-label">Phone number </label>
                        <input type="text" name="phone_no" id="phone_no" placeholder="Enter phone number" class="form-control" maxlength="10" minlength="10" pattern="[0]{1}[0-9]{9}" value="'.$phone_no.'" required>
                    </div>

                    <div class="col-md-8 offset-md-2 mb-5">
                        <button class="btn btn-success btn-block" type="submit" name="save_changes" value="'.$user_id.'"><span class="fa fa-check"></span> Save changes</button>
                    </div>

                </div>
              </div>
              
              <div class="col-md-4 text-center">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card border-0">
                            <div class="card-img">
                                <img src="../'.$worker_pic.'" alt="" class="img-fluid rounded-circle" style="max-height:103.5px;border:2px solid #e3e3e3;">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p>'.$gender.'</p>
                        <p class="text-primary">'.$email.'</p>
                    </div>
                </div>
              </div>';
        
    }
}



// Display latest checkouts function
function latest_checkouts(){
    global $db; global $current_date;

    // Query the database for checkouts
    $query = "SELECT * FROM checkouts WHERE checkout_date = '$current_date' ORDER BY checkout_id DESC LIMIT 10;";

    $latest_checkouts = mysqli_query($db, $query);
    
    if(mysqli_num_rows($latest_checkouts) < 1){
        echo '<div class="card-body">
                <p class="text-primary">No checkouts made for today</p>
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



// Number of workers function
function no_of_workers(){
    global $db; global $current_date;    

    // Query the database for all workers
    $query = "SELECT * FROM users";
    $users = mysqli_query($db, $query);
    $no_of_workers = mysqli_num_rows($users);
    return $no_of_workers;
}



// Number of branches function
function no_of_branches(){
    global $db; global $current_date;    

    // Query the database for all branches
    $query = "SELECT * FROM branches";
    $branches = mysqli_query($db, $query);
    $no_of_branches = mysqli_num_rows($branches);
    return $no_of_branches;
}



// Number of services function
function no_of_services(){
    global $db; global $current_date;    

    // Query the database for all services
    $query = "SELECT * FROM services";
    $services = mysqli_query($db, $query);
    $no_of_services = mysqli_num_rows($services);
    return $no_of_services;
}



// Number of checkout for the day function
function no_of_checkouts($branch_id, $date){
    global $db;    

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    
    // Query the database for all checkouts for the day
    $query = "SELECT * FROM checkouts WHERE checkout_date='$date' AND branch_id='$branch_id'";
    $checkouts = mysqli_query($db, $query);
    $no_of_checkouts = mysqli_num_rows($checkouts);
    return $no_of_checkouts;
}



// Number of expenses for the day function
function no_of_expenses($branch_id, $date){
    global $db;    

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    
    // Query the database for all checkouts for the day
    $query = "SELECT * FROM expense WHERE expense_date='$date' AND branch_id='$branch_id' AND approval=1";
    $expenses = mysqli_query($db, $query);
    $no_of_expenses = mysqli_num_rows($expenses);
    return $no_of_expenses;
}



// Workers accordion function
function workers_accordion(){
    global $db; global $current_date;    

    // Query the database for branches first
    $query = "SELECT * FROM branches";
    $branches = mysqli_query($db, $query);
    $no_of_branches = mysqli_num_rows($branches);
    
    $position = 1;
    while($branch = mysqli_fetch_assoc($branches)){

      // Identify branch
      $branch_id = $branch['branch_id'];
      $branch_name = $branch['branch_name'];
      $branch_position = $branch['branch_position'];

      if($position == 1){
        $visibility = "show";
      }
      else{
        $visibility = "";        
      }

        echo '<div class="card">
                    <div class="card-header" role="tab" id="'.$branch_id.'">
                        <p class="card-text"><a href="#'.$branch_position.'" data-parent="#accordion" data-toggle="collapse" class="text-dark"> '.$branch_name.'</a></p>
                    </div>

                    <div id="'.$branch_position.'" class="collapse '.$visibility.'">

                        <div class="card-body">
                            <div class="row">';

      //Query database for all workers in branch
      $query = "SELECT * FROM users WHERE branch_id='$branch_id'";
      $users = mysqli_query($db, $query);

      while($user = mysqli_fetch_assoc($users)){
        $worker_name = $user['first_name'] ." ". $user['last_name'];
        $worker_id = $user['user_id'];
        $worker_pic = $user['user_pic'];

                            echo '<div class="col-lg-3 col-sm-4 mb-5 text-center" >
                                    <a href="worker.php?user_id='.$worker_id.'">
                                        <div class="card border-0">
                                            <div class="card-img">
                                                <img src="../'.$worker_pic.'" alt="" class="img-fluid rounded-circle" style="max-height:103.5px;border:2px solid #e3e3e3;">
                                            </div>
                                        </div>
                                        '.$worker_name.'
                                    </a>
                                </div>';
      }
                    echo '</div>
                    </div>
                </div>                    
            </div>';
        $position ++;

    }

}



// Show remove_workers function
function show_remove_workers(){
    global $db; global $current_date;    

      //Query database for all workers
      $query = "SELECT * FROM users";
      $users = mysqli_query($db, $query);

      while($user = mysqli_fetch_assoc($users)){
        $worker_name = $user['first_name'] ." ". $user['last_name'];
        $worker_id = $user['user_id'];
        $worker_pic = $user['user_pic'];

                            echo '<div class="col-lg-3 col-sm-4 mb-5 text-center" >
                                      <div class="card border-0">
                                          <div class="card-img">
                                              <img src="../'.$worker_pic.'" alt="" class="img-fluid rounded-circle" style="max-height:103.5px;border:2px solid #e3e3e3;">
                                          </div>
                                      </div>'.$worker_name.'
                                      <button type="submit" class="my-2 btn btn-sm btn-outline-danger border-0" id="worker" name="remove_worker" value="'.$worker_id.'" onclick="return confirm(\'Are you sure you want to remove '.$worker_name.'?\');"><span class="fa fa-trash"></span></button><br>
                                      
                                      
                                  </div>';
      }

    

}



// SHow branches function
function show_branches(){
    global $db; global $current_date;    

    // Query the database for branches first
    $query = "SELECT * FROM branches";
    $branches = mysqli_query($db, $query);
    
    while($branch = mysqli_fetch_assoc($branches)){

      // Identify branch
      $branch_id = $branch['branch_id'];
      $branch_name = $branch['branch_name'];

      echo '<div class="col-lg-4 mb-4">
                <a href="branch.php?branch_id='.$branch_id.'" class="btn btn-light d-block p-1 ">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <p class="card-text">'.$branch_name.'</p>
                    </div>
                </div> 
                </a> 
            </div>';


    }

}



// SHow services function
function show_services(){
    global $db; global $current_date;    

    // Query the database for services first
    $query = "SELECT * FROM services";
    $services = mysqli_query($db, $query);
    
    while($service = mysqli_fetch_assoc($services)){

      // Identify branch
      $service_id = $service['service_id'];
      $service_name = $service['service_name'];

      echo '<div class="col-lg-4 mb-4">
                <a href="service.php?service_id='.$service_id.'" class="btn btn-light d-block p-1 ">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <p class="card-text">'.$service_name.'</p>
                    </div>
                </div> 
                </a> 
            </div>';


    }

}



// Display select branches function
function select_branches(){
    global $db; global $current_date;

    // Query the database for all positions
    $query = "SELECT * FROM branches";
    $branches = mysqli_query($db, $query);

    if(mysqli_num_rows($branches) > 0){
        while($branch = mysqli_fetch_assoc($branches)){
            $branch_id = $branch['branch_id'];
            $branch_name = $branch['branch_name'];

            // Check if attendant is selected, if yes echo selected attribute on service
            if(isset($_GET['branch'])){
                $selected_id = $_GET['branch'];
                if($branch_id == $selected_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
            }else{
                    $selected = "";
                }

            echo '<option value="'.$branch_id.'" '.$selected.'>'.$branch_name.'</option>';
        }
    }
}



// Display select services function
function select_services(){
    global $db; global $current_date;

    // Query the database for all services
    $query = "SELECT * FROM services";
    $services = mysqli_query($db, $query);

    if(mysqli_num_rows($services) > 0){
        while($service = mysqli_fetch_assoc($services)){
            $service_id = $service['service_id'];
            $service_name = $service['service_name'];

            // Check if attendant is selected, if yes echo selected attribute on service
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

            echo '<option value="'.$service_id.'" '.$selected.'>'.$service_name.'</option>';
        }
    }
}



// Add branch function
function add_branch($branch_name, $branch_phone, $branch_position){
    global $db;
    
    // Escape values before quering database
    $branch_name = mysqli_real_escape_string($db, $branch_name);
    $branch_phone = mysqli_real_escape_string($db, $branch_phone);
    $branch_position = mysqli_real_escape_string($db, $branch_position);

    // Insert branch into db
    $query = "INSERT INTO branches(`branch_name`, `branch_phone`, `branch_position`) VALUES('$branch_name', '$branch_phone', '$branch_position')";
    $result = mysqli_query($db, $query);
    
    if(!$result){
        die("An error occured, try again");
    }
}



// Add service function
function add_service($service_name, $service_price){
    global $db;
    
    // Escape values before quering database
    $service_name = mysqli_real_escape_string($db, $service_name);
    $service_price = mysqli_real_escape_string($db, $service_price);

    // Insert service into db
    $query = "INSERT INTO services(`service_name`, `service_unit_price`) VALUES('$service_name', '$service_price')";
    $result = mysqli_query($db, $query);
    
    if(!$result){
        die("An error occured, try again");
    }
}



// Remove branch function
function remove_branch($branch_id){
    global $db;
    
    // Escape values before quering database
    $branch_id = mysqli_real_escape_string($db, $branch_id);

    // Remove branch from db
    $query = "DELETE FROM branches WHERE branch_id='$branch_id'";
    $result = mysqli_query($db, $query);
    
    if(!$result){
        die("An error occured, try again");
    }
}



// Remove service function
function remove_service($service_id){
    global $db;
    
    // Escape values before quering database
    $service_id = mysqli_real_escape_string($db, $service_id);

    // Remove branch from db
    $query = "DELETE FROM services WHERE service_id='$service_id'";
    $result = mysqli_query($db, $query);
    
    if(!$result){
        die("An error occured, try again");
    }
}



// Remove service function
function remove_worker($worker_id){
    global $db;
    
    // Escape values before quering database
    $worker_id = mysqli_real_escape_string($db, $worker_id);

    // Remove branch from db
    $query = "DELETE FROM users WHERE user_id='$worker_id'";
    $result = mysqli_query($db, $query);
    
    if(!$result){
        die("An error occured, try again");
    }
}



// Identify branch name function
function branch_name($branch_id){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    $query = "SELECT * FROM branches WHERE branch_id='$branch_id'";
    $branches = mysqli_query($db, $query);

    if($branch = mysqli_fetch_assoc($branches)){
        $branch_name = $branch['branch_name'];
        return $branch_name;
    }
}



// Identify branch phone function
function branch_phone($branch_id){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    $query = "SELECT * FROM branches WHERE branch_id='$branch_id'";
    $branches = mysqli_query($db, $query);

    if($branch = mysqli_fetch_assoc($branches)){
        $branch_phone = $branch['branch_phone'];
        return $branch_phone;
    }
}



// Display branch daily checkouts function
function checkouts($branch_id, $date){
    global $db;

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



// Total daily sales function
function total_sales($branch_id, $date){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    // Query the database for all checkouts in branch
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$date'";
    $result = mysqli_query($db, $query);
    
    $total_sales = 0;
    while($checkout = mysqli_fetch_assoc($result)){
        $amount = $checkout['order_amount'];
        $total_sales += $amount;
    }
      
    return $total_sales;
}



// Total daily expenses function
function total_expenses($branch_id, $date){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

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



// Display receipt for checkout id(orderDetails.php)
function display_receipt($checkout_id){
    global $db; global $current_date;

    $checkout_id = mysqli_real_escape_string($db, $checkout_id);

    // Query database for checkout details(checkouts table)
    $query = "SELECT * FROM checkouts WHERE checkout_id='$checkout_id'";
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
        $cashier = $checkout['cashier'];

        // Display order no. and checkout date
        echo '<div class="d-flex justify-content-between">
               <h5>Order No: '.$order_no.'</h5> 
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
        $query = "SELECT * FROM checkout_items WHERE branch='$branch' AND order_no='$order_no'";
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
                        <p><strong>Cashier: </strong>'.$cashier.'</p>
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



// Branch info function
function branch_info($branch_id){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    $query = "SELECT * FROM branches WHERE branch_id='$branch_id'";
    $branches = mysqli_query($db, $query);

    if($branch = mysqli_fetch_assoc($branches)){
        $branch_name = $branch['branch_name'];
        $branch_phone = $branch['branch_phone'];
    }
}



// Branch workers function
function branch_workers($branch_id){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    $query = "SELECT * FROM users WHERE branch_id='$branch_id' ORDER BY position DESC";
    $users = mysqli_query($db, $query);

    while($user = mysqli_fetch_assoc($users)){
        $worker_name = $user['first_name'] ." ". $user['last_name'];
        $worker_id = $user['user_id'];
        $worker_pic = $user['user_pic'];
        $worker_position = $user['position'];

        echo '<div class="col-lg-3 col-sm-4 mb-5 text-center" >
                <a href="worker.php?user_id='.$worker_id.'">
                    <div class="card border-0">
                        <div class="card-img">
                            <img src="../'.$worker_pic.'" alt="" class="img-fluid rounded-circle" style="max-height:103.5px;border:2px solid #e3e3e3;">
                        </div>
                    </div>
                    '.$worker_name.'<br>
                </a>
                <p class="text-muted">'.$worker_position.'</p>
            </div>';
    }
}



// Display expenses function
function expenses_today($branch_id, $date){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    // Query the database for all expenses for the day
    $query = "SELECT * FROM expense WHERE branch_id = '$branch_id' AND expense_date = '$date' AND approval=1";

    $expenses = mysqli_query($db, $query);
    
    if(mysqli_num_rows($expenses) < 1){
        echo '<div class="card-body">
                <p class="text-primary">No expenditure made</p>
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



// Search for checkouts function
function search_checkout($search_keywords, $branch_id){
    global $db; global $current_date;

    $search_keywords = mysqli_real_escape_string($db, $search_keywords);  
    $branch_id = mysqli_real_escape_string($db, $branch_id);
      

    // Query the database for search input
    $query = "SELECT * FROM checkouts WHERE customer_name LIKE '%$search_keywords%' OR order_no LIKE '%$search_keywords%' OR checkout_date LIKE '%$search_keywords%' AND branch_id = '$branch_id' ORDER BY checkout_id DESC";
    $checkouts = mysqli_query($db, $query);

    if( (mysqli_num_rows($checkouts) < 1) || empty($_GET['search_keywords'])){
        echo '
        <div class="col-md-12 mb-4">

          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h5 class="card-text">Search Results (0)</h5>
              <a href="checkouts.php?branch_id='.$branch_id.'"><span class="fa fa-angle-double-left"></span> Back to checkouts</a>
            </div>
            <div class="card-body">
              <p class="text-danger">No results found for your search</p>
            </div>
        </div>';
    }
    else{
        
                echo '
                <div class="col-md-12 mb-3">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    <h5 class="card-text">Search Results ('.mysqli_num_rows($checkouts).')</h5>
                    <a href="checkouts.php?branch_id='.$branch_id.'" class="mt-2"><span class="fa fa-angle-double-left"></span> Back to checkouts</a>
                    </div>

                    <div class="table-responsive">
                    <table class="table">
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
                            <td><a href="orderDetails.php?checkout_id='.$checkout_id.'&branch_id='.$branch_id.'" class="btn btn-sm btn-outline-secondary"><span class="fa fa-angle-double-right"></span> Details</a></td>
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
function search_expense($search_keywords, $branch_id){
    global $db; global $current_date;

    $search_keywords = mysqli_real_escape_string($db, $search_keywords);   
    $branch_id = mysqli_real_escape_string($db, $branch_id);
     

    // Query the database for search input
    $query = "SELECT * FROM expense WHERE expense_name LIKE '%$search_keywords%' OR executed_by LIKE '%$search_keywords%' OR expense_date LIKE '%$search_keywords%' AND branch_id = '$branch_id' ORDER BY expense_id DESC";
    $expenses = mysqli_query($db, $query);

    if( (mysqli_num_rows($expenses) < 1) || empty($_GET['search_keywords'])){
        echo '
        <div class="col-md-12 mb-3">

          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h5 class="card-text">Search Results (0)</h5>
              <a href="expenses.php?branch_id='.$branch_id.'"><span class="fa fa-angle-double-left"></span> Back to expenses</a>
            </div>
            <div class="card-body">
              <p class="text-danger">No results found for your search</p>
            </div>
        </div>';
    }
    else{
        
                echo '
                <div class="col-md-12 mb-3">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    <h5 class="card-text">Search Results ('.mysqli_num_rows($expenses).')</h5>
                    <a href="expenses.php?branch_id='.$branch_id.'"><span class="fa fa-angle-double-left"></span> Back to expenses</a>
                    </div>

                    <div class="table-responsive">
                    <table class="table">
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



// Daily sales summary function
function sales_summary($branch_id, $date){
    global $db;

    $branch_id = mysqli_real_escape_string($db, $branch_id);
    

    // Query the database for checkouts
    $query = "SELECT * FROM checkouts WHERE branch_id = '$branch_id' AND checkout_date = '$date' ORDER BY checkout_id DESC;";

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



// worker information with credentials function
function credentials($user_id){
    global $db;

    $user_id = mysqli_real_escape_string($db, $user_id);
    
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $users = mysqli_query($db, $query);

    if($user = mysqli_fetch_assoc($users)){
        $branch = $user['branch'];
        $position = $user['position'];
        $username = $user['username'];

        echo '<div class="d-flex justify-content-between mb-5">
                <p><strong>Branch: </strong>'.$branch.'</p>
                <p><strong>Position: </strong>'.$position.'</p>
                <p><strong>Username: </strong>'.$username.'</p>
              </div><br>';
    }


    
}




// Service details function
function service_details($service_id){
    global $db;

    $service_id = mysqli_real_escape_string($db, $service_id);
    
    $query = "SELECT * FROM services WHERE service_id = '$service_id'";
    $services = mysqli_query($db, $query);

    if($service = mysqli_fetch_assoc($services)){
        $service_name = $service['service_name'];
        $service_unit_price = $service['service_unit_price'];

        echo '<div class="d-flex justify-content-between mb-5">
                <p><strong>Service name: </strong>'.$service_name.'</p>
                <p><strong>Price: </strong>'.$service_unit_price.'</p>
              </div><br>';
    }


    
}







?>