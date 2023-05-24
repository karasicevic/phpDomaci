<?php  
 include'dbBroker.php';
 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $query = "SELECT * FROM event e JOIN restaurant r on e.restaurantId=r.id ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($conn, $query);  
 $output .= '  
 <table class="table table-light table-striped table-hover table-borderless">
      <tr class="active">  
           <th><a class="column_sort" mid="name" data-order="'.$order.'" href="#" style="color:black">Name</a></th>  
           <th><a class="column_sort" mid="type" data-order="'.$order.'" href="#" style="color:black">Type</a></th>  
           <th><a class="column_sort" mid="price" data-order="'.$order.'" href="#" style="color:black">Price</a></th>  
           <th><a class="column_sort" mid="numOfGuests" data-order="'.$order.'" href="#" style="color:black">Number of guests</a></th>  
           <th  scope="col">Date</th>
      </tr>  
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr class="warning">  
           <td>' . $row["name"] . '</td>  
           <td>' . $row["type"] . '</td>  
           <td>' . $row["price"] . '</td>  
           <td>' . $row["numOfGuests"] . '</td>  
           <td>' . $row["date"] . '</td> 
           </tr>  
      ';  
 }  
 $output .= '</table>';  
 echo $output;  
 ?> 