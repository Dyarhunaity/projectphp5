<?php 
    session_start();
    include 'config/connect.php';

    if(!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items']))
    {
        header('location:index.php');
        exit();
    }

    require_once('config/config.php');    
    require_once('include/helpers.php');  
    $cartItemCount = count($_SESSION['cart_items']);

    if(isset($_POST['submit']))
    {
      $totalPrice = 0;
      $sale_view=mysqli_fetch_all(mysqli_query($conn,'select * from order_details'),MYSQLI_ASSOC);
      //  print_r($sale_view[0]['product_name']);
      $orderId=$sale_view[0]['id'];
      $productID=$sale_view[0]['product_id'];
      $product_name=$sale_view[0]['product_name'];
      $product_price=$sale_view[0]['product_price'];
      $productQty=$sale_view[0]['qty'];
      $calculateTotalPrice=$sale_view[0]['total_price'];
      $img=$sale_view[0]['product_image'];

      $sql1="INSERT INTO sales (order_id,product_id,product_name,product_price,qty,total_price,product_image) VALUES ('$orderId','$productID','$product_name',$product_price,$productQty,$calculateTotalPrice,'$img');";
      mysqli_query($conn , $sql1);

      $sql='DELETE FROM order_details';
      mysqli_query($conn , $sql);
      $_SESSION['cart_items'][]="";
      foreach($_SESSION['cart_items'] as $item)
      {
      $totalPrice += $item['total_price'];
      header('location:thank-you.php');
      // exit();
      }
    }
	
	$pageTitle = 'Demo PHP Shopping cart checkout page with Validation';
	$metaDesc = 'Demo PHP Shopping cart checkout page with Validation';
	
    include('include/header.php');
?>
<div class="row mt-3">
        <div class="col-md-8 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill"><?php echo $cartItemCount;?></span>
          </h4>
          <ul class="list-group mb-3">
            <?php
                $total = 0;
                foreach($_SESSION['cart_items'] as $cartItem):?>
                <?php
                echo $cartItem['total_price'];
                 $total+= $cartItem['total_price']; ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $cartItem['product_name'] ?></h6>
                            <small class="text-muted">Quantity: <?php echo $cartItem['qty'] ?> X Price: <?php echo $cartItem['product_price'] ?></small>
                        </div>
                        <span class="text-muted">$<?php echo $cartItem['total_price'] ?></span>
                    </li>
            <?php endforeach; ?>
           
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$<?php echo number_format($total,2);?></strong>
            </li>
          </ul>
        </div>
        <div class="col-md-4 order-md-1">
          <!-- <h4 class="mb-3">Billing address</h4> -->
          <?php 
            if(isset($errorMsg) && count($errorMsg) > 0)
            {
                foreach($errorMsg as $error)
                {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
            }
          ?>
           <form class="needs-validation" method="POST">
            <!-- <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name" value="<?php 
                // echo (isset($fnameValue) && !empty($fnameValue)) ? $fnameValue:'' 
                ?>" >
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name" value="<?php 
                // echo (isset($lnameValue) && !empty($lnameValue)) ? $lnameValue:'' 
                ?>" >
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?php 
              // echo (isset($emailValue) && !empty($emailValue)) ? $emailValue:'' 
              ?>">
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php 
              // echo (isset($addressValue) && !empty($addressValue)) ? $addressValue:'' 
              ?>">
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite" value="<?php 
              // echo (isset($address2Value) && !empty($address2Value)) ? $address2Value:'' 
              ?>">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" name="country" id="country" >
                  <option value="">Choose...</option>
                  <option value="United States" >United States</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" name="state" id="state" >
                  <option value="">Choose...</option>
                  <option value="California">California</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zipcode" placeholder="" value="<?php 
                // echo (isset($zipCodeValue) && !empty($zipCodeValue)) ? $zipCodeValue:'' 
                ?>" >
              </div>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="cashOnDelivery" name="cashOnDelivery" type="radio" class="custom-control-input" checked="" >
                <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
              </div>
            </div>
           
            <hr class="mb-4">-->
            <button class="btn btn-secondary btn-lg" type="submit" name="submit" value="submit" >Continue to checkout</button>
          </form> 
        
        </div>
      </div>
<?php include('include/footer.php'); ?>