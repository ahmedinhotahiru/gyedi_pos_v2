<?php
  $page_title = 'Admin | Services';
  include 'includes/header.php';

  if(!isset($_GET['service_id'])){
      header("Location: services.php");
  }
  else{
    
    //   Identify the service using the service ID
    $service_id = mysqli_real_escape_string($db, $_GET['service_id']);


  }
?>



  <!-- Main Body Starts here -->

  <section>

    <div class="container my-5">

        <div class="row mb-5">

            <!-- Side bar starts here -->
            <div class="col-md-3 mb-3">
                <div class="row">

                    <!-- Side navigation starts here -->
                    <div class="col-md-12 mb-3">
                        <div class="list-group ">
                            <a href="<?php echo u(h('index.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-cog"></span> Dashboard
                            </a>
                            <a href="<?php echo u(h('workers.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-user"></span> Workers <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_workers(); ?></span>
                            </a>
                            <a href="<?php echo u(h('branches.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-home"></span> Branches <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_branches(); ?></span>
                            </a>
                            <a href="<?php echo u(h('services.php')); ?>" class="list-group-item list-group-item-action">
                                <span class="fa fa-globe"></span> Services <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_services(); ?></span>
                            </a>
                        </div>
                    </div>
                    <!-- Side navigation ends here -->



                    <!-- Back button starts here -->
                    <div class="col-md-12 mt-5">
                        <a href="<?php echo u(h('services.php')); ?>" class="btn text-white btn-block"><span class="fa fa-arrow-left"></span> Back to services</a>
                    </div>
                    <!-- Back button ends here -->

                    
                </div>
            </div>
            <!-- Side bar ends here -->


            <!-- Main content starts here -->
            <div class="col-md-9">
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <p class="card-text">Service</p>
                            </div>

                            <!-- Info Panels starts here -->
                            <div class="card-body">
                                
                                <form action="update_service.php" class="form">
                                    <h6 class="text-center text-muted">Service Details</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>
                                    

                                    <?php service_details($service_id); ?>
                                        
                                    <h6 class="text-center text-muted">Edit Service</h6><hr style="width:50px;border:1px solid rgba(0, 0, 0, 0.1);"><br>

                                        <!-- display success/error messages here -->
                                    <?php
                                            if(isset($_GET['update'])){
                                                echo '<p class="text-center text-success mb-3">Service updated successfully</p>';
                                            }

                                            if(isset($_GET['error'])){
                                                $error = $_GET['error'];

                                                switch ($error) {
                                                    case 'invalidServiceName':
                                                        echo '<p class="text-center text-danger mb-3">Service name contains invalid characters</p>';
                                                        break;

                                                    case 'invalidPrice':
                                                        echo '<p class="text-center text-danger mb-3">Price is invalid</p>';
                                                        break;
                                                    
                                                    
                                                    default:
                                                        # code...
                                                        break;
                                                }
                                            }
                                    ?>

                                    <div class="form-row">

                                        <div class="col-md-4 offset-md-2 mb-5">
                                            <label for="service_name">Service name</label>
                                            <input type="text" name="service_name" id="service_name" placeholder="Enter new service name" class="form-control">
                                        </div>

                                        <div class="col-md-4 mb-5">
                                            <label for="service_price">Price</label>
                                            <input type="number" name="service_price" id="service_price" placeholder="New price" min="0.10" step="0.10" class="form-control">
                                        </div>

                                        <div class="col-md-4 offset-md-4 mb-5">
                                            <button class="btn btn-block btn-success" type="submit" name="edit_service" value="<?php echo $service_id; ?>"><span class="fa fa-check"></span> Save changes</button>
                                        </div>

                                    </div>
                                    

                                    
                                </form>
                                    
                            </div>
                            <!-- Info Panels ends here -->
                            
                        </div>
                    </div> 

                    
                    
                </div>
                
                
            </div>
            <!-- Main content ends here -->
            

        </div>

    </div>

  </section>

  <!-- Main Body Ends here -->



<?php include 'includes/footer.php'; ?>
