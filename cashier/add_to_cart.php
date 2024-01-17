<?php

$page_title = 'Gyedi | Add Order';
include 'includes/header.php';



if(isset($_GET['add_to_cart'])){
    $service_id = $_GET['service_id'];
    $quantity = $_GET['quantity'];
    $customer_name = $_GET['customer_name'];
    $customer_phone = $_GET['customer_phone'];
    $attendant_id = $_GET['attendant_id'];
    

    if(empty($service_id)){
        header("Location: addOrder.php?error=emptyService&quantity=$quantity&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
    }
    elseif(empty($quantity)){
        header("Location: addOrder.php?error=emptyQuantity&service_id=$service_id&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
    }
    elseif($quantity < 1){
        header("Location: addOrder.php?error=quantity&service_id=$service_id&quantity=$quantity&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
    }
    else{
        add_to_cart($service_id, $quantity);
        header("Location: addOrder.php?cart=success&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
        
    }
}


if(isset($_GET['remove_from_cart'])){
    $cart_id = $_GET['remove_from_cart'];
    $customer_name = $_GET['customer_name'];
    $customer_phone = $_GET['customer_phone'];
    $attendant_id = $_GET['attendant_id'];
   
    remove_from_cart($cart_id);
    header("Location: addOrder.php?remove=success&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
}


if(isset($_GET['confirm_order'])){
    $customer_name = $_GET['customer_name'];
    $customer_phone = $_GET['customer_phone'];
    $attendant_id = $_GET['attendant_id'];
    $service_id = $_GET['service_id'];
    $quantity = $_GET['quantity'];
    
    // Check if cart is empty
    $in_cart = check_in_cart();

    if($in_cart < 1){
        header("Location: addOrder.php?error=emptyCart&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone&service_id=$service_id&quantity=$quantity");
        
    }

    // Check if attendant is selected
    elseif(empty($attendant_id)){
        header("Location: addOrder.php?error=attendant&customer_name=$customer_name&customer_phone=$customer_phone");
    }

    // Check if customer name (if entered) is valid
    elseif(isset($_GET['customer_name']) && !empty($_GET['customer_name'])){
        $customer_name = $_GET['customer_name'];

        if(!preg_match("/^[a-z A-Z]*$/", $customer_name)){
            header("Location: addOrder.php?error=customerName&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
        }
        else{
            // Generate order number and confirm order (insert into db)
            $order_no = order_no_generate();
            $order_id = confirm_order($customer_name, $customer_phone, $order_no, $attendant_id);
            header("Location: cart.php?order_id=$order_id&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
        }
    }

   else{
        // Generate order number and confirm order (insert into db)
        $order_no = order_no_generate();
        $order_id = confirm_order($customer_name, $customer_phone, $order_no, $attendant_id);
        header("Location: cart.php?order_id=$order_id&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
    }

    

}


if(isset($_GET['cancel_order'])){
    
    // Empty cart
    empty_cart();
    header("Location: index.php?cancel=success");
}



include 'includes/footer.php';