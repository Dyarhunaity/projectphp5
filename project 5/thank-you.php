<?php 
    session_start();

     if(!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order']))
     {
        //  header('location:index.php');
        //  exit();
     }

    require_once('config/config.php');    
    require_once('include/helpers.php');  

    
	$pageTitle = 'Demo Thank You';
	$metaDesc = 'Demo PHP shopping cart thank you page';
	
    include('include/header.php');
?>
<div class="row">
    <div class="col-md-12">
        <h1>Thank you!</h1>
        <p>
            Your order has been placed.
            <?php unset($_SESSION['confirm_order']);?>
        </p>
    </div>

    <a href="index.php">back to home page</a>
</div>
<?php include('include/footer.php'); ?>    