<?php 
    session_start();
    require_once('config/config.php');    
    require_once('include/helpers.php');  

    $sql = "SELECT * from products p";
                    // -- INNER JOIN product_images pdi ON pdi.product_id = p.id
                    // -- WHERE pdi.is_featured = 1";
    $handle = $db->prepare($sql);
    $handle->execute();
    $getAllProducts = $handle->fetchAll(PDO::FETCH_ASSOC);

    $pageTitle = 'Cool T-Shirt Shop';
	$metaDesc = 'Demo PHP shopping cart get products from database';

    if (isset($_POST['singalProduct'])) {
        $_SESSION['product_id']=$_POST['id_value'];
        header('location: single-product.php');
    }


    include('include/header.php');
    
?>
<br>
  
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 offset-md-4">
        <form action="main.php" method="POST" >
            <select name="category" class="form-control col-4" id="" style="height:7vh ; display: inline-block; ">
                <option value="all">all products</option>
                <option value="office">Office products</option>
                <option value="Bedroom">Bedroom Products</option>
                <option value="livingroom">Living Room Products</option>
            </select>
            <button class="btn btn-secondary " name="select" type="submit" style="margin-left: .75em;">Select</button>
        </form>
        </div>
        <br><br><br>
        <?php foreach($getAllProducts as $product): ?>
           <?php $imgUrl =$product['image']; ?>
            <?php
            if (isset($_POST['select'])) {

                switch ($_POST['category']) {
                    case 'all':
                        echo "<div class='col-md-4  mt-2'>
                <div class='card'>
                     <a href='single-product.php?product=".$product['id']."'>
                        <img class='card-img-top' src='".$imgUrl."' alt='".$product['pname']."'>
                    </a>
                    <div class='card-body'>
                        <h5 class='card-title'>
                            <a href='single-product.php?product=".$product['id']."'>
                                ".$product['pname']."
                            </a>
                            </h5>";
                            if ($product['sale']==1) {
                                echo "<span class='product_price'>$".$product['new_price']."</span>
                                <span class ='old-price' STYLE='text-decoration:line-through'>$".$product['price']."</span>";
                            }
                            else{
                                echo "<span class='product_price'>$".$product['price']."</span>";
       
                            }
                            echo "<p class='card-text'>
                            <a href='single-product.php?product=".$product['id']."' class='btn btn-primary btn-sm'>
                                View
                            </a>
                        </p>
                    </div>
                </div>
            </div>";
                        break;
                    case 'office':
                        if ($product['category_id'] == 1) {
                            echo "<div class='col-md-4  mt-2'>
                            <div class='card'>
                                 <a href='single-product.php?product=".$product['id']."'>
                                    <img class='card-img-top' src='".$imgUrl."' alt='".$product['pname']."'>
                                </a>
                                <div class='card-body'>
                                    <h5 class='card-title'>
                                        <a href='single-product.php?product=".$product['id']."'>
                                            ".$product['pname']."
                                        </a>
                                        </h5>";
                                        if ($product['sale']==1) {
                                            echo "<span class='product_price'>$".$product['new_price']."</span>
                                            <span class ='old-price' STYLE='text-decoration:line-through'>$".$product['price']."</span>";
                                        }
                                        else{
                                            echo "<span class='product_price'>$".$product['price']."</span>";
                   
                                        }
                                        echo "<p class='card-text'>
                                    <form action='main.php' method='POST' class='form'>
                                    <input type='hidden' value='".$product['id']."' name='id_value'>
                                    <button type='submit' class='form=control btn bbtn-primary' name='singalProduct'>view</button>
                                    </form>
                                    </p>
                                </div>
                            </div>
                        </div>";
                        }
                        break;

                    case 'Bedroom':
                        if ($product['category_id'] == 2) {
                            echo "<div class='col-md-4  mt-2'>
                            <div class='card'>
                                 <a href='single-product.php?product=".$product['id']."'>
                                    <img class='card-img-top' src='".$imgUrl."' alt='".$product['pname']."'>
                                </a>
                                <div class='card-body'>
                                    <h5 class='card-title'>
                                        <a href='single-product.php?product=".$product['id']."'>
                                            ".$product['pname']."
                                        </a>
                                        </h5>";
                                        if ($product['sale']==1) {
                                            echo "<span class='product_price'>$".$product['new_price']."</span>
                                            <span class ='old-price' STYLE='text-decoration:line-through'>$".$product['price']."</span>";
                                        }
                                        else{
                                            echo "<span class='product_price'>$".$product['price']."</span>";
                   
                                        }
                                        echo "<p class='card-text'>
                                    <form action='main.php' method='POST' class='form'>
                                    <input type='hidden' value='".$product['id']."' name='id_value'>
                                    <button type='submit' class='form=control btn bbtn-primary' name='singalProduct'>view</button>
                                    </form>
                                    </p>
                                </div>
                            </div>
                        </div>";
                        }
                        break;

                    case 'livingroom':
                        if ($product['category_id'] == 3) {
                            echo "<div class='col-md-4  mt-2'>
                            <div class='card'>
                                 <a href='single-product.php?product=".$product['id']."'>
                                    <img class='card-img-top' src='".$imgUrl."' alt='".$product['pname']."'>
                                </a>
                                <div class='card-body'>
                                    <h5 class='card-title'>
                                        <a href='single-product.php?product=".$product['id']."'>
                                            ".$product['pname']."
                                        </a>
                                    </h5>";
                                    if ($product['sale']==1) {
                                        echo "<span class='product_price'>$".$product['new_price']."</span>
                                        <span class ='old-price' STYLE='text-decoration:line-through'>$".$product['price']."</span>";
                                    }
                                    else{
                                        echo "<span class='product_price'>$".$product['price']."</span>";
               
                                    }
                                    echo "<p class='card-text'>
                                    <form action='main.php' method='POST' class='form'>
                                    <input type='hidden' value='".$product['id']."' name='id_value'>
                                    <button type='submit' class='form=control btn bbtn-primary' name='singalProduct'>view</button>
                                    </form>
                                    </p>
                                </div>
                            </div>
                        </div>";
                        }
                        break;

                    default:
                        # code...
                        break;
                }
            }
            else{
                echo "<div class='col-md-4  mt-2'>
                <div class='card'>
                     <a href='single-product.php?product=".$product['id']."'>
                        <img class='card-img-top' src='".$imgUrl."' alt='".$product['pname']."'>
                    </a>
                    <div class='card-body'>
                        <h5 class='card-title'>
                            <a href='single-product.php?product=".$product['id']."'>
                                ".$product['pname']."
                            </a>
                        </h5>";
                        if ($product['sale']==1) {
                            echo "<span class='product_price'>$".$product['new_price']."</span>
                            <span class ='old-price' STYLE='text-decoration:line-through'>$".$product['price']."</span>";
                        }
                        else{
                            echo "<span class='product_price'>$".$product['price']."</span>";
   
                        }
                        echo "
                        <p class='card-text'>
                            <form action='main.php' method='POST' class='form'>
                            <input type='hidden' value='".$product['id']."' name='id_value'>
                            <button type='submit' class='form=control btn bbtn-primary' name='singalProduct'>view</button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>";
            // echo  $product['id'];               
            }
            // $imgUrl = PRODUCT_IMG_URL.str_replace(' ','-',strtolower($product['pname']))."/".$product['image'];
            
        ?>
            
        <?php endforeach; ?>
    </div>
    <br>
<?php include('include/footer.php');?>

