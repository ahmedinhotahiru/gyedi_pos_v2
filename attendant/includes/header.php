<?php
  session_start();
  include 'functions.php';
  include '../dbh/db.php';
  include '../dbh/db_functions.php';

  if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php?error=login");
    exit();
  }
  if(!($_SESSION['position'] == "Attendant")){
    header("Location: ../index.php?error=login");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $page_title; ?></title>
  <link rel="icon" type="image/png" href="../img/logo2.png">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  
  <!-- navigation bar starts here -->
  <nav class="navbar navbar-dark bg-primary navbar-expand-lg py-0 sticky-top">
    <div class="container">
      <a href="#" class="navbar-brand"><?php echo $_SESSION['c_name']; ?></a>
      <div class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </div>
      <div class="navbar-collapse collapse" id="navbarCollapse">
        <!-- Left navigation links -->
        <ul class="navbar-nav">
          <li class="nav-item px-2 <?php if($page_title == 'Gyedi | Dashboard'){echo 'active';} ?>">
            <a href="index.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item px-2 <?php if($page_title == 'Gyedi | My Sales'){echo 'active';} ?>">
            <a href="my_sales.php" class="nav-link">My Sales</a>
          </li>
          <li class="nav-item px-2 <?php if($page_title == 'Gyedi | My Expenses'){echo 'active';} ?>">
            <a href="my_expenses.php" class="nav-link">My Expenses</a>
          </li>
        </ul>
        <!-- Left navigation ends links -->

        <!-- right navigation links -->
        <ul class="navbar-nav ml-auto">
          <!-- account options -->
          <li class="nav-item px-2 active dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="#profileDrop"><span class="fa fa-user"></span> <?php echo $_SESSION['first_name']; ?></a>
            <div class="dropdown-menu" id="profileDrop">
              <a href="profile.php" class="dropdown-item"><span class="fa fa-user-circle"></span> Profile</a>
              <form action="../logout.php" method="post">
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><span class="fa fa-sign-out"></span> Logout</button>
              </form>
            </div>
          </li>
          <li class="nav-item nav-link px-2"> Attendant</a></li>
          <li class="nav-item nav-link px-2 active"><span class="fa fa-map-marker"></span> <?php echo $_SESSION['branch']; ?></a></li>
          
        </ul>
        <!-- right navigation links -->
      </div>
    </div>
  </nav>
  <!-- Nav ends here -->


<!-- Select header icon and header title -->
<?php
    switch ($page_title) {
        case 'Gyedi | Dashboard':
            $icon = 'fa-cog';
            $header = 'Dashboard';
            break;

        case 'Gyedi | Profile':
            $icon = 'fa-user';
            $header = 'Profile';
            break;

        case 'Gyedi | My Sales':
            $icon = 'fa-shopping-cart';
            $header = 'My Sales';
            break;

        case 'Gyedi | My Expenses':
            $icon = 'fa-pencil-square-o';
            $header = 'My Expenses';
            break;

        case 'Gyedi | Receipt':
            $icon = 'fa-list-alt';
            $header = 'Receipt';
            break;

        default:
            $icon = 'fa-cog';
            $header = 'Dashboard';
            break;
    }
?>



  <!-- Header Starts here -->
  <header class="bg-light py-3 <?php if($page_title == 'Gyedi | Receipt'){echo 'header';} ?>">
    <div class="container d-flex justify-content-between">
      <div>
        <h2 class="flex-start"><span class="fa <?php echo $icon; ?>"></span> <?php echo $header; ?></h2>
      </div>
      <!-- Profile picture -->
      <div class="dp">
        <a href="profile.php"><img src="<?php echo user_pic($_SESSION['user_id']); ?>" alt="" class="flex-end"></a>
      </div>
    </div>
  </header>
  <!-- Header Ends here -->