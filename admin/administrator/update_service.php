<?php
$page_title = 'Admin | Services';
include 'includes/header.php';

if(isset($_GET['edit_service'])){
    $service_id = mysqli_real_escape_string($db, $_GET['edit_service']);
    $service_name = mysqli_real_escape_string($db, ucwords(strtolower($_GET['service_name'])));
    $service_price = mysqli_real_escape_string($db, $_GET['service_price']);


    if(!empty($service_id)){
        
            // CHeck for service name
            if(!empty($service_name)){
                
                $query = "UPDATE `services` SET `service_name` = '$service_name' WHERE service_id='$service_id'";
                $result = mysqli_query($db, $query);
                    
                
            }

            // CHeck for branch phone no.
            if(!empty($service_price)){
                if( $service_price < 0.1 ){
                    header("Location: service.php?service_id=$service_id&error=invalidPrice");                    
                    exit();
                }
                else{
                    $query = "UPDATE `services` SET `service_unit_price` = '$service_price' WHERE service_id='$service_id'";
                    $result = mysqli_query($db, $query);
                    
                }
            }


            header("Location: service.php?service_id=$service_id&update=");
            
        
    }

    else{
        header("Location: services.php");
    }
    
}