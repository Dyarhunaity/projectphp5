<?php
session_start();
require_once('config/config.php');
require_once('include/helpers.php');

$sql = "SELECT * from products p;";
// -- INNER JOIN product_images pdi ON pdi.product_id = p.id
// -- WHERE pdi.is_featured = 1";
$handle = $db->prepare($sql);
$handle->execute();
$getAllProducts = $handle->fetchAll(PDO::FETCH_ASSOC);

$sqlcat = "SELECT * from category ;";
$handle = $db->prepare($sqlcat);
$handle->execute();
$getAllCategory = $handle->fetchAll(PDO::FETCH_ASSOC);
$pageTitle = 'Cool T-Shirt Shop';
$metaDesc = 'Demo PHP shopping cart get products from database';

if (isset($_POST['singalProduct'])) {
    $_SESSION['product_id'] = $_POST['id_value'];
    header('location: product_detail3.php');
}


include('include/header.php');

?>
<div class="hr-theme-slash-2">
    <div class="hr-line"></div>
    <div class="hr-icon"><i class="fa-solid fa-couch"></i></div>
    <div class="hr-line"></div>
</div>
<br>
<div class="container">
    <div class="row">
        <!-- <div class="col-md-4 col-lg-4 col-xl-4"> -->
            <form action="main.php" method="POST" class="form-group">
                <button type="submit" name="all" class="btn btn-secondary form-control" style="width: auto;">all products</button>
                <button type="submit" name="sales" class="btn btn-secondary form-control" style="width: auto;">Sale Products</button></form>
            <?php foreach ($getAllCategory as $category) : ?>
                <?php echo '<form class="form-group" action="main.php" method="POST">
                    <input type="hidden" name="cname" value="' . $category['category_id'] . '">
               <button class="btn btn-secondary form-control" type="submit" name="category"> ' . $category['categoryname'] . ' products</button> </form>';
                ?>
            <?php endforeach ?>
        <!-- </div> -->
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- <div class="col-md-12 col-lg-12 col-xl-12"> -->
            <?php foreach ($getAllProducts as $product) : ?>
                <?php $imgUrl = $product['image']; ?>
                <?php
                if (isset($_POST['all'])) {
                    echo "<div class='col-md-4  mt-2'>
                <div class='card prodheigh'>
                     <a href='product_detail3.php?product=" . $product['id'] . "'>
                        <img class='card-img-top' src='" . $imgUrl . "' alt='" . $product['pname'] . "'>
                    </a>
                    <div class='card-body'>
                        <h4 class='card-title'>
                            <a href='product_detail3.php?product=" . $product['id'] . "'>
                                " . $product['pname'] . "
                            </a>
                            </h4>";
                    if ($product['sale'] == 1) {
                        echo "<span class='product_price'>JD" . $product['new_price'] . "</span>
                                <span class ='old-price' STYLE='text-decoration:line-through'>JD" . $product['price'] . "</span>";
                    } else {
                        echo "<span class='product_price'>JD" . $product['price'] . "</span>";
                    }
                    echo "<p class='card-text'>
                            <a href='product_detail3.php?product=" . $product['id'] . "' class='btn btn-secondary btn-sm'>
                                View
                            </a>
                        </p>
                    </div>
                </div>
            </div>";
                } elseif (isset($_POST['sales'])) {
                    echo "<div class='col-md-4  mt-2'>
                <div class='card prodheigh'>
                     <a href='product_detail3.php?product=" . $product['id'] . "'>
                        <img class='card-img-top' src='" . $imgUrl . "' alt='" . $product['pname'] . "'>
                    </a>
                    <div class='card-body'>
                        <h4 class='card-title'>
                            <a href='product_detail3.php?product=" . $product['id'] . "'>
                                " . $product['pname'] . "
                            </a>
                            </h4>";
                    if ($product['sale'] == 1) {
                        echo "<span class='product_price'>JD" . $product['new_price'] . "</span>
                                <span class ='old-price' STYLE='text-decoration:line-through'>JD" . $product['price'] . "</span>";
                    } else {
                        echo "<span class='product_price'>$" . $product['price'] . "</span>";
                    }
                    echo "<p class='card-text'>
                        <form action='main.php' method='POST' class='form'>
                        <input type='hidden' value='" . $product['id'] . "' name='id_value'>
                        <button type='submit' class='form=control btn bbtn-primary' name='singalProduct'>view</button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>";
                } elseif (isset($_POST['category'])) {
                    $cc = $_POST['cname'];
                    if ($product['category_id'] == $cc) {
                        echo "<div class='col-md-4  mt-2'>
                    <div class='card prodheigh'>
                         <a href='product_detail3.php?product=" . $product['id'] . "'>
                            <img class='card-img-top' src='" . $imgUrl . "' alt='" . $product['pname'] . "'>
                        </a>
                        <div class='card-body'>
                            <h4 class='card-title'>
                                <a href='product_detail3.php?product=" . $product['id'] . "'>
                                    " . $product['pname'] . "
                                </a>
                            </h4>";
                        if ($product['sale'] == 1) {
                            echo "<span class='product_price'>JD" . $product['new_price'] . "</span>
                                <span class ='old-price' STYLE='text-decoration:line-through'>JD" . $product['price'] . "</span>";
                        } else {
                            echo "<span class='product_price'>JD" . $product['price'] . "</span>";
                        }
                        echo "<p class='card-text'>
                            <form action='main.php' method='POST' class='form'>
                            <input type='hidden' value='" . $product['id'] . "' name='id_value'>
                            <button type='submit' class='form=control btn bbtn-secondary' name='singalProduct'>view</button>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>";
                    }
                }

                ?>

            <?php endforeach; ?>
        <!-- </div> -->
    </div>
</div>
<br>
<?php include('include/footer.php'); ?>