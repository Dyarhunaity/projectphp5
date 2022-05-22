<?php
include 'config/connect.php';

if(isset($_POST["submit_img"])){
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];
    $file_tem = $_FILES["file"]["tmp_name"];
    $file_store = "images/".$file_name;
    // echo $file_store;
    move_uploaded_file($file_tem, $file_store);
}


//call the user information from database
$users=mysqli_fetch_all(mysqli_query($conn,'select * from users'),MYSQLI_ASSOC);

// call the products informations from database
$products=mysqli_fetch_all(mysqli_query($conn,'select * from products'),MYSQLI_ASSOC);

// call the sales informations from database
$sales=mysqli_fetch_all(mysqli_query($conn,'select * from sales'),MYSQLI_ASSOC);

// call the category informations from database
$category=mysqli_fetch_all(mysqli_query($conn,'select * from category'),MYSQLI_ASSOC);


// Form Display Default state
$uF=$uaF=$pF=$paF=$cF=$caF="none";
$uUF= $pUF="";

/////////////////////////Delete Functions///////////////////////////

// Delete user function
if (isset($_POST['deleteUserSub'])) {
    $duser=$_POST['deleteUser'];
    $updateat=date('d-m-Y');
    $sql="UPDATE users
          SET delet=1, updated_at='$updateat'
          WHERE id=$duser;";
    mysqli_query($conn,$sql);
}

// Delete product function
if (isset($_POST['deleteProductSub'])) {
    $dproduct=$_POST['deleteProduct'];
    $updateat=date('d-m-Y');
    $sql="UPDATE products
          SET delet=1,updated_at='$updateat'
          WHERE id=$dproduct;";
    mysqli_query($conn,$sql);
}

// Delete Category function
if (isset($_POST['deleteCatSub'])) {
    $dcat=$_POST['deleteCat'];
    $updateat=date('d-m-Y');
    $sql="UPDATE category
          SET delet=1,updated_at='$updateat'
          WHERE id=$dcat;";
    mysqli_query($conn,$sql);
}

//////////////////////////End Of Delete Functions///////////////////

/////////////////////////Update Functions///////////////////////////

// update user Function
if (isset($_POST['updateUserSub'])) {
    $uF="block";
    $userToUpdate=$_POST['updateUser'];
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


// update product Function
if (isset($_POST['updateProductSub'])) {
    $pF="block";
    $productToUpdate=$_POST['updateProduct'];
    $sql="UPDATE products
    SET updat=1
    WHERE id=$productToUpdate;";
    mysqli_query($conn,$sql);
    // return $userToUpdate;
}
if (isset($_POST['productUpdatesubmit'])) 
{
        $newName=$_POST['productName'];
        $newCategory=$_POST['category_id'];
        $newImage=$_POST['productImage'];
        $newPrice=$_POST['productPrice'];
        $newQuantity=$_POST['productQuantity'];
        $updateat=date('d-m-Y'); 

$sql="UPDATE products SET pname='$newName',categoryname='$newCategory',image='$newImage',price='$newPrice',quantity='$newQuantity',updated_at='$updateat',updat=0 WHERE updat=1;";
mysqli_query($conn,$sql);
}


// update category Function
if (isset($_POST['updateCatSub'])) {
    $cF="block";
    $catToUpdate=$_POST['updateCat'];
    $sql="UPDATE category
    SET updat=1
    WHERE id=$catToUpdate;";
    mysqli_query($conn,$sql);
}
if (isset($_POST['updateCatSubmit'])) 
{
        $newName=$_POST['catName'];
        $updateat=date('d-m-Y');

$sql="UPDATE category SET categoryname='$newName',updated_at='$updateat',updat=0 WHERE updat=1;";
mysqli_query($conn,$sql);
}
///////////////////////End Of Update Functions//////////////////////
////////////////////////////////////////////////////////////////////
///////////////////////Add Functions////////////////////////////////
// user add functions
if (isset($_POST['addUserSub'])) {
    $uaF="block";
}
if (isset($_POST['addUserSubmit'])) {
    $newName=$_POST['userAddName'];
    $newEmail=$_POST['userAddEmail'];
    $newPhone=$_POST['userAddPhone'];
    $newPass=$_POST['userAddPass'];
    $creatat=date('d-m-Y');
    $updateat=date('d-m-Y');

$sql="INSERT INTO users (fname,email,phone,Pass,created_at,updated_at) VALUES ('$newName','$newEmail','$newPhone','$newPass','$creatat','$updateat';";
mysqli_query($conn,$sql);
}

// product add functions
if (isset($_POST['addProductSub'])) {
    $paF="block";
    $baF="none";
}
if (isset($_POST['addProductSubmit'])) {

    $newName=$_POST['productAddName'];
    $newCategory=$_POST['productAddCategory'];
    $newImage=$_POST['productAddImage'];
    $newPrice=$_POST['productAddPrice'];
    $newQuantity=$_POST['productAddQuantity'];
    $creatat=date('d-m-Y');
    $updateat=date('d-m-Y');

$sql="INSERT INTO products (pname,image,categoryname,price,quantity,created_at,updated_at) VALUES ('$newName','$newImage','$newCategory','$newPrice','$newQuantity','$creatat','$updateat';";
mysqli_query($conn,$sql);
}

// Category add functions
if (isset($_POST['addCatSub'])) {
    $caF="block";
}
if (isset($_POST['addCatSubmit'])) {
    $newName=$_POST['catAddName'];
    // $creatat=date('d-m-Y');
    // $updateat=date('d-m-Y');
$sql="INSERT INTO category (categoryname) VALUES ('$newName');";
mysqli_query($conn,$sql);
echo $newName;
}


//////////////////////End Of Add Functions/////////////////////////








include 'include/header.php';
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////USERS////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Users Information Table -->

<form action="admin.php" method="POST">
<h1>Users Information</h1>
<button class="btn bg-secondary" type="submit" name="addUserSub">Add User</button>
</form>
<br>
<table class="table" >
    <tr class='bg-active' style="background-color:pink;">
        <td>ID</td>
        <td>Name</td>
        <td>E-mail</td>
        <td>Phone</td>
        <td>Password</td>
        <td>Created at</td>
        <td>Updated at</td>
        <td>Update</td>
        <td>Delete</td>
    </tr>
        
        <?php foreach($users as $user): ?>

        <?php
        // Delete user condition
        if ($user['delet'] == 1) {
            continue;
        }
        else {
        // Print user information
        echo "<tr>
        <td>".$user['id']."</td>
        <td>".$user['fname']."</td>
        <td>".$user['email']."</td>
        <td>".$user['phone']."</td>
        <td>".$user['pass']."</td>
        <td>".$user['created_at']."</td>
        <td>".$user['updated_at']."</td>
        <td><form action='admin.php' method='POST'>
            <input type='hidden' name='updateUser' value='".$user['id']."'>
            <button type='submit' name='updateUserSub'>Update</button>
            </form>
        </td>
        <td><form action='admin.php' method='POST'>
            <input type='hidden' name='deleteUser' value='".$user['id']."'>
            <button type='submit' name='deleteUserSub'>Delete</button>
            </form>
        </td></tr>";
        }
        ?>
        <?php endforeach; ?>
    
</table>
<!-- End Of Users Information Table -->


<br><br>

<!-- Update User Info Form -->
<form class="container" action="admin.php" method="POST" style="display:<?php echo $uF; ?> ;">
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


<!-- ADD User Form -->
<form class="container" action="admin.php" method="POST" style="display:<?php echo $uaF; ?> ;">
<div class="form-row" >
    <div class="form-group col-md-3">
    <label for="addName">Name</label> 
    <input type="text" id='addName' class="form-control" name="userAddName" placeholder="Name">
    </div>
    <div class="form-group col-md-3">
    <label for="addEmail">E-mail</label>
    <input type="email" id='addEmail' class="form-control" name="userAddEmail" placeholder="test@test.com">
    </div> 
    <div class="form-group col-md-3 ">
    <label for="addPhone">Phone</label>
    <input type="number" id='addPhone' class="form-control" name="userAddPhone" placeholder="#########">
    </div>
    <div class="form-group col-md-2 ">
    <label for="addPass">user Password</label>
    <input type="password" id='addPass' class="form-control" name="userAddPass" placeholder="***********">
    </div>
    <br>
    </div>
    <div class="col-md-2 offset-col-4">
    <button type="submit" class="btn btn-success" name="addUserSubmit">Add user</button>
    </div>
</form>
<!-- End Of Add User Form -->

<br><br>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////Products////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- add product button -->
<form action="admin.php" method="POST">
<h1>Products Information</h1>
<button class="btn bg-secondary" type="submit" name="addProductSub" style="display:<?php echo $baF; ?> ;">Add Product</button>
</form>

<!-- Add Product Form -->
<form action="admin.php" method="POST" class="container" style="display:<?php echo $paF; ?> ;">
<div class="form-row">
    <div class="form-group col-md-2">
    <label for="paname">product Name</label>
    <input type="text" id='paname' name="productAddName" placeholder="name">
    </div>
    <div class="form-group col-md-2">
    <label for="paCate">Product Category</label>
    <input type="text" id='paCate' name="productAddCategory" placeholder="Category">
    </div>
    <!-- <div class="form-group col-md-3 ">
    <label for="paimg">Product Image</label> -->
    <input type="hidden" id='paimg' name="productAddImage" placeholder="Image" value="<?php $file_store ?>">
    <!-- </div> -->
    <div class="form-group col-md-2 ">
    <label for="paprice">Product Price</label>
    <input type="text" id='paprice' name="productAddPrice" placeholder="Price">
    </div>
    <div class="form-group col-md-2 ">
    <label for="paquantity">Product Quantity</label>
    <input type="text" id='paquantity' name="productAddQuantity" placeholder="Quantity">
    </div>
    
    <div class="form-group col-md-2 ">
        <p>f</p>
    <button type="submit" class="btn btn-primary" name="addProductSubmit">Add</button>
    </div>
    </div>
</form>
<form action="?" method="POST" enctype="multipart/form-data" style="display:<?php echo $paF; ?> ;">
        <input type="file" name="file" id="file">
        <input type="submit" name="submit_img" value="submit">
</form>

<!-- End Of Add Product Form -->
<br><br>


<!-- End Of add product button -->

<!-- Products Information Table -->
<table class="table">
    <tr class='bg-warning'>
        <td>Id</td>
        <td>Product name</td>
        <td>Image</td>
        <td>Category name</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Created at</td>
        <td>Updated at</td>
        <td>Update</td>
        <td>Delete</td>
    </tr>
    
        <?php foreach($products as $product): ?>
        <?php
        // Delete product condition
        if ($product['delet'] == 1) {
            continue;
        }
        else {
        // Print product information
        echo "<tr >
        <td>".$product['id']."</td>
        <td>".$product['pname']."</td>
        <td><img src='".$product['image']."' style='width:25px;height:25px' alt='dining table'></td>
        <td>".$product['category_id']."</td>
        <td>".$product['price']."</td>
        <td>".$product['quantity']."</td>
        <td>".$product['created_at']."</td>
        <td>".$product['updated_at']."</td>
        <td><form action='admin.php' method='POST'>
            <input type='hidden' name='updateProduct' value='".$product['id']."'>
            <button type='submit' name='updateProductSub'>Update</button>
            </form>
        </td>
        <td><form action='admin.php' method='POST'>
            <input type='hidden' name='deleteProduct' value='".$product['id']."'>
            <button type='submit' name='deleteProductSub'>Delete</button>
            </form>
        </td></tr>";
        }
        ?>
        <?php endforeach; ?>
</table>
<!-- End Of Products Information Table -->

<br><br>

<!-- Update Product Info Form -->
<form action="admin.php" method="POST" class="container" style="display:<?php echo $pF; ?> ;">
<div class="form-row">
    <div class="form-group col-md-2">
    <label for="pname">productName</label>
    <input type="text" id='pname' name="productName" placeholder="update name">
    </div>
    <div class="form-group col-md-2">
    <label for="pCate">productCategory</label>
    <input type="text" id='pCate' name="productCategory" placeholder="update Category">
    </div>
    <div class="form-group col-md-2 ">
    <label for="pimg">productImage</label>
    <input type="text" id='pimg' name="productImage" placeholder="update Image">
    </div>
    <div class="form-group col-md-2 ">
    <label for="pprice">productPrice</label>
    <input type="text" id='pprice' name="productPrice" placeholder="update Price">
    </div>
    <div class="form-group col-md-2 ">
    <label for="pquantity">productQuantity</label>
    <input type="text" id='pquantity' name="productQuantity" placeholder="update Quantity">
    </div>
    </div>

    <button type="submit" class="btn btn-primary" name="productUpdatesubmit">Update</button>
</form>
<!-- End Of Update Product Info Form -->



<!-- /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////Categories////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- categories Information Table -->
<form action="admin.php" method="POST">
<h1>Categories Information</h1>
<button class="btn bg-secondary" type="submit" name="addCatSub">Add Category</button>
</form>
<br>
<table class="table" >
    <tr class='' style='background-color:pink;'>
        <th>ID</th>
        <th>Category Name</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
        
        <?php foreach($category as $cat): ?>

        <?php
        // Delete cat condition
        if ($cat['delet'] == 1) {
            continue;
        }
        else {
        // Print category information
        echo "<tr class='bg-active' >
        <td>".$cat['category_id']."</td>
        <td>".$cat['categoryname']."</td>
        <td>".$cat['created_at']."</td>
        <td>".$cat['updated_at']."</td>
        <td><form action='admin.php' method='POST'>
            <input type='hidden' name='updateCat' value='".$cat['category_id']."'>
            <button type='submit' name='updateCatSub'>Update</button>
            </form>
        </td>
        <td><form action='admin.php' method='POST'>
            <input type='hidden' name='deleteCat' value='".$cat['category_id']."'>
            <button type='submit' name='deleteCatSub'>Delete</button>
            </form>
        </td></tr>";
        }
        ?>
        <?php endforeach; ?>
    
</table>
<!-- End Of categories Information Table -->


<br><br>

<!-- Update Categories Info Form -->
<form class="container" action="admin.php" method="POST" style="display:<?php echo $cF; ?> ;">
<div class="form-row" >
    <div class="form-group col-md-3">
    <label for="cName">Category name</label> 
    <input type="text" id='cName' class="form-control" name="catName" placeholder="Name">
    </div>
    <br>
    </div>
    <div class="col-md-2 offset-col-4">
    <button type="submit" class="btn btn-success" name="updateCatSubmit">Update</button>
    </div>
</form>
<!-- End Of Update Categories Info Form -->


<!-- ADD Category Form -->
<form class="container" action="admin.php" method="POST" style="display:<?php echo $caF; ?> ;">
<div class="form-row" >
    <div class="form-group col-md-3">
    <label for="addCatName">Category Name</label> 
    <input type="text" id='addCatName' class="form-control" name="catAddName" placeholder="Name">
    </div>
    <br>
</div>
    <div class="col-md-2 offset-col-4">
    <button type="submit" class="btn btn-success" name="addCatSubmit">Add</button>
    </div>
</form>
<!-- End Of Add Category Form -->

<br><br>

<!-- Start of Sales table -->
<h1>Sales Information</h1>
<table class="table">
    <tr class='bg-success'>
        <th>order Id</th>
        <th>Product name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>

    </tr>
    
        <?php foreach($sales as $sale): ?>
        <?php

        // Print sale information
        echo "<tr class='bg-light'>
        <td>".$sale['order_id']."</td>
        <td>".$sale['product_name']."</td>
        <td><img src='".$sale['product_image']."' style='width:25px;height:25px' alt='dining table'></td>
        <td>".$sale['product_price']."</td>
        <td>".$sale['qty']."</td>
        <td>".$sale['total_price']."</tr>";
        ?>
        <?php endforeach; ?>
</table>
<!-- End of Sales table -->