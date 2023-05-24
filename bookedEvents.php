<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: ./form.php");
  exit;
}
include "./header_footer/header.php";
include "dbBroker.php";
include "Model/Restaurant.php";
include "Model/Event.php";

if(isset($_POST['logout'])) {
  session_destroy();
  header("Location: index.php");
}


 $condition='';
   $events = Event::getAllEvents($conn,$condition);
   $query = "SELECT e.id, r.name AS name, e.type, e.price, e.numOfGuests, e.date FROM event e JOIN restaurant r ON e.restaurantId=r.id ORDER BY e.id DESC";
   $result = mysqli_query($conn, $query); 
?> 
 <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/allEvents.css">  
<title>All added events</title>
</head>

<body>  
  <div class="wrapper">
  
</div>
<section>
<div class="container" id="table">
             <table class="table table-light table-striped table-hover table-borderless"> 
                <thead class="thead-light">
                    <tr class="active">
                        <th scope="col" ><a class="column_sort" mid="name" data-order="desc" href="#" style="color:black">Restaurant</a></th>
                        <th scope="col" ><a class="column_sort" mid="type" data-order="desc" href="#" style="color:black" >Type of event</a></th>
                        <th scope="col" ><a class="column_sort" mid="price" data-order="desc" href="#" style="color:black" >Price</a></th>
                        <th scope="col" ><a class="column_sort" mid="numOfGuests" data-order="desc" href="#" style="color:black" >Number of guests</a></th>
                         <th scope="col" ><a class="column_sort" mid="date" data-order="desc" href="#" style="color:black">Date</a></th>
                        <th  scope="col">Update</th> 
                        <th >Delete</th>                       
                    </tr>
                  </thead>
                    <tbody>
                    <?php $table=mysqli_query($conn, "SELECT e.id AS id, r.name AS name, e.type as type, e.price as price, e.numOfGuests as numOfGuests, e.date as date FROM event e JOIN restaurant r ON e.restaurantId=r.id");
                    while($row=mysqli_fetch_array($table)){
                        ?>
                                  <tr class="warning" id="<?php echo $row['id']; ?>">
                                    <td data-target="name"><?php echo $row['name'];?></td>
                                    <td data-target="type"><?php echo $row['type'];?></td>
                                    <td data-target="price"><?php echo $row['price'];?></td>
                                    <td data-target="numOfGuests"><?php echo $row['numOfGuests'];?></td>
                                    <td data-target="date"><?php echo $row['date'];?></td>
                                    <td><a href="#" style="color:black" data-role="update" data-id="<?php echo $row['id'] ?>">Update</a></td>
                                    <td><a style="color:black" href="delete.php?deleteId=<?php echo $row['id']; ?>">Delete</td></a>
                                    </tr>
                        <?php } ?> 
                </tbody>
            </table>      
            <a class="btn-round-custom" href="search.php" role="button">Search Events</a>
            <a class="btn-round-custom" href="index.php" role="button">Back to Home</a>
            <div class="row">
            <div id="uni-logos-wrapper" class="col-12">
                <form method="POST">
                    <button type="submit" name="logout" class="btn btn-primary" style="float: right; margin: 5px;">Log out</button>
                </form>
            </div>
            </div>
            </section>
            <div id="myModal" class="modal fade"  role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update</h4>
      </div>
      <div class="modal-body">
       <div class="form"-group>
</div>
<div class="form"-group>
<label> Type of event</label>
<input type="text" id="type" class="form-control">
</div>
<div class="form"-group>
<label> Price</label>
<input type="text" id="price" class="form-control">
</div>
<div class="form"-group>
<label> Number of guests</label>
<input type="text" id="numOfGuests" class="form-control">
</div>
<div class="form"-group>
<label> Date</label>
<input type="text" id="date" class="form-control">
</div>
<input type="hidden" id="id" class="form-control">
</div>
       
      <div class="modal-footer">
        <a href="#" id="save" class="btn btn-primary pull-left">Update </a>
        <button type="button" class="btn btn-default pull-right"style="background-color: red; color:black;" data-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
  </div>
</body>

<script> 
$(document).ready(function() {
  $(document).on('click', 'a[data-role=update]', function() {
    var id = $(this).data('id'); 
//    var name = $('#' + id).children('td[data-target=name]').text();
    var type = $('#' + id).children('td[data-target=type]').text();
    var price = $('#' + id).children('td[data-target=price]').text();
    var numOfGuests = $('#' + id).children('td[data-target=numOfGuests]').text();
    var date = $('#' + id).children('td[data-target=date]').text();

 //   $('#name').val(name);
    $('#type').val(type);
    $('#price').val(price);
    $('#numOfGuests').val(numOfGuests);
    $('#date').val(date);
    $('#id').val(id);
    $('#myModal').modal('toggle');
  });

  $('#save').click(function() {
    var id = $('#id').val();
 //   var name = $('#name').val();
    var type = $('#type').val();
    var price = $('#price').val();
    var numOfGuests = $('#numOfGuests').val();
    var date = $('#date').val();

    $.ajax({
      url: 'update.php',
      method: 'post',
      data: {
        id: id,
        type: type,
        price: price,
        numOfGuests: numOfGuests,
        date: date
      },
      success: function(response) {
        $('#' + id).children('td[data-target=type]').text(type);
        $('#' + id).children('td[data-target=price]').text(price);
        $('#' + id).children('td[data-target=numOfGuests]').text(numOfGuests);
        $('#' + id).children('td[data-target=date]').text(date);
        $('#myModal').modal('toggle');
      }
    });
  });
});
    </script>


     <script>  
 $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_name = $(this).attr("mid");  
           var order = $(this).data("order");  
           var arrow = '';  
         
           if(order == 'desc')  
           {  
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';  
           }  
           else  
           {    
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';  
           }  
      
           $.ajax({  
                url:"sort.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#table').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
           })  
      });  
 });  
 </script> 

</html>