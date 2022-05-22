<?php
    $conn=mysqli_connect('localhost','root','','furniture');

    if ($conn->connect_error) 
    {
        echo 'not connected, error';
    }
    // else
    // {
    //     echo 'Connected Successfully';
    // }
?>