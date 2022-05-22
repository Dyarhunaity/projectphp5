<?php
 include 'config/connect.php'; 


//switch page 


// Register Validation function


      // regular expressions
      $pwd_expression = "/(^[A-Z])(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/";
      $ps_regex="/^[A-Z](?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";
      $letters = "/(^[A-Z][a-z]+)(\s)([A-Z][a-z]+)(\s)([A-Z][a-z]+)(\s)([A-Z][a-z]+)/";
      $filter = "/([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
      $pfilter= "/[0-9]{14}/";
      $newLetters="/(^[A-Z][a-z]+)/";

      $fn= $ln= $em= $ad= $ps= $cps= $tl= $bd= $lp = $le ="none";

      // define variables and set to empty values
      $fnErr = $lnErr = $emailErr = $telErr = $adErr = $passwordErr = $cpasswordErr =  $dateErr = $lpErr = $leErr = "";

      // validation function

      if (isset($_POST["signup"]))
        {
          echo 'taken';
            $bdate=$_POST["date"];
            $ndate= date("Y-m-d");
            $diff = date_diff(date_create($bdate), date_create($ndate));


            // for first name check
            if (empty($_POST["fName"]))
            {

                $fnErr="please insert your first name ";
                $fn="block";

            }
            else if (!preg_match($newLetters, $_POST["fName"])) 
            {
              
                $fnErr="the name should be like this: Joe";
                $fn="block";
            }

            // for last name check
            else if (empty($_POST["lName"]))
            {

                $lnErr="please insert your last name ";
                $ln="block";

            }
            else if (!preg_match($newLetters, $_POST["lName"])) 
            {
                $lnErr="the name should be like this: Joe";
                $ln="block";
            }

            //for Email check  
            else if (empty($_POST["registerEmail"]))
            {
                $emailErr="Please insert your email";
                $em="block";
            }
            else if (!preg_match($filter, $_POST["registerEmail"]))
            {
                $emailErr="Email should be like this: test@test.com";
                $em="block";
            }
            
            //for phone number check
            else if (empty($_POST["phoneNumber"]))
            {
                $telErr="Please insert your phone number";
                $tl="block";
            }
            else if (!preg_match($pfilter, $_POST["phoneNumber"]))
            {
                $telErr="phone number should contain 14 digits only";
                $tl="block";
            }

            //for city check 
            else if ($_POST["city"] == "Choose...")
            {
                $telErr="Please insert your city";
                $tl="block";
            }

            //for address check
            else if (empty($_POST["address"]))
            {

                $adErr="please insert your address ";
                $ad="block";

            }
            
            // for password check
            else if (empty($_POST["registerPass"]))
            {
                $passwordErr="Please insert your Password";
                $ps="block";
            }
            else if (!preg_match($ps_regex,$_POST["registerPass"]))
            {
                $passwordErr="password must start with capital letter and be at least 8 charectes, and contain minimum of 1 number,small letter,special charecter,";
                $ps="block";
            }
            
            // for confirmation password check
            else if (empty($_POST["registerConfPass"]))
            {
                $cpasswordErr="Please insert your confirmation password";
                $cps="block";
            }
            else if ($_POST["registerConfPass"] != $_POST["registerPass"])
            {
                $cpasswordErr="Password does not match";
                $cps="block";
            }
            

            // for birth date check
            else if (empty($_POST["date"]))
            {
                $dateErr="Please insert your birth date";
                $bd="block";
            }
            else if ($diff->format('%y') < 18) 
            {
                    $dateErr="You must be at least 18 years old";
                    $bd="block";

            }
            else 
            {
                $fname=$_POST["fName"];
                $lname=$_POST["lName"];
                $email=$_POST["registerEmail"];
                $phone=$_POST["phoneNumber"];
                $city=$_POST['city'];
                $addres=$_POST['address'];
                $password=$_POST["registerPass"];
                $bdate=$_POST["date"];

                $sql="INSERT INTO users (fname, lname, email, phone, city, addres, pass, bdate) 
                VALUES('$fname','$lname','$email','$phone','$city','$addres','$password','$bdate')";
                mysqli_query($conn , $sql);

                // header("location: login.php");
            }
                   
        }

        include 'include/header.php'; 
?>
<br><br>


<!-- Sign Up form -->

<form class="needs-validation" action="register.php" method="POST" novalidate style="display:<?php echo $s2; ?> ;">
<h2 style="text-align:center ; font-family: 'FontAwesome';
    font-weight: bolder;">Sign Up form</h2>

  <div class="form-row">
    <div class="col-md-2 offset-md-4">
      <label for="validationCustom01">First name</label>
      <input type="text" class="form-control is-inavalid" id="validationCustom01" name="fName" placeholder="First name"  required>
      <div class="invalid-feedback" style="display:<?php echo $fn ?>">
        <?php echo $fnErr ?>
      </div>
    </div>
    <div class="col-md-2 ">
      <label for="validationCustom02">Last name</label>
      <input type="text" class="form-control is-inavalid" id="validationCustom02" name="lName" placeholder="Last name"  required>
      <div class="invalid-feedback" style="display:<?php echo $ln ?>">
        <?php echo $lnErr ?>
        </div>
      <!-- <div class="valid-feedback">
        Looks good!
      </div> -->
    </div>
    <div class="col-md-4 offset-md-4">
      <label for="validationemail">Email</label>
      <div class="input-group">
        <input type="email" class="form-control is-inavalid" id="validationemail" name="registerEmail" placeholder="test@test.com" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback" style="display:<?php echo $em ?>">
        <?php echo $emailErr ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 offset-md-4">
      <label for="validationphone">Phone</label>
      <div class="input-group">
        <input type="number" class="form-control is-inavalid" id="validationphone" name="phoneNumber" placeholder="0777777777" aria-describedby="inputGroupPrepend" pattern="[0-9]{14}" required>
        <div class="invalid-feedback" style="display:<?php echo $tl ?>">
        <?php echo $telErr ?>
        </div>
      </div>
    </div>
  <div class="form-group col-md-4 offset-md-4">
      <label for="inputState">City</label>
      <select id="inputState" name="city" class="form-control is-inavalid" style="height:7vh ;">
        <option selected>Choose...</option>
        <option value="Amman">Amman</option>
        <option value="Aqaba">Aqaba</option>
        <option value="Maan">Maan</option>
        <option value="Irbid">Irbid</option>
        <option value="Zarqa">Zarqa</option>
        <option value="Ajloun">Ajloun</option>
        <option value="Jarash">Jarash</option>
        <option value="Al-Mafraq">Al-Mafraq</option>
        <option value="Al-Tafeela">Al-Tafeela</option>
        <option value="El-Karak">El-Karak</option>
        <option value="Madaba">Madaba</option>
        <option value="Al-Salt">Al-Salt</option>
      </select>
    </div>
  <div class="form-row">
    <div class="col-md-4 offset-md-4">
      <label for="validationCustom03">Address</label>
      <input type="text" class="form-control is-inavalid" id="validationCustom03" name="address" placeholder="Address" required>
      <div class="invalid-feedback" style="display:<?php echo $ad ?>">
        <?php echo $adErr ?>
      </div>
    </div>
    <div class="col-md-2 offset-md-4">
      <label for="validationpass">Password</label>
      <input type="password" class="form-control is-inavalid" id="validationpass" name="registerPass" placeholder="********" required>
      <div class="invalid-feedback" style="display:<?php echo $ps ?>">
        <?php echo $passwordErr ?>
      </div>
    </div>
    <div class="col-md-2 ">
      <label for="validationConPass">Confirm password</label>
      <input type="password" class="form-control is-inavalid" id="validationConPass" name="registerConfPass" placeholder="********" required>
      <div class="invalid-feedback" style="display:<?php echo $cps ?>">
        <?php echo $cpasswordErr ?>
      </div>
    </div>
  </div>
  <div class="col-md-4 offset-md-4">
      <label for="validationbdate">Birthdat</label>
      <div class="input-group">
        <input type="date" class="form-control is-inavalid" id="validationbdate" name="date" placeholder="test@test.com" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback" style="display:<?php echo $bd ?>">
        <?php echo $dateErr ?>
        </div>
      </div>
    </div>
  <div class="form-group">
    <div class="form-check col-md-4 offset-md-4">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback" style="display:<?php echo $us ?>">
        <?php echo $userErr ?>
      </div>
    </div>
  </div>
  <button type="submit" class="btn col-md-4 offset-md-4" name="signup" style="background-color:#363062 ; color:#E9D5DA">Sign Up</button>
  <br><br>
  
</form>
<!-- End Sign Up form -->

<!-- switch to login form -->
<form class="needs-validation" action="register.php" method="POST" novalidate style="display:<?php echo $s2; ?> ;">
<button class="btn col-md-4 offset-md-4" type="submit" name="switch" style="background-color:#E9D5DA ; color:#363062"><a href="./login.php">Log In !!!</a></button>
</form>
<!-- end of switch to login form -->

<br><br>
<?php
 require 'include/footer.php'; 
 ?>