<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celebrate with us!</title>
    <link rel="stylesheet" href="css/header.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <nav>
        <label class="logo"><img src="images/logo.jpg"></label>
        <ul>
        <li><a id="home-link" href="index.php">Home</a></li>
        <li><a id="book-link" href="booking.php">Book a event</a></li>
        <li><a id="events-link" href="bookedEvents.php">All events</a></li>
        <li><a id="register-link" href="register.php">Register</a></li>
        </ul>
    </nav>

    <script>
  var currentUrl = window.location.href;

  if (currentUrl.includes("index.php")) {
    document.getElementById("home-link").classList.add("active")
  } else if (currentUrl.includes("booking.php")) {
    document.getElementById("book-link").classList.add("active")
  } else if (currentUrl.includes("bookedEvents.php")) {
    document.getElementById("events-link").classList.add("active")
  } else if (currentUrl.includes("register.php")) {
    document.getElementById("register-link").classList.add("active")
  }
</script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    </body>

