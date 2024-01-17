<?php
  $page_title = 'Admin | Add service';
  include 'includes/header.php';


  //   add service form

    if(isset($_GET['add_service'])){
        $service_name = ucwords(strtolower($_GET['service_name']));
        $service_price = $_GET['service_price'];

        // Check if all required fields are filled
        if( empty($service_name) ){
            header("Location: add_service.php?error=emptyName&service_price=$service_price");
        }
        elseif( empty($service_price) ){
            header("Location: add_service.php?error=emptyPrice&service_name=$service_name");            
        }
        else{
            
            if( $service_price < 0.1 ){
                header("Location: add_service.php?error=servicePrice&service_name=$service_name&service_price=$service_price");                                
            }
            else{

                // Insert service into db
                add_service($service_name, $service_price);
                header("Location: services.php?add=success");
            }
        }
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



                    <!-- Action buttons start here -->
                    <div class="col-md-12 mt-5">
                        <a href="<?php echo u(h('services.php')); ?>" class="btn text-white btn-block mb-3"><span class="fa fa-arrow-left"></span> Back to services</a>
                    </div>
                    <!-- Action buttons start here -->

                    
                </div>
            </div>
            <!-- Side bar ends here -->


            <!-- Main content starts here -->
            <div class="col-md-9">
                <div class="row">

                    <div class="col-md-12 mb-4">

                        <div class="card">
                            <div class="card-header">
                                <p class="card-text"><span class="fa fa-plus"></span> Add service</p>
                            </div>

                            <form action="<?php echo u(h('add_service.php')); ?>" method="get">
                            
                                <!-- Padding for form -->
                                <div class="p-3">
                                    <div class="card-body">



                                        <!-- Display error messaages starts here -->
                                        <?php
                                            if(isset($_GET['error'])){
                                                $error = $_GET['error'];

                                                switch ($error) {
                                                    case 'emptyName':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Service name is required</p>';
                                                        break;

                                                    case 'emptyPrice':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Price is required</p>';
                                                        break;
                                                    
                                                    case 'serviceName':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid service name</p>';
                                                        break;

                                                    case 'servicePrice':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Invalid price</p>';
                                                        break;
                                                    
                                                    default:
                                                        # code...
                                                        break;
                                                }
                                            }
                                        ?>
                                        <!-- Display error messaages ends here -->



                                        <!-- Form content starts here -->
                                            <div class="form-row">
                                                
                                                <div class="col-lg-6 col-md-6 mb-5">
                                                    <label for="service_name" class="col-form-label">Service name <span class="required">*</span></label>
                                                    <input type="text" name="service_name" id="service_name" placeholder="Enter service name" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyName'){echo 'input-required';} ?>" value="<?php if(isset($_GET['service_name'])){echo $_GET['service_name'];} ?>">
                                                </div>

                                                <!-- Price -->
                                                <div class="col-lg-6 col-md-6 mb-5">
                                                    <label for="service_price" class="col-form-label">Price <span class="required">*</span></label>
                                                    <input type="number" name="service_price" id="service_price" class="form-control <?php if(isset($_GET['error']) && $_GET['error']=='emptyPrice'){echo 'input-required';} ?>" placeholder="Enter service price" min="0.10" step="0.10" value="<?php if(isset($_GET['service_price'])){echo $_GET['service_price'];} ?>">
                                                </div>


                                            </div>
                                        <!-- Form content ends here -->
                                            
                                    </div>
                                </div>

                              <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <button class="btn btn-success btn-lg btn-block" type="submit" name="add_service"><span class="fa fa-check"></span> Create service</button>
                                        </div>
                                    </div>
                              </div>

                            </form>

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
