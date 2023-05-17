<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ./form.php");
    exit;
}
//include "./header_footer/header.php";
include "./dbBroker.php";
include "Model/Restaurant.php";
include "Model/Event.php";

if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}


 $restaurant=Restaurant::getAllRestaurants($conn);

 if(isset($_POST['add'])) {
    $price = trim($_POST['price']);
    $type = trim($_POST['type']);
    $numOfGuests = trim($_POST['numOfGuests']);
    $date = trim($_POST['date']);
    $selected_restaurant = $_POST['selected_restaurant'];

    

    if(empty($restaurant)) {
        echo '<script>alert("You did not pick a restaurant!")</script>';
    } else {
        $data = array (
            "price" => $price,
            "type" => $type,
            "numOfGuests"=> $numOfGuests,                 
            "date" => $date,
            "restaurantid" => $selected_restaurant
        );  

        $event = new Event(null, $price, $type, $numOfGuests, $date, $selected_restaurant);    
        $event->AddEvent($data, $conn);
        header("Location: booking.php");
    }
}
 

?>
<html>
<head>
<link rel="icon" href="img/favicon.ico" type="image/ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="CSS/booking.css">
    
    <script src="js/main.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
    <title>Add new event</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
</head>

<body>
    
    <div class="row">
        <div id="uni-logos-wrapper" class="col-12">
            
        </div>
    </div>
    <div id="inser-form" class="row form-container">
    <div class="col-md-2"></div>
    
        <div class="col-md-4">
           
            <form name="bookingEvent" action="" onsubmit="return validateForm()" method="POST" role="form">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Enter price ">
                </div>
                <div class="form-group">
                    <label for="type">Type of event</label>
                    <input type="text" class="form-control" name="type" id="type" placeholder="Enter type of event">
                </div>
                <div class="form-group">
                    <label for="numOfGuests">Number of guests</label>
                    <input type="text" class="form-control" name="numOfGUests" id="numOfGuests" placeholder="Enter number of guests ">
                </div>
                <div class="form-group">
                    <label for="date">Date </label>
                    <input type="text" class="form-control" name="date" id="date" placeholder="Enter date">
                </div>

                <div class="form-group">
                    <label for="restaurant">Name of restaurant</label>

                    <select class="form-control" name="selected_restaurant" id="selected_restaurant">
                        <?php foreach($restaurant as $res): ?>
                        <option value="<?php echo $res->id;?>">
                            <?php echo $res->name;?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" id="add" name="add" class="btn-round-custom">Add</button>
                </div>
            </form>
            <a class="btn-round-custom" href="search.php" role="button">Search all events</a>
            <div class="row">
            <div id="uni-logos-wrapper" class="col-12">
                <form method="POST">
                    <button type="submit" name="logout" class="btn btn-primary" style="float: right; margin: 5px;">Log out</button>
                </form>
            </div>
        </div>
    </div>
    <div id='calendar'></div>

        <div class="col-md-2"></div>
    </div>
    <div class="col-md-4"></div>

</body>
</html>