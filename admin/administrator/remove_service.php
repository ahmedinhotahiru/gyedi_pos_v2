<?php
  $page_title = 'Admin | Remove service';
  include 'includes/header.php';



//   remove branch form

    if(isset($_GET['remove_service'])){
        $service_id = $_GET['service_id'];

        // Check if all required fields are filled
        if( empty($service_id) ){
            header("Location: remove_service.php?error=emptyService");
        }
        else{
            // Remove service from db
            remove_service($service_id);
            header("Location: services.php?remove=success");
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
                            <a href="index.php" class="list-group-item list-group-item-action">
                                <span class="fa fa-cog"></span> Dashboard
                            </a>
                            <a href="workers.php" class="list-group-item list-group-item-action">
                                <span class="fa fa-user"></span> Workers <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_workers(); ?></span>
                            </a>
                            <a href="branches.php" class="list-group-item list-group-item-action">
                                <span class="fa fa-home"></span> Branches <span class="badge badge-pill badge-secondary pull-right"> <?php echo no_of_branches(); ?></span>
                            </a>
                            <a href="services.php" class="list-group-item list-group-item-action">
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
                                <p class="card-text"><span class="fa fa-trash"></span> Remove service</p>
                            </div>

                            <form action="remove_service.php" method="GET">
                            
                                <!-- Padding for form -->
                                <div class="p-3">
                                    <div class="card-body">

                                        <!-- Display error messaages starts here -->
                                        <?php
                                            if(isset($_GET['error'])){
                                                $error = $_GET['error'];

                                                switch ($error) {
                                                    case 'emptyService':
                                                        echo '<p class="text-center text-danger"><span class="fa fa-warning"></span> Select a service</p>';
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
                                                
                                                <div class="col-12 mb-5">
                                                    <label for="service" class="col-form-label">Service <span class="required">*</span></label>
                                                    <select name="service_id" id="service" class="form-control">
                                                        <option value="">Select service...</option>
                                                        <?php select_services();  ?>
                                                    </select>
                                                </div>


                                            </div>
                                        <!-- Form content ends here -->
                                            
                                    </div>
                                </div>

                              <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <button class="btn btn-danger btn-lg btn-block" type="submit" name="remove_service" onclick="return confirm('Are you sure you want to remove selected service?');"><span class="fa fa-remove"></span> Remove service</button>
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
