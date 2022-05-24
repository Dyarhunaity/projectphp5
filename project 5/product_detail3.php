<?php 
    
    include 'commentfun.php';
    // require_once 'config/config.php';    
    require_once 'include/helpers.php';  
    date_default_timezone_set("Asia/Amman");
    $product_id=$_SESSION['product_id'];
    // print_r($product_id);

    if (empty($_SESSION['name'])) {
        header('location: login.php');
    }
        
        $userName=$_SESSION['name'];
        
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
<?php if(isset($product[0]) && is_array($product[0])){?>
            <div class="layout_padding-2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="img_box">
                                <figure><img src="<?php echo $product[0]['image']; ?>" alt="product" /></figure>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 product_detail_side">
                            <div class="abotext_box">
                                <div class="product-heading">
                                    <h2><?php echo $product[0]['pname'];?></h2>
                                </div>
                                <div class="product-detail-side">
                                    <?php if ($product[0]['sale']==1) {echo"
                                    <span><del>".$product[0]['price']."</del></span><span class='new-price'>".$product[0]['new_price']."</span>";
                                    }
                                    else{
                                        echo "</span><span class='new-price'>".$product[0]['price']."</span>";
                                    }
                                    ?>
                                    <span class="rating">
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star-o" aria-hidden="true"></i>
                     </span>
                                    <span class="review">(5 customer review)</span>
                                </div>
                                <div class="detail-contant">
                                    <p><?php echo $product[0]['description']; ?>
                                        <br><span class="stock"><?php echo $product[0]['quantity']; ?> in stock</span>
                                    </p>
                                    <form class="form-inline" method="POST">
                    <div class="form-group mb-2  ">
                        <input type="number" name="product_qty" id="productQty" class="form-control-md" placeholder="Quantity" min="1" max="1000" value="1">
                        <input type="hidden" name="product_id" value="<?php echo $product[0]['id'];?>" style="">
                    </div>
                    <div class="form-group mb-2 ml-2">
                        <button type="submit" class="btn btn-secondary" name="add_to_cart" value="add to cart">Add to Cart</button>
                    </div>
                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="full">
                                <div class="tab_bar_section">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#description">Description</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#reviews">Reviews (2)</a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="description" class="tab-pane active">
                                            <div class="product_desc">
                                                <p><?php echo $product[0]['description']; ?></p>
                                            </div>
                                        </div>
                                        <div id="reviews" class="tab-pane fade">
                                            <div class="product_review">
                                                <h3>Reviews</h3>
                                                <?php foreach($row as $com): ?>
                                                <?php if ($com['product_id']==$product_id): ?>
                                                <div class="commant-text row">
                                                    <div class="col-lg-2 col-md-2 col-sm-4">
                                                        <div class="profile">
                                                        <i class='fa-solid fa-user'></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                                        <h5><?php echo $com['user_name']; ?></h5>
                                                        <p><span class="c_date"><?php echo $com['comment_date']; ?></span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                                        <span class="rating">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star-o" aria-hidden="true"></i>
                                 </span>
                                                        <p class="msg"><?php echo $com['comment_text']; ?></p>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                                    <div class="col-sm-12">
                                                        <div class="full review_bt_section">
                                                            <div class="float-right">

                                                                <a class="bt_main" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Leave a Review</a>

                                                            </div>
                                                        </div>

                                                        <div class="full">

                                                            <div id="collapseExample" class="full collapse commant_box">
                                                                <form accept-charset="UTF-8" action="<?php echo setComments($db); ?>" method="POST">
                                                                <input type='hidden' name='userName' value='<?php echo $userName; ?>'>
                                                                <input type='hidden' name='product_id' value='<?php echo $product_id; ?>'>
                                                                    <textarea class="form-control animated" cols="50" id="new-review" name="msg" placeholder="Enter your review here..." required=""></textarea>
                                                                    <div class="full_bt center">
                                                                        <button class="bt_main" type="submit" name="CommentSubmit">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
}
?>

<?php include 'include/footer.php'; ?>