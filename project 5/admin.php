<?php
include 'config/connect.php';

//call the user information from database
$users=mysqli_fetch_all(mysqli_query($conn,'select * from users'),MYSQLI_ASSOC);

// call the products informations from database
$products=mysqli_fetch_all(mysqli_query($conn,'select * from products'),MYSQLI_ASSOC);

// call the sales informations from database
$sales=mysqli_fetch_all(mysqli_query($conn,'select * from sales'),MYSQLI_ASSOC);

// call the category informations from database
$category=mysqli_fetch_all(mysqli_query($conn,'select * from category'),MYSQLI_ASSOC);

// call the category ID from database
// $category_ID=mysqli_fetch_column((mysqli_result $category, int $column = 0));
// print_r($category_ID);


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

$sql="INSERT INTO users (fname,email,phone,Pass,created_at,updated_at) VALUES ('$newName','$newEmail','$newPhone','$newPass','$creatat','$updateat');";
mysqli_query($conn,$sql);
}

// product add functions
if (isset($_POST['addProductSub'])) {
    $paF="block";
    $baF="none";
}
if (isset($_POST['addProductSubmit'])) {
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];
    $file_tem = $_FILES["file"]["tmp_name"];
    $file_store = "images/".$file_name;
    move_uploaded_file($file_tem, $file_store);
    $newName=$_POST['productAddName'];
    $newCategory=$_POST['productAddCategory'];
    $newPrice=$_POST['productAddPrice'];
    $newQuantity=$_POST['productAddQuantity'];
     echo $newName.$newCategory.$newPrice.$newQuantity;
$sqla="INSERT INTO `products` (pname,category_id,image,price,quantity) VALUES ('$newName','$newCategory','$file_store','$newPrice','$newQuantity');";
mysqli_query($conn,$sqla);
}

// Category add functions
if (isset($_POST['addCatSub'])) {
    $caF="block";
}
if (isset($_POST['addCatSubmit'])) {
    $newName=$_POST['catAddName'];
$sql="INSERT INTO category (categoryname) VALUES ('$newName');";
mysqli_query($conn,$sql);
echo $newName;
}


//////////////////////End Of Add Functions/////////////////////////
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

</head>
<!-- body -->

<body class="main-layout ">

    <!-- loader  -->
    <!-- <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div> -->
    <!-- end loader -->

    <div class="wrapper ">


 
        <div id="content">
            <!-- header -->
            <header>
                <!-- header inner -->
                <div class="header header-bg">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-3 logo_section">
                                <div class="full">
                                    <div class="center-desk">
                                        <div class="logo">
                                            <a href="index.php"><img src="images/logo.png" alt="#"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="right_header_info">
                                    <ul>
                                        <li style="display:<?php echo $uss; ?> ;"><a href="index.php"><i class="fa-solid fa-person-walking-arrow-right fa-lg basket-icon"></i></i></a>
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



<!-- ///////////////////////////////////////////////// -->
<!-- ////////////////////chooose table function//////////////// -->
<!-- //////////////////////////////////////////////// -->

<div class="col-md-12 col-lg-12 col-xl-12 offset-md-3">
    <form action="admin.php" method="POST" >
        <select name="tables" class="form-control col-4" id="" style="height:10vh ; display: inline-block; ">
            <option value="usersTable">Users Table</option>
            <option value="productsTable">Products Table</option>
            <option value="categoriesTable">Categories Table</option>
            <option value="salesTable">Sales Table</option>
        </select>
        <button class="btn btn-success " name="select" type="submit" style="margin-left: .75em;">Select</button>
    </form>
</div>


<?php 

// tables display 
$ctF=$utF=$ptF=$stF="none";
if (isset($_POST['select'])) {
switch ($_POST['tables']) {
    case 'usersTable':
        $utF="block";
        break;
    
    case 'productsTable':
        $ptF="block";
        break;
    
    case 'categoriesTable':
            $ctF="block";
        break;

    case 'salesTable':
            $stF="block";
        break;
                        
    default:
    $ctF=$utF=$ptF=$stF="none";
        break;
}
}
?>



<!-- /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////USERS////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<!-- add user button -->
<div class="container row">
<div class="col-3 offset-3">
<form action="admin.php" method="POST" >
<button class="btn bg-info" type="submit" name="addUserSub">Add User</button>
</form>
</div>


<!-- add product button -->
<div class="col-3">
<form action="admin.php" method="POST">
<button class="btn bg-info" type="submit" name="addProductSub">Add Product</button>
</form>
</div>
<!-- add category button -->
<div class="col-3">
<form action="admin.php" method="POST" >
<button class="btn bg-info" type="submit" name="addCatSub">Add Category</button>
</form>
</div>
</div>
<br>


<!-- Users Information Table -->
<div class="container">
<table class="table" style="display:<?php echo $utF; ?> ;">
<h1 style="display:<?php echo $utF; ?> ;">Users Information</h1>
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
</div>
<!-- End Of Users Information Table -->


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


<!-- /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////Products////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<!-- Add Product Form -->
<form action="admin.php" method="POST" class="container" enctype="multipart/form-data" style="display:<?php echo $paF; ?> ;">
<div class="form-row">
    <div class="form-group col-md-2">
    <label for="paname">product Name</label>
    <input type="text" id='paname' name="productAddName" placeholder="name">
    </div>
    <div class="form-group col-md-3 ">
    <label for="paimg">Product Image</label>
    <input type="file" name="file" id="file">
    </div>
    <div class="form-group col-md-2 ">
    <label for="paprice">Product Price</label>
    <input type="text" id='paprice' name="productAddPrice" placeholder="Price">
    </div>
    <div class="form-group col-md-2 ">
    <label for="paquantity">Product Quantity</label>
    <input type="text" id='paquantity' name="productAddQuantity" placeholder="Quantity">
    </div>
    <div class="form-group col-md-2">
    <label for="paCate">Product Category</label>
    <select id='paCate' name="productAddCategory">
    <?php foreach($category as $key => $name): ?>
    <option value="<?php echo $name['category_id']; ?>"><?php echo $name['categoryname'];?></option>
    <?php endforeach; ?>
    </select>
    </div>
    
    <div class="form-group col-md-2 ">
    <button type="submit" class="btn btn-success" name="addProductSubmit">Add</button>
    </div>
    </div>
</form>
<!-- End Of Add Product Form -->



<!-- End Of add product button -->

<!-- Products Information Table -->
<div class="container">
<table class="table" style="display:<?php echo $ptF; ?> ;">
<h1 style="display:<?php echo $ptF; ?> ;">Products Information</h1>
    <tr class='' style="background-color:pink;">
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
    
        <?php foreach(array_reverse($products) as $product): ?>
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
</div>
<!-- End Of Products Information Table -->


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

    <button type="submit" class="btn btn-info" name="productUpdatesubmit">Update</button>
</form>
<!-- End Of Update Product Info Form -->



<!-- /////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////Categories////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- categories Information Table -->
<div class="container">
<table class="table" style="display:<?php echo $ctF; ?> ;">
<h1 style="display:<?php echo $ctF; ?> ;">Categories Information</h1>
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
</div>
<!-- End Of categories Information Table -->



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
    <button type="submit" class="btn btn-primary" name="updateCatSubmit">Update</button>
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


<!-- Start of Sales table -->
<div class="container">
<table class="table" style="display:<?php echo $stF; ?> ;">
    <h1 style="display:<?php echo $stF; ?> ;">Sales Information</h1>
    <tr style="background-color:pink;">
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
</div>
<!-- End of Sales table -->