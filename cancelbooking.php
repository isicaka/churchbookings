<?php
    //database connection
    $config = parse_ini_file('../config.ini');
    $conn = new mysqli($config['serverhost'], $config['username'], $config['password'], $config['database']);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //if FORM submitted...
    if (isset($_POST['CancelButton'])) {
        $seatno = $conn -> real_escape_string($_POST['seatno']);
        $cell = $conn -> real_escape_string($_POST['cell']);
        $sqlDelete = "Delete from bookings where ID = $seatno and cellnum = $cell";
        if ($conn->query($sqlDelete) === TRUE) {
            if (mysqli_affected_rows($conn) == 0) {
                $message = "Your reservation was not found";
            } else {$message = "Thank you, your reservation has been cancelled";}    
        } else { //echo "Error: Failed to cancel reservation.. " . $sqlDelete . "<br>" . $conn->error;
            $message = "Failed to cancel the reservation...: ". $sqlDelete . "<br>" . $conn->error ;}    
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
            <input type="text" placeholder="seat number" name="seatno" id="seatno" required/>
            <input type="text" placeholder="cell number" name="cell" id="cell" required/>
            <button type="submit" name="CancelButton">Cancel A Seat Reservation</button>            
        </form>
        <?php 

            if (isset($message)) {
                echo "<h2 style=\"text-align:center\"> $message </h2>";
            }      
        ?>
    </div>


</body>
</html>