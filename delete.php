<?php
   include "dbBroker.php";
   include "Model/Event.php";

   $deleteId = $_GET['deleteId'];
   $query = "DELETE FROM event WHERE id = $deleteId";
   $result = mysqli_query($conn, $query);

 header("Location: bookedEvents.php");
 ?>  
<!DOCTYPE html>
    <link rel="icon" href="images/logo.jpg" type="image/ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </html>