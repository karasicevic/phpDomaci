<!DOCTYPE html>
<?php
include "dbBroker.php";
include "Model/Restaurant.php";
//include "./header_footer/header.php";

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);
  
    $name = mysqli_real_escape_string($conn, $name);
    $password = mysqli_real_escape_string($conn, $password);
    $confirmpassword = mysqli_real_escape_string($conn, $confirmpassword);
  
    if ($password !== $confirmpassword) {
        echo '<script>alert("Passwords do not match!")</script>';
    } else {
        $query = "SELECT * FROM restaurant WHERE name='$name'";
        $res_e = mysqli_query($conn, $query);
        if (mysqli_num_rows($res_e) > 0) {
            echo '<script>alert("Name already exists!")</script>';
        } else {
            $data = array(
                "name" => $name,
                "password" => $password,
            );
            $restaurant = new Restaurant(null, $name, $password);
            $restaurant->addRestaurant($data, $conn);
            header("Location: index.php");
            exit;
        }
    }
}
?>
<html lang="en">
  <head>
    <title>Sign up</title>
    <link rel="stylesheet" href="./CSS/register.css" /> 
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quietflow@1.0.2/lib/quietflow.min.js"></script>
  </head>
  

  <body>
    
<?php  include'./header_footer/header.php';?>
  <div class="container" id="Form">
    <form name="form" action="#" method="POST" class="login-form">
      <h1>Sign up</h1>
      <div class="flex-input">
        <label class="">Name</label>
        <input type="text" size="30" id="name" placeholder="Name" name="name" required>
      </div>
      <div class="flex-input">
        <label for="">Password</label>
        <input type="password" size="30"  id="password"placeholder="Password"name="password"required >
      </div>
      <div class="flex-input">
        <label for="">Confirm Password</label>
        <input type="password" size="30" placeholder="Confirm Password"name="confirmpassword"required >
      </div>
      <div>
        <input type="submit" name="register" value="Submit" id="submit">
      </div>

<div class="flex-container">
    <div style="text-align: right;">
        <input type="reset"id="reset">
</div>
</div>
<p class="para-2">
 Already have an account? <a href="form.php">Login here</a>
   </form>
</div>
  </body>
</html>