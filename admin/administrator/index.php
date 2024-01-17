<?php
  $page_title = 'Admin | Dashboard';
  include 'includes/header.php';
?>



  <!-- Main Body Starts here -->

  <section>

    <div class="container my-5">

        <div class="row mb-5">

            <!-- Side navigation starts here -->
            <div class="col-md-3 mb-3">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <div class="list-group ">
                            <a href="#" class="list-group-item list-group-item-action bg-light">
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

                    <div class="col-md-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-text"><?php echo date("Y"); ?></h4>
                                <!-- Identify percentage of month and year -->
                                <?php
                                    // Determine month
                                    $month = date("n");
                                    $month_percentage = ($month / 12) * 100;
                                    $month_percentage = round($month_percentage, 0);    
                                ?>
                                <div class="progress">
                                    <div class="progress-bar bg-dark" style="width:<?php echo $month_percentage; ?>%;">
                                        <?php echo $month_percentage . "%"; ?>
                                    </div>
                                </div><br>

                                <h4 class="card-text"><?php echo date("M"); ?></h4>
                                <!-- Identify percentage of month and year -->
                                <?php
                                    $day = date("d");
                                    // Determine days in the month
                                    $days_in_month = date("t");
                                    $day_percentage = ($day / $days_in_month) * 100;
                                    $day_percentage = round($day_percentage, 0);    
                                ?>
                                <div class="progress">
                                    <div class="progress-bar bg-dark" style="width:<?php echo $day_percentage; ?>%;min-width:20px;">
                                        <?php echo date("d"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Side navigation ends here -->            




            <!-- Main content starts here -->
            <div class="col-md-9">
                <div class="row">

                
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <p class="card-text"><span class="fa fa-eye"></span> Overview</p>
                            </div>

                            <!-- Info Panels starts here -->
                            <div class="card-body">
                                <div class="row mb-5">

                                    <div class="col-lg-3 mb-3">
                                        <div class="card text-center bg-light p-3">
                                            <a href="<?php echo u(h('workers.php')); ?>" class="btn p-0">
                                                <div class="card-body">
                                                    
                                                    <h3><span class="fa fa-users"></span> <?php echo no_of_workers(); ?></h3>
                                                    <p class="card-text">Workers</p>
                                                    
                                                </div>
                                            </a>
                                        </div>  
                                    </div>

                                    <div class="col-lg-3 mb-3">
                                        <div class="card text-center bg-light p-3">
                                            <a href="<?php echo u(h('branches.php')); ?>" class="btn p-0 text-success">
                                                <div class="card-body">                                          
                                                    <h3><span class="fa fa-home"></span> <?php echo no_of_branches(); ?></h3>
                                                    <p class="card-text">Branches</p>
                                                </div>
                                            </a>
                                        </div>  
                                    </div>

                                    <div class="col-lg-3 mb-3">
                                        <div class="card text-center bg-light p-3">
                                            <a href="<?php echo u(h('services.php')); ?>" class="btn p-0 text-danger">   
                                                <div class="card-body">                                       
                                                    <h3><span class="fa fa-globe"></span> <?php echo no_of_services(); ?></h3>
                                                    <p class="card-text">Services</p>                                   
                                                </div>
                                            </a>
                                        </div>  
                                    </div>

                                    <div class="col-lg-3 mb-3">
                                        <div class="card text-center bg-light p-3">
                                            <a href="<?php echo u(h('statistics.php')); ?>" class="btn p-0 text-dark">
                                                <div class="card-body">                                          
                                                    <h3><span class="fa fa-bar-chart"></span> <?php  ?></h3>
                                                    <p class="card-text">Statistics</p>
                                                </div>
                                            </a>
                                        </div>  
                                    </div>

                                </div>
                                                                    
                            </div>
                            <!-- Info Panels ends here -->
                            
                        </div>
                    </div> 

                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-text"><span class="fa fa-shopping-cart"></span> Latest Checkouts</div>
                            </div>


                            <!-- Fetch checkouts from database starts here -->
                            <?php
                                latest_checkouts();
                            ?>
                            <!-- Fetch checkouts from database ends here -->


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
