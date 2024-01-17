<?php

    $page_title = 'Gyedi | Add Order';

    include 'includes/header.php';

    if(!isset($_GET['cancel_order'])){
        
        header("Location: index.php");
        if(!isset($_GET['cancel_order_id'])){
            header("Location: index.php");
        }
        else{
            // get order id to cancel
            $cancel_order_id = $_GET['cancel_order_id'];
            // Cancel order and remove from db
            cancel_order($cancel_order_id);
        }
    }






    include 'includes/footer.php';

       
    