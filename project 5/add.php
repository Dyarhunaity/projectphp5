<?php include 'config/connect.php';
if (isset($_POST['updateUserSubmit'])) 
{
    // if (!empty($_POST['userName'])) {
        $newName=$_POST['userName'];
        // $sql="UPDATE users
        // SET fname=$newName
        // WHERE updat=1;";
        // mysqli_query($conn,$sql);
    // }
    // if (!empty($_POST['userEmail'])) {
        $newEmail=$_POST['userEmail'];
        // $sql="UPDATE users
        // SET email=$newEmail
        // WHERE updat=1;";
        // mysqli_query($conn,$sql);
    // }
    // if (!empty($_POST['userPhone'])) {
        $newPhone=$_POST['userPhone'];
        // $sql="UPDATE users
        // SET phone=$newPhone
        // WHERE updat=1;";
        // mysqli_query($conn,$sql);
    // }
    // if (!empty($_POST['userPass'])) {
        $newPass=$_POST['userPass'];
        // $sql="UPDATE users
        // SET pass=$newPass
        // WHERE updat=1;";
        // mysqli_query($conn,$sql);
    // }
echo $newName.$newEmail.$newPhone.$newPass;
$sql="UPDATE users SET fname='$newName',email='$newEmail',phone='$newPhone',Pass='$newPass',updat=0 WHERE updat=1;";
mysqli_query($conn,$sql);
}
else {
    echo "error";
}
?>
<form class="container" action="add.php" method="POST" style="display:<?php echo $uF; ?> ;">
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
<?php 

?>