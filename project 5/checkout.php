<?php
session_start();
include 'config/connect.php';

//outofill information
$name=$_SESSION['name'];
$lname=$_SESSION['lname'];
$email=$_SESSION['email'];
$phone=$_SESSION['phone'];
$city=$_SESSION['city'];
$address=$_SESSION['address'];


if (!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items'])) {
  header('location:index.php');
  exit();
}

require_once('config/config.php');
require_once('include/helpers.php');
$cartItemCount = count($_SESSION['cart_items']);

if (isset($_POST['submit'])) {
  $totalPrice = 0;
  $sale_view = mysqli_fetch_all(mysqli_query($conn, 'select * from order_details'), MYSQLI_ASSOC);
  //  print_r($sale_view[0]['product_name']);
  $orderId = $sale_view[0]['id'];
  $productID = $sale_view[0]['product_id'];
  $product_name = $sale_view[0]['product_name'];
  $product_price = $sale_view[0]['product_price'];
  $productQty = $sale_view[0]['qty'];
  $calculateTotalPrice = $sale_view[0]['total_price'];
  $img = $sale_view[0]['product_image'];

  $sql1 = "INSERT INTO sales (order_id,product_id,product_name,product_price,qty,total_price,product_image) VALUES ('$orderId','$productID','$product_name',$product_price,$productQty,$calculateTotalPrice,'$img');";
  mysqli_query($conn, $sql1);

  $sql = 'DELETE FROM order_details';
  mysqli_query($conn, $sql);
  // $_SESSION['cart_items'][] = "";
  foreach ($_SESSION['cart_items'] as $item) {
    $totalPrice += $item['total_price'];
    header('location:thank-you.php');
  }
}

$pageTitle = 'Demo PHP Shopping cart checkout page with Validation';
$metaDesc = 'Demo PHP Shopping cart checkout page with Validation';

include('include/header.php');
?>
<div class="hr-theme-slash-2">
  <div class="hr-line"></div>
  <div class="hr-icon"><i class="fa-solid fa-couch"></i></div>
  <div class="hr-line"></div>
</div>
<br>
<div class="container">
  <div class="row mt-3">
    <div class="col-md-6 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill"><?php echo $cartItemCount; ?></span>
      </h4>
      <ul class="list-group mb-3">
        <?php
        $total = 0;
        foreach ($_SESSION['cart_items'] as $cartItem) : ?>
          <?php
          echo $cartItem['total_price'];
          $total += $cartItem['total_price']; ?>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0"><?php echo $cartItem['product_name'] ?></h6>
              <small class="text-muted">Quantity: <?php echo $cartItem['qty'] ?> X Price: <?php echo $cartItem['product_price'] ?></small>
            </div>
            <span class="text-muted">JD<?php echo $cartItem['total_price'] ?></span>
          </li>
        <?php endforeach; ?>

        <li class="list-group-item d-flex justify-content-between">
          <span>Total (JD)</span>
          <strong>JD<?php echo number_format($total, 2); ?></strong>
        </li>
      </ul>
      <form method="POST" class="needs-validation" action="checkout.php" style="display: flex; flex-direction: column;">
        <button class="btn btn-success btn-lg" type="submit" name="submit" value="submit">Place order</button>
    <!-- </form> -->
    </div>
    
    <div class="col-md-6 order-md-1">
      <h3 class="mb-3">Billing address</h3>
      <?php
      if (isset($errorMsg) && count($errorMsg) > 0) {
        foreach ($errorMsg as $error) {
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }
      }
      ?>
      <!-- <form class="needs-validation" method="POST"> -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name" value="<?php echo $name ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name" value="<?php echo $lname ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?php echo $email ?>" required>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo $address ?>" required>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite" value="">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="country" id="country">
              <option value="<?php echo $city ?>"><?php echo $city ?></option>
              <option value="Amman">Amman</option>
              <option value="Aqaba">Aqaba</option>
              <option value="Maan">Maan</option>
              <option value="Irbid">Irbid</option>
              <option value="Zarqa">Zarqaa</option>
              <option value="Ajloun">Ajloun</option>
              <option value="Jarash">Jarash</option>
              <option value="Al-Mafraq">Al-Mafraq</option>
              <option value="Al-Tafeela">Al-Tafila</option>
              <option value="El-Karak">Al-Karak</option>
              <option value="Madaba">Madaba</option>
              <option value="Al-Salt">Al-Salt</option>
            </select>
            </select>
          </div>
        </div>
        <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="cashOnDelivery" name="cashOnDelivery" type="radio" class="custom-control-input" checked="">
            <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
          </div>
        </div>
        <hr class="mb-4">
      </form>
      <br>
    </div>
  </div>
</div>
<?php include('include/footer.php'); ?>