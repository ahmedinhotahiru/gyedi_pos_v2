<?php
  session_start();
  include 'functions.php';
  include '../dbh/db.php';
  include '../dbh/db_functions.php';

  if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php?error=login");
    exit();
  }
  if(!($_SESSION['pass_code'] == "thbruce1970")){
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
  <link rel="icon" type="image/png" href="../../img/logo.png">
  <link rel="stylesheet" href="../../css/font-awesome.min.css">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body style="background:url('../../img/img5.jpg');background-repeat:no-repeat;background-size:cover;">
  
  <!-- navigation bar starts here -->
  <nav class="navbar navbar-dark navbar-expand-lg py-0">
    <div class="container">
      <a href="#" class="navbar-brand"><?php echo $_SESSION['c_name']; ?></a>
      <div class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </div>
      <div class="navbar-collapse collapse" id="navbarCollapse">
        <!-- Left navigation links -->
        <ul class="navbar-nav">
          <li class="nav-item px-2 <?php if($page_title == 'Admin | Dashboard'){echo 'active';} ?>">
            <a href="<?php echo u(h('index.php')); ?>" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item px-2 <?php if($page_title == 'Admin | Workers'){echo 'active';} ?>">
            <a href="<?php echo u(h('workers.php')); ?>" class="nav-link">Workers</a>
          </li>
          <li class="nav-item px-2 <?php if($page_title == 'Admin | Branches'){echo 'active';} ?>">
            <a href="<?php echo u(h('branches.php')); ?>" class="nav-link">Branches</a>
          </li>
          <li class="nav-item px-2 <?php if($page_title == 'Admin | Services'){echo 'active';} ?>">
            <a href="<?php echo u(h('services.php')); ?>" class="nav-link">Services</a>
          </li>
        </ul>
        <!-- Left navigation ends links -->

        <!-- right navigation links -->
        <ul class="navbar-nav ml-auto">
          <!-- account options -->
          <li class="nav-item px-2 active dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="#profileDrop"><span class="fa fa-user"></span> <?php echo $_SESSION['first_name']; ?></a>
            <div class="dropdown-menu" id="profileDrop">
              <a href="admin_profile.php" class="dropdown-item"><span class="fa fa-user-circle"></span> Profile</a>
              <a href="settings.php" class="dropdown-item"><span class="fa fa-cog"></span> Settings</a>
              <form action="../logout.php" method="post">
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><span class="fa fa-sign-out"></span> Logout</button>
              </form>
            </div>
          </li>
          <!-- Cart -->
          <li class="nav-item px-2 nav-link active"> Welcome, Admin</li>
        </ul>
        <!-- right navigation links -->
      </div>
    </div>
  </nav>
  <!-- Nav ends here -->


<!-- Select header icon and header title -->
<?php
    switch ($page_title) {
        case 'Admin | Dashboard':
            $icon = 'fa-cog';
            $header = 'Dashboard';
            break;

        case 'Admin | Workers':
            $icon = 'fa-users';
            $header = 'Workers';
            break;
        
        case 'Admin | Branches':
            $icon = 'fa-home';
            $header = 'Branches';
            break;

        case 'Admin | Services':
            $icon = 'fa-globe';
            $header = 'Services';
            break;

        case 'Admin | Worker':
            $icon = 'fa-user';
            $header = 'Worker';
            break;

        case 'Admin | Add worker':
            $icon = 'fa-user-plus';
            $header = 'Add worker';
            break;

        case 'Admin | Add branch':
            $icon = 'fa-home';
            $header = 'Add branch';
            break;

        case 'Admin | Add service':
            $icon = 'fa-globe';
            $header = 'Add service';
            break;
        
        case 'Admin | Remove branch':
            $icon = 'fa-trash';
            $header = 'Remove branch';
            break;

        case 'Admin | Remove service':
            $icon = 'fa-trash';
            $header = 'Remove service';
            break;

        case 'Admin | Remove worker':
            $icon = 'fa-trash';
            $header = 'Remove worker';
            break;

        case 'Branch | Branch Info':
            $icon = 'fa-home';
            $header = 'Branch';
            break;

        case 'Branch | Checkouts':
            $icon = 'fa-shopping-cart';
            $header = 'Checkouts';
            break;

        case 'Branch | Expenses':
            $icon = 'fa-pencil-square-o';
            $header = 'Expenses';
            break;

        case 'Branch | Sales Report':
            $icon = 'fa-book';
            $header = 'Sales Report';
            break;    
        
        case 'Checkouts | Receipt':
            $icon = 'fa-list-alt';
            $header = 'Receipt';
            break;

        case 'Admin | Profile':
            $icon = 'fa-user';
            $header = 'Profile';
            break;
        
        case 'Admin | Salary Report':
            $icon = 'fa-suitcase';
            $header = 'Salary Report';
            break;

        case 'Admin | Sales Report':
            $icon = 'fa-line-chart';
            $header = 'Sales Report';
            break;

        case 'Admin | Settings':
            $icon = 'fa-cog';
            $header = 'Settings';
            break;

        default:
            $icon = 'fa-cog';
            $header = 'Dashboard';
            break;
    }
?>



  <!-- Header Starts here -->
  <header class="text-white py-3 <?php if($page_title == 'Admin | Receipt'){echo 'header';} ?>">
    <div class="container d-flex justify-content-between">
      <div>
        <h2 class="flex-start"><span class="fa <?php echo $icon; ?>"></span> <?php echo $header; ?></h2>
      </div>
      <!-- Profile picture -->
      <div class="dp2 dropdown">
        <a href="<?php echo u(h('admin_profile.php')); ?>"><img src="<?php echo user_pic($_SESSION['user_id']); ?>" alt="" onerror="this.onerror=null;this.src='../../img/profile.jpg';" class="flex-end"></a>
      </div>
    </div>
  </header>
  <!-- Header Ends here -->