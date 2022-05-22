<?php include 'config/connect.php';
session_start();
include 'include/header.php'; ?>

<section class="slider_section">
    <div class="banner_main header-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mapimg">
                    <div class="text-bg text-h1">
                        <h1>The latest <br> <strong class="black_bold ">furniture Design</strong><br></h1>
                        <a href="#">Shop Now <i class='fa fa-angle-right'></i></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="text-img">
                        <figure><img src="images/he.png" id="headerimg" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<!-- end header -->
<!--start slide show-->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="./images/sliderphoto/livingslide.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./images/sliderphoto/officeslide.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./images/sliderphoto/bedslide.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- end slideshow -->
<!-- trending -->
<div class="trending">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="title">
                    <h2> <strong class="black catego-h2">Categories</strong></h2>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 margitop">
                <div class="trending-box">
                    <figure><img src="images/office-cate/office-cat.png" /></figure>
                    <h3><a href="main.php">Offices</a> </h3>

                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="trending-box">
                    <figure><img src="images/living-cate/living.png" /></figure>
                    <h3><a href="main.php">Living Room</a></h3>

                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 margitop">
                <div class="trending-box">
                    <figure><img src="images/bedroom-cate/bedroom.png" /></figure>
                    <h3><a href="main.php">Bedroom</a></h3>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- end trending -->

<!-- discount -->
<div class="container">
    <!-- <div id="myCarousel" class="carousel slide banner_Client" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>  -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="carousel-caption text carsol">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <div class="img_bg">
                                <h3 id="">50% DISCOUNT<br> <strong class="black_nolmal">the latest collection</strong></h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="img_bg">
                                <figure><img src="https://i.gifer.com/HZ4J.gif" /></figure>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- <<div class="carousel-item">
                            <div class="container">
                                <div class="carousel-caption text  carsol">
                                    <div class="row">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                                            <div class="img_bg">
                                                <h3>50% DISCOUNT<br> <strong class="black_nolmal">the latest collection</strong></h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                            <div class="img_bg">
                                                <figure><img src="https://static.dezeen.com/uploads/2020/06/jak-studio-sofa-working-pod-design_dezeen_2364_hero-2.gif" /></figure>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> -->
        <!-- <div class="carousel-item">
                            <div class="container">
                                <div class="carousel-caption text  carsol">
                                    <div class="row">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                                            <div class="img_bg">
                                                <h3>50% DISCOUNT<br> <strong class="black_nolmal">the latest collection</strong></h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                            <div class="img_bg">
                                                <figure><img src="images/discount.jpg" /></figure>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> -->
    </div>
    <!-- </div> -->
</div>
<br><br>

<!-- end discount -->

<!-- 
<div class="card mb-3">
  <img src="https://i.gifer.com/HZ4J.gif" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">50% DISCOUNT</h5>
    <p class="card-text">the latest collection</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
</div> -->
<!-- footer -->
<?php include 'include/footer.php'; ?>