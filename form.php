<?php
require "./dbBroker.php"; 
require "Model/Restaurant.php"; 
session_start(); 
if (isset($_POST['name']) && isset($_POST['password'])) { 
    $name = $_POST['name']; 
    $pass = $_POST['password']; 
    $restaurant_id = 1; 
    $restaurant = new Restaurant($restaurant_id, $name, $pass); 
    $response = Restaurant::logIn($restaurant, $conn); 
    if ($response->num_rows == 1) { 
    $_SESSION['restaurant_id'] = $restaurant->id; 
    $_SESSION['loggedin'] = true;
    $_SESSION['restaurant_name'] = $name;
    header('Location: booking.php'); 
    echo '<script>alert("Uspešno ste se prijavili!")</script>';
    exit(); 
} 
    else { echo '<script>alert("Neuspesno prijavljivanje!")</script>'; } 
} 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma</title>
    <link rel="stylesheet" type="text/css" href="CSS/form.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quietflow@1.0.2/lib/quietflow.min.js"></script>
   
</head>
<body>
<?php  include'./header_footer/header.php';?>

<body class="container" id="Form">
   <form name="form"  action="#" method="POST"  class="login-form" >
<h1>LogIn</h1>
<div class="flex-input">
<label class="">Name</label>
<input type="text" size="30"  placeholder="Name"name="name"required >
</div>


<div class="flex-input">
<label for="">Password</label>
<input type="password" size="30" placeholder="Password"name="password"required >
</div>

<div>
<button id="submit"type="submit">Submit</button>
</div>
<div class="flex-container">
    <div style="text-align: right;">
        <input type="reset"id="reset">

</div>
</div>

   </form>

</body>
</body>
</html>