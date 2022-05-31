<?php
include 'config/connect.php';

session_start();
$orderF = "none";
$uF = "none";
$user_id = $_SESSION['id'];
$orders = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM user_orders WHERE user_idd='$user_id';"), MYSQLI_ASSOC);
$userinfo = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id';"), MYSQLI_ASSOC);
// print_r($user_id);
// update user Function
if (isset($_POST['updateUserSubmit'])) {
    $newName = $_POST['userName'];
    $newEmail = $_POST['userEmail'];
    $newPhone = $_POST['userPhone'];
    $newPass = $_POST['userPass'];
    $updateat = date('Y-m-d H:i:s');
    $newAddress = $_POST['newAddress'];
    $newCity = $_POST['newCity'];

    $sqlh = "UPDATE `users` SET fname='$newName',email='$newEmail',phone='$newPhone',pass='$newPass',addres='$newAddress',updated_at='$updateat',city='$newCity' WHERE id='$user_id';";
    mysqli_query($conn, $sqlh);
    echo "<script>alert('Your Data Updated Successfully');</script>";
    header("location: user.php");
    // echo $newName.$newEmail.$newPhone.$updateat.$newAddress.$newCity;
}


if (isset($_POST['cart']) && $orderF == 'none') {
    $orderF = "block";
}
include 'include/header.php';
?>
<div class="hr-theme-slash-2">
    <div class="hr-line"></div>
    <div class="hr-icon"><i class="fa-solid fa-couch"></i></div>
    <div class="hr-line"></div>
</div>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 mapimg">
            <div class="text-bg text-h1">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="text-img" >
                <div class="container">
                    <div class="row gutters">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body userpro">
                                    <div class="account-settings">
                                        <div class="user-profile">
                                            <div class="user-avatar">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                            </div>
                                            <br>
                                            <h4 class="user-name"><?php echo $_SESSION['name'] ?></h4>
                                            <h5 class="user-email"><?php echo $_SESSION['email'] ?></h5>
                                        </div>
                                        <!-- <div class="about">
				<h5>About</h5>
				<p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
			</div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <form action="user.php" method="post">
                                        <div class="row gutters">

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h5 class="mb-2 text-primary">Personal Details</h5>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="fullName">Name</label>
                                                    <input type="name" class="form-control" id="fullName" name="userName" value="<?php echo $userinfo[0]['fname'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="eMail">Email</label>
                                                    <input type="email" class="form-control" id="eMail" name="userEmail" value="<?php echo $userinfo[0]['email'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="number" class="form-control" id="phone" name="userPhone" value="<?php echo $userinfo[0]['phone'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="password">password</label>
                                                    <input type="password" class="form-control" id="password" name="userPass" value="<?php echo $userinfo[0]['pass'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h5 class="mt-3 mb-2 text-primary">Location</h5>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="Street">Address</label>
                                                    <input type="text" class="form-control" id="Street" name="newAddress" value="<?php echo $userinfo[0]['addres'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="ciTy">City</label>
                                                    <input type="name" class="form-control" id="ciTy" name="newCity" value="<?php echo $userinfo[0]['city'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right">

                                                    <button class="btn btn-secondary" type="submit" name="cart">My Orders</button>
                                                    <button type="submit" id="submit" name="updateUserSubmit" class="btn btn-dark">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- <button class="btn btn-secondary" type="submit" name="cart">My Orders</button> -->
    <div class="container" >
        <table class="table" style="display:<?php echo $orderF ?>; border:.5px solid !important ;">
            <th>Product_name</th>
            <th>Quantity</th>
            <th>Product price</th>
            <th>Total price</th>
            <tbody>

                <?php foreach ($orders as $order) : ?>
                    <?php echo
                    "<tr>
                                <td>" . $order['product_name'] . "</td>
                                <td>" . $order['qty'] . "</td>
                                <td>" . $order['product_price'] . "</td>
                                <td>" . $order['total_price'] . "</td>
                                </tr>"
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <br>
    <!-- Update User Info Form -->

</div>