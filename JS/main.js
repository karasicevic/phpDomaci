function validateForm() {
    var cena = document.forms["bookingEvent"]["price"].value;
    var tip = document.forms["bookingEvent"]["type"].value;
    var datum = document.forms["bookingEvent"]["date"].value;
    var brGostiju = documet.forms["bookingEvent"]["date"].value;
    
    if (price == "" || type == "" || date == "" ||  numOfGuests=="") {
      alert("You must enter all fields!");
      return false;
    }
  }