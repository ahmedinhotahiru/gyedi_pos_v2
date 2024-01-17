<?php

$page_title = 'Gyedi | Cart';
include 'includes/header.php';


if(isset($_GET['cancel_order'])){
    
    $cancel_order_id = $_GET['cancel_order'];

    // Empty order_cart table
    $order_no = identify_order_no($cancel_order_id);
    empty_order_cart($order_no);

    // Cancel order and remove from db
    cancel_order($cancel_order_id);
    
}




if(isset($_GET['remove_from_cart'])){
    $cart_id = $_GET['remove_from_cart'];

    $customer_name = $_GET['customer_name'];
    $customer_phone = $_GET['customer_phone'];
    $attendant_id = $_GET['attendant_id'];
   
    $order_id = identify_order_id($cart_id);

    remove_from_order_cart($cart_id);

    header("Location: cart.php?order_id=$order_id&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone");
}



if(isset($_GET['add_to_cart'])){
    $service_id = $_GET['service_id'];
    $quantity = $_GET['quantity'];
    $customer_name = $_GET['customer_name'];
    $customer_phone = $_GET['customer_phone'];
    $attendant_id = $_GET['attendant_id'];

    $order_id = $_GET['add_to_cart'];
    $order_no = identify_order_no($order_id);

    if(empty($service_id)){
        header("Location: cart.php?error=emptyService&quantity=$quantity&order_id=$order_id");
    }
    elseif(empty($quantity)){
        header("Location: cart.php?error=emptyQuantity&service_id=$service_id&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone&order_id=$order_id");
    }
    elseif($quantity < 1){
        header("Location: cart.php?error=quantity&service_id=$service_id&quantity=$quantity&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone&order_id=$order_id");
    }
    else{
        add_to_order_cart($service_id, $quantity, $order_no);
        header("Location: cart.php?cart=success&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone&order_id=$order_id");
        
    }
}



if(isset($_GET['checkout'])){
    $customer_name = $_GET['customer_name'];
    $customer_phone = $_GET['customer_phone'];
    $attendant_id = $_GET['attendant_id'];
    $service_id = $_GET['service_id'];
    $quantity = $_GET['quantity'];
    $order_id = $_GET['checkout'];

    // Generate order number using order_id
    $order_no = identify_order_no($order_id);
    
    // Check if order_cart is empty
    $in_cart = check_in_order_cart($order_no);

    if($in_cart < 1){
        header("Location: cart.php?error=emptyCart&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone&service_id=$service_id&quantity=$quantity&order_id=$order_id");
        
    }

    // Check if attendant is selected
    elseif(empty($attendant_id)){
        header("Location: cart.php?error=attendant&attendant=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone&order_id=$order_id");
    }

    // Check if customer name (if entered) is valid
    elseif(isset($_GET['customer_name']) && !empty($_GET['customer_name'])){
        $customer_name = $_GET['customer_name'];

        if(!preg_match("/^[a-z A-Z]*$/", $customer_name)){
            header("Location: cart.php?error=customerName&attendant_id=$attendant_id&customer_name=$customer_name&customer_phone=$customer_phone&order_id=$order_id");
        }
        else{
            // Get order details from order_cart using order number and confirm checkout (insert into checkouts db)
            
            $checkout_id = confirm_checkout($customer_name, $customer_phone, $order_no, $attendant_id, $order_id);

            header("Location: orderDetails.php?checkout_id=$checkout_id");
        }
    }

   else{
        // Get order details from order_cart using order number and confirm checkout (insert into checkouts db)
            
        $checkout_id = confirm_checkout($customer_name, $customer_phone, $order_no, $attendant_id, $order_id);

        header("Location: orderDetails.php?checkout_id=$checkout_id");
    }

    

}







include 'includes/footer.php';