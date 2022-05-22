<?php
include 'config/connect.php';

session_start();
$orderF="none";
$uF="none";
$user_id=$_SESSION['id'];
$orders=mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM user_orders WHERE user_idd='$user_id';"),MYSQLI_ASSOC);

// update user Function
if (isset($_POST['editUser'])) {
    $uF="block";
    $userToUpdate=$_SESSION['id'];
    $sql="UPDATE users
    SET updat=1
    WHERE id=$userToUpdate;";
    mysqli_query($conn,$sql);
    // return $userToUpdate;
}
if (isset($_POST['updateUserSubmit'])) 
{
        $newName=$_POST['userName'];
        $newEmail=$_POST['userEmail'];
        $newPhone=$_POST['userPhone'];
        $newPass=$_POST['userPass'];
        $updateat=date('d-m-Y');

$sql="UPDATE users SET fname='$newName',email='$newEmail',phone='$newPhone',Pass='$newPass',updated_at='$updateat',updat=0 WHERE updat=1;";
mysqli_query($conn,$sql);
}


if (isset($_POST['cart']) && $orderF == 'none') {
    $orderF="block";
}
include 'include/header.php';
?>

<div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 mapimg">
                    <div class="text-bg text-h1">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="text-img">
                        <table class="table" style="display:<?php echo $userF ?> ;">
                        <tr><td><h2>My Information</h2></td></tr>
                        <tr><th>Name</th>
                            <th>email</th>
                            <th>password</th>
                            <th>address</th>
                            <th>city</th>
                            <th>phone number</th></tr>
                            <tbody>
                                <tr>
                            <td><?php echo $_SESSION['name'] ?></td>
                            <td><?php echo $_SESSION['email'] ?></td>
                            <td><?php echo $_SESSION['pass'] ?></td>
                            <td><?php echo $_SESSION['address'] ?></td>
                            <td><?php echo $_SESSION['city'] ?></td>
                            <td><?php echo $_SESSION['phone'] ?></td>
                                </tr>
                            <tr class="col-lg-offset-4"><td><form action="user.php" method="post"><button type="submit" class="btn btn-light" name="editUser">Edit</button></form></td></tr>
                            <tr><td>                    <form action="user.php" method="post">
                            <button class="btn btn-secondary" type="submit" name="cart">My Orders</button>
                        </form></td></tr>
                            </tbody>
                        </table>
                        <table class="table" style="display:<?php echo $orderF ?>;">
                            <th>Product_name</th>
                            <th>Quantity</th>
                            <th>Product price</th>
                            <th>Total price</th>
                            <tbody>
                                
                            <?php foreach ($orders as $order): ?>
                            <?php echo 
                            "<tr>
                                <td>".$order['product_name']."</td>
                                <td>".$order['qty']."</td>
                                <td>".$order['product_price']."</td>
                                <td>".$order['total_price']."</td>
                                </tr>"
                            ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Update User Info Form -->
<form class="container" action="user.php" method="POST" style="display:<?php echo $uF; ?> ;">
<div class="form-row" >
    <div class="form-group col-md-3">
    <label for="uname">update name</label> 
    <input type="text" id='uname' class="form-control" name="userName" placeholder="update name">
    </div>
    <div class="form-group col-md-3">
    <label for="uemail">update email</label>
    <input type="email" id='uemail' class="form-control" name="userEmail" placeholder="update email">
    </div> 
    <div class="form-group col-md-3 ">
    <label for="uphone">update phone</label>
    <input type="number" id='uphone' class="form-control" name="userPhone" placeholder="update phone">
    </div>
    <div class="form-group col-md-2 ">
    <label for="upass">userPass</label>
    <input type="password" id='upass' class="form-control" name="userPass" placeholder="update password">
    </div>
    <br>
    </div>
    <div class="col-md-2 offset-col-4">
    <button type="submit" class="btn btn-success" name="updateUserSubmit">Update</button>
    </div>
</form>
<!-- End Of Update User Info Form -->
                    </div>
                </div>
            </div>
        </div>