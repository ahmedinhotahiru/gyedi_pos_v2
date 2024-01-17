<?php
  $page_title = 'Admin | Workers';
  include 'includes/header.php';
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
                            <a href="#" class="list-group-item list-group-item-action bg-light text-primary">
                                <span class="fa fa-user"></span> Workers <span class="badge bg-primary badge-pill badge-secondary pull-right"> <?php echo no_of_workers(); ?></span>
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
                        <a href="<?php echo u(h('add_worker.php')); ?>" class="btn text-white btn-block mb-3"><span class="fa fa-plus"></span> Add worker</a>
                        <a href="<?php echo u(h('remove_worker.php')); ?>" class="btn text-warning btn-block mb-3"><span class="fa fa-trash"></span> Remove worker</a>
                    </div>
                    <!-- Action buttons start here -->

                    
                </div>
            </div>
            <!-- Side bar ends here -->


            <!-- Main content starts here -->
            <div class="col-md-9">
                <div class="row">

                    <div class="col-md-12 mb-4">

                        <div id="accordion" role="tablist">

                            <?php workers_accordion(); ?>
                       
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
