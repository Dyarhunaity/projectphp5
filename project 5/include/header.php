<?php

$uss = "none";
$uss1 = "inline-block";


if (!empty($_SESSION['name'])) {
    $uss = "inline-block";
    $uss1 = "none";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Luxury Furniture</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- font-awesome -->
    <script src="https://kit.fontawesome.com/4a27207296.js" crossorigin="anonymous"></script>
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style>
        body{
            font-family:Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<!-- body -->

<body class="main-layout ">

    <!-- loader  -->
    <!-- <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div> -->
    <!-- end loader -->

    <div class="wrapper ">


        <!-- <div class="sidebar bg-warning text-dark" > -->
        <!-- Sidebar  -->
        <!-- <nav id="sidebar" >

            <div id="dismiss">
                <i class="fa fa-arrow-left"></i>
            </div>

            <ul class="list-unstyled components">
                
                <li class="active"> <a href="index.php">Home</a></li>
                 <li> <a href="about.php">About</a></li>
                                        <li> <a href="product.php">Product</a></li>
                                        <li> <a href="blog.php">Blog</a></li>
                                        <li> <a href="contact.php">Contact us</a></li>

            </ul>

        </nav>
      </div> -->
        <div id="content">
            <!-- header -->
            <header>
                <!-- header inner -->
                <div class="headernav">
<!-- header-bg -->
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-3 logo_section">
                                <div class="full">
                                    <div class="center-desk">
                                        <div class="logo">
                                            <a href="index.php"><img src="images/logo1.png" alt="#"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="right_header_info">
                                    <ul>
                                        <li class="active"> <a href="index.php">Home</a></li>
                                        <li> <a href="main.php">Product</a></li>
                                        <li> <a href="about.php">About</a></li>
                                        <li> <a href="contact.php">Contact us</a></li>
                                        <li style="display:<?php echo $uss1; ?> ;">
                                            <a href="register.php">Sign up</a>
                                        </li>
                                        <li style="display:<?php echo $uss1; ?> ;">
                                            <a href="login.php">Login</a>
                                        </li>

                                        <li style="display:<?php echo $uss; ?> ;"><a href="cart.php"><i class="fa-solid fa-basket-shopping fa-lg basket-icon"></i></a>
                                        </li>
                                        <li style="display:<?php echo $uss; ?> ;"><a href="user.php"><i class="fa-solid fa-user fa-lg basket-icon"></i></a>
                                        </li>
                                        <li style="display:<?php echo $uss; ?> ;"><a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right fa-lg basket-icon"></i></i></a>
                                        </li>

                                        <!-- <li>
                                            <button type="button" id="sidebarCollapse">
                                                <img src="images/menu_icon.png" alt="#" />
                                                <i class="fa-solid fa-bars menu-icon"></i>
                                            </button>
                                        </li> -->

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end header inner -->
            </header>
            <!-- end header -->