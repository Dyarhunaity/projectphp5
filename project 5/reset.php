<?php 
include 'config/connect.php';
session_start();
// login Validation function 



$cq=$rp="none";
$lpErr="";
$question="";
$answer="";
$password="";
$id;
$login=mysqli_fetch_all(mysqli_query($conn,'select * from users'),MYSQLI_ASSOC);


//confirm Email function
if (isset($_POST['esubmit'])) 
{

    $lemail=$_POST['email'];
    if (empty($_POST['email'])) 
    {
        $lp="block";
        $lpErr="please insert email";
    }
    else if(!empty($_POST['email'])) 
    {
        foreach($login as $user )
        {
            if ($lemail == $user['email'])
            {
                $cq="block";
                $ce="none";
                $question=$user['security_question'];
                $answer=$user['security_answer'];
                $id=$user['id'];
            }
        }
    }
    else
        {
            $lp="block";
            $lpErr="Wrong email";
        }
}

// confirm security question function
if (isset($_POST['qsubmit'])) 
{

    if ($_POST['answer'] == $answer ) 
    {
        $rp="block";
        $ce=$cq="none";
        echo $id;
        
    }
    else 
    {
        $cq="block";
        $ce="none";
        $lp="block";
        $lpErr="Wrong Answer";
    }
}


// confirm new passwrod function
if (isset($_POST['psubmit'])) 
{
    if (empty($_POST['password']) || empty($_POST['password2'])) {
        $rp="block";
        $ce=$cq="none";
        $lp="block";
        $lpErr="please insert Password";
    }
    else if($_POST['password'] != $_POST['password2'])
    {
        $rp="block";
        $ce=$cq="none";
        $lp="block";
        $lpErr="Password does not match";
    }
    else 
    {
        $newPass=$_POST['password'];
        $sqla="UPDATE users SET pass=$newPass WHERE id=$id;";
        mysqli_query($conn,$sqla);
        header('location: login.php');
    }
}

include 'include/header.php'; 
?>
<div class="hr-theme-slash-2">
  <div class="hr-line"></div>
  <div class="hr-icon"><i class="fa-solid fa-couch"></i></div>
  <div class="hr-line"></div>
</div>
<br>
<!-- Confirm E-mail form -->

<form  action="reset.php" method="POST" id="logForm" style="display:<?php echo $ce; ?>;">

    
        <h2 style="text-align:center; font-family: 'FontAwesome'; color:#363062;
    font-weight: bolder;">Check Email</h2>
    

    <div class="form-row">
        <div class="col-md-4 offset-md-4">
        <label for="email">Your E-mail</label>   
        <input type="email" name="email" id="email" class="form-control is-inavalid" placeholder="test@test.com" value="">
        <div class="invalid-feedback" style="display:<?php echo $lp ?>">
        <?php echo $lpErr ?>
        </div>
        </div>
    </div>

    <button class="btn col-md-4 offset-md-4" type="submit" name="esubmit" style="background-color:#363062 ; color:#E9D5DA">Enter</button>
</form>
    <br><br>
<!-- Confirm E-mail form -->

<!-- security question form -->

<form  action="reset.php" method="POST" id="logForm" style="display:<?php echo $cq; ?>;">

    
        <h2 style="text-align:center; font-family: 'FontAwesome'; color:#363062;
    font-weight: bolder;">Answer Question</h2>
    

    <div class="form-row">
        <div class="col-md-4 offset-md-4">
        <label for="answer"><?php $question; ?></label>   
        <input type="text" name="answer" id="answer" class="form-control is-inavalid">
        <div class="invalid-feedback" style="display:<?php echo $lp ?>">
        <?php echo $lpErr ?>
        </div>
        </div>
    </div>

    <button class="btn col-md-4 offset-md-4" type="submit" name="qsubmit" style="background-color:#363062 ; color:#E9D5DA">Submit</button>
</form>
<!-- end of security question form -->

<!-- Set new passwor -->
<form  action="reset.php" method="POST" id="logForm" style="display:<?php echo $rp; ?>;">

    
        <h2 style="text-align:center; font-family: 'FontAwesome'; color:#363062;
    font-weight: bolder;">Reset Password</h2>
    

    <div class="form-row">
        <div class="col-md-4 offset-md-4">
        <label for="email">New password</label>   
        <input type="password" name="password" id="email" class="form-control is-inavalid" placeholder="********" value="">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4 offset-md-4">
        <label for="password2">confirm new password</label>   
        <input type="password" name="password2" id="password2" class="form-control is-inavalid" placeholder="********" value="">
        <div class="invalid-feedback" style="display:<?php echo $lp ?>">
        <?php echo $lpErr ?>
        </div>
        </div>
    </div>

    <button class="btn col-md-4 offset-md-4" type="submit" name="psubmit" style="background-color:#363062 ; color:#E9D5DA">Submit</button>
</form>
<!-- End of Set new passwor -->




<br><br>
<?php require 'include/footer.php'; ?>