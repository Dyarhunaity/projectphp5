<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Thank you page</title>
    <style>
        div {
            margin-top: 3%;
        }

        h1 {
            /* text-align: center; */
            font-size: 5em;
        }

        p {
            font-size: larger;
        }

        img {
            width: 28%;
            margin-left: 35%;
        }

        button {
            margin-left: 38%;
            margin-bottom: 1.5em;
        }
        button a{
            text-decoration: none;
            color: white;
        }
        a:hover{
            color: white;
        }
        .thank{
            border: 1px solid;
            width:60%;
        }
    </style>
</head>

<body>
    <div class=" container thank">
    <div>
        <header class="site-header" id="header">
            <h1 class="site-header__title text-center" data-lead-id="site-header-title">THANK YOU!</h1>
            <p class="text-center">Your Order has been placed successfully</p>
        </header>
        <br>
        <img src="./images/green-check.jpg" alt="">
        <br>
    </div>
    <button type="button" class="btn btn-secondary btn-lg "><a href="index.php"> Back to Home page</a> </button>
    <br>
</div>
    
</body>
</html>