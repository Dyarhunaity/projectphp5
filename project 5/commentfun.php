<?php
session_start();

include 'config/config.php';
function setComments($db)
{
  if(isset($_POST['CommentSubmit'])){
//    $u_id=$_POST['c_id'];
   $user_name=$_POST['userName'];
//    $date=$_POST['date'];
   $msg=$_POST['msg'];

   $sql="INSERT INTO comment (user_name,comment_text) VALUES ('$user_name','$msg');";
   $result= $db->prepare($sql);
   $result->execute();

  }
}

function GetComments($db)
{
   $product_id=$_SESSION['product_id'];
   $sql1="SELECT * FROM comment";
   $result= $db->prepare($sql1);
   $result->execute();
   $row = $result->fetchAll(PDO::FETCH_ASSOC);
//    print_r($row);
//    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
    echo "<div class='container my-5 py-5'>
    <div class='row d-flex justify-content-center'>
      <div class='col-md-12 col-lg-10'>
        <div class='card text-dark'>
          <div class='card-body p-4'>
            <h4 class='mb-0'>Recent comments</h4>
            <p class='fw-light mb-4 pb-2'>Latest Comments section by users</p>";
    foreach($row as $com){
    if ($com['product_id']==$product_id)
    {
   echo "

           <div class='d-flex flex-start'>
           <i class='fa-solid fa-user'></i>
             <div>
               <h6 class='fw-bold mb-1'>".$com['user_name']."</h6>
               <div class='d-flex align-items-center mb-3'>
                 <p class='mb-0'>
                   ".$com['comment_date']."
                   <span class='badge bg-success'>Approved</span>
                 </p>
               </div>
               <p class='mb-0'>
               ".$com['comment_text']."
               </p></div>
               </div>
             
            
             <hr class='my-0' />";
    }
   }
   echo " </div>  </div>
   </div>
 </div>
</div>";
  
   
}



?>