<?php 
    
    include 'commentfun.php';
    // require_once 'config/config.php';    
    require_once 'include/helpers.php';  
    date_default_timezone_set("Asia/Amman");


    if (empty($_SESSION['name'])) {
        header('location: login.php');
    }
        
        $userName=$_SESSION['name'];
        $product_id=$_SESSION['product_id'];
        $sql = "SELECT * FROM products WHERE `id`='$product_id';";

        $handle = $db->prepare($sql);
        $handle->execute();
        $product=$handle->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == 'add to cart')
    {
        $productID = intval($_POST['product_id']);
        $productQty = intval($_POST['product_qty']);    
        $sql = "SELECT * from products WHERE `id`='$productID';";
        $prepare = $db->prepare($sql);

        $prepare->execute();
        $fetchProduct = $prepare->fetch(PDO::FETCH_ASSOC);

        $calculateTotalPrice = number_format($productQty * $fetchProduct['price'],2);
        $product_name=$fetchProduct['pname'];
        $product_price=$fetchProduct['price'];
        $img=$fetchProduct['image'];
        $user_id=$_SESSION['id'];
        
        
        $cartArray = [
            'product_id' =>$productID,
            'qty' => $productQty,
            'product_name' =>$fetchProduct['pname'],
            'product_price' => $fetchProduct['price'],
            'total_price' => $calculateTotalPrice,
            'product_img' =>$fetchProduct['image']
        ];
        
        $sql2="INSERT INTO order_details (product_id,product_name,product_price,qty,total_price,product_image) VALUES ('$productID','$product_name','$product_price','$productQty','$calculateTotalPrice','$img');";

        $sql3="INSERT INTO user_orders (product_name,product_price,qty,total_price,user_idd) VALUES ('$product_name','$product_price','$productQty','$calculateTotalPrice','$user_id');";

        $prepare2 = $db->prepare($sql2);
        $prepare2->execute();

        $prepare3 = $db->prepare($sql3);
        $prepare3->execute();

        if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
        {
            $productIDs = [];
            foreach($_SESSION['cart_items'] as $cartKey => $cartItem)
            {
                $productIDs[] = $cartItem['product_id'];
                if($cartItem['product_id'] == $productID)
                {
                    $_SESSION['cart_items'][$cartKey]['qty'] = $productQty;
                    $_SESSION['cart_items'][$cartKey]['total_price'] = $calculateTotalPrice;
                    break;
                }
            }

            if(!in_array($productID,$productIDs))
            {
                $_SESSION['cart_items'][]= $cartArray;
            }

            $successMsg = true;
            
        }
        else
        {
            $_SESSION['cart_items'][]= $cartArray;
            $successMsg = true;
        }

    }


	$pageTitle = 'Cool T-Shirt Shop Single Product Page';
	$metaDesc = 'Demo PHP shopping cart get products from database';
	
	
include('include/header.php');

?>

    <?php 
    // if(isset($getProductData) && is_array($getProductData)){
    if(isset($product[0]) && is_array($product[0])){
        
        ?>
        <?php if(isset($successMsg) && $successMsg == true){?>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <img src="<?php echo $product[0]['image']; ?>" class="rounded img-thumbnail mr-2" style="width:40px;"><?php echo $product[0]['pname']?> is added to cart. <a href="cart.php" class="alert-link">View Cart</a>
                    </div>
                </div>
            </div>
         <?php }?>

        <div class="row mt-3">
            <div class="col-md-5">
                <img src="<?php echo $product[0]['image']; ?>">
            </div>
            <div class="col-md-7" style="margin-top: 1.5em;">
                <h1><?php echo $product[0]['pname']?></h1>
                <p><?php
                 echo $product[0]['description']
                 ?></p>
                <h4>$<?php echo $product[0]['price']?></h4>
                
                <form class="form-inline" method="POST">
                    <div class="form-group mb-2  ">
                        <input type="number" name="product_qty" id="productQty" class="form-control-md" placeholder="Quantity" min="1" max="1000" value="1">
                        <input type="hidden" name="product_id" value="<?php echo $product[0]['id']?>" style="">
                    </div>
                    <div class="form-group mb-2 ml-2">
                        <button type="submit" class="btn btn-secondary" name="add_to_cart" value="add to cart">Add to Cart</button>
                    </div>
                </form>
                
            </div>
        </div>


<!-- Comment -->

        <div class="row mt-3" >
            <div class="col-md-12">
                <?php 
                echo
                "<form  method='Post' action='".setComments($db)." ' style='margin-left: 2em;'>
                        <input type='hidden' name='userName' value='".$userName."'>
                        <input type='hidden' name='product_id' value='".$product[0]['id']."'>
                        <textarea name='msg'  cols='50' rows='5'></textarea><br>
                        <input type='submit' name='CommentSubmit' value='Comment'>
                </form>" ;
                
                GetComments($db);
                ?>
            </div>
        </div>

    <?php
    }
    ?>

<?php include('include/footer.php');?>