
<footer>
                <div class="footer">
                    <div class="container-fluid">
                        <div class="border1">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">

                                    <img class="logo1" src="images/footrlogo.png" />
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                    <ul class="lik">
                                        <li> <a href="index.php">Home</a></li>
                                        <li> <a href="about.php">About</a></li>
                                        <li> <a href="product.php">Product</a></li>
                                        <li> <a href="blog.php">Blog</a></li>
                                        <li> <a href="contact.php">Contact us</a></li>
                                    </ul>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <ul class="sociel">
                                        <li> <a href="https://web.facebook.com/dyar.hunaity.1?_rdc=1&_rdr"><i class="fa fa-facebook-f"></i></a></li>
                                        <li> <a href="https://twitter.com/obadaAlshafie"><i class="fa fa-twitter"></i></a></li>
                                        <li> <a href="https://www.instagram.com/marwa.nseerat98/?hl=en"><i class="fa fa-instagram"></i></a></li>
                                        <li> <a href="https://www.linkedin.com/in/anas-al-lawafeh-b05954232/"><i class="fa fa-linkedin"></i></a></li>
                                        <li> <a href="https://github.com/Dua-Alsafasfeh"><i class="fa-brands fa-github"></i></a></li>
                                        
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <div class="new">
                                    <h3>Newsletter</h3>
                                    <form class="newtetter">
                                        <input class="tetter" placeholder="Your email" type="text" name="Your email">
                                        <button class="submit">Subscribe</button>
                                    </form>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="newtt">
                                    <p class="footer-p">Discover affordable furniture and home furnishing inspiration for all sizes of wallets and homes.
                                        <br> </p>
                                </div>
                            </div>
                        </div>

                    </div>
                  
                    <div class="copyright">
                        <p>Copyright 2022 All Right Reserved  <a href="https://html.design/"></a></p>
                    </div>
            
             </div>

            </footer>
            <!-- end footer -->
        </div>

    </div>

    <div class="overlay"></div>

    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function() {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

        });
    </script>
    <script>
      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: 40.645037, lng: -73.880224},
          });

      var image = 'images/maps-and-flags.png';
      var beachMarker = new google.maps.Marker({
          position: {lat: 40.645037, lng: -73.880224},
          map: map,
          icon: image
        });
      }
    </script>
    <!-- google map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
    <!-- end google map js --> 
    
</body>

</html>