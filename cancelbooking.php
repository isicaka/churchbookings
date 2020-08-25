<?php
    //database connection
    $config = parse_ini_file('../config.ini');
    $conn = new mysqli($config['serverhost'], $config['username'], $config['password'], $config['database']);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed");
        //die("Connection failed: " . $conn->connect_error);
    }
    
    //if FORM submitted...    
    if (isset($_POST['CancelButton'])) {
        $reservationid = $conn -> real_escape_string($_POST['reservationid']);
        $sqlDelete = "Delete from bookings where reservationid = $reservationid";
        if ($conn->query($sqlDelete) === TRUE) {
            if (mysqli_affected_rows($conn) == 0) {
                $message = "We could not find a reservation with this reference. Please try again.";
            } else {
                $message = "Thank you, your reservation has been cancelled";
            }    
        } else {$message = "Failed to cancel the reservation. Please contact administrator";}    
    } 

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserve your seat</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/loginform.css">
    <!--<link rel="stylesheet" type="text/css" media="screen and (max-width: 768px)" href="css/mobile.css"> -->

</head>
<body>
    <img src="images/mcsa_logo.jpg" id="mcsa_logo" alt="MCSA_logo.jpg"/>
    
    <img src="images/mcsa_banner.jpg" class="center" alt="MCSA_banner.jpg"/>
    <div class="text"><h1>Bethesda Methodist Mission</h1></div>
    <div class="form">
        <th>Please enter allocated seat number</th>
        <form action="#" method="POST">
            <input type="text" placeholder="reservation number" name="reservationid" id="reservationid" required/>
            <button type="submit" name="CancelButton">Cancel A Seat Reservation</button>            
        </form>
        <?php 

            if (isset($message)) {
                echo "<h2 style=\"text-align:center\"> $message </h2>";
            }      
        ?>
    </div>

    <div style="font-family: verdana; font-weight: bold; text-align: center; color: #808080; font-size: 20px"><a href="/book">Back To Home Page</a></div>
</body>
</html>