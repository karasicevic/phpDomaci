<?php
 include 'dbBroker.php';
  include 'Model/Event.php'; 
    if(isset($_POST['id'])){
        $type=$_POST['type'];
        $price=$_POST['price'];
        $numOfGuests=$_POST['numOfGuests'];
        $date=$_POST['date'];
        $id=$_POST['id'];
       
        $result= mysqli_query($conn,"UPDATE event SET type='$type',price='$price',numOfGuests='$numOfGuests',date='$date' where id='$id'");

       if($result ){
           echo "Event is updated succesfully";
       }
       else{
          echo "Error updating event";
  } 
}
?>