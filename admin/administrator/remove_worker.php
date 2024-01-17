<?php
  $page_title = 'Admin | Remove worker';
  include 'includes/header.php';



//   remove branch form

    if(isset($_GET['remove_worker'])){
        $worker_id = $_GET['remove_worker'];

        // Check if all required fields are filled
        if( empty($worker_id) ){
            header("Location: remove_worker.php?error=emptyWorker");
        }
        else{
            // Remove worker from db
            remove_worker($worker_id);
            header("Location: remove_worker.php?remove=success");
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
                        <a href="<?php echo u(h('workers.php')); ?>" class="btn text-white btn-block mb-3"><span class="fa fa-arrow-left"></span> Back to workers</a>
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
                                <p class="card-text"><span class="fa fa-trash"></span> Remove worker</p>
                            </div>

                            <form action="remove_worker.php" method="GET">
                            
                                <!-- Padding for form -->
                                    <div class="card-body">
                                        <div class="row">
                                            <?php show_remove_workers(); ?>
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
