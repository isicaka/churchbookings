
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seat reservation</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/loginform.css">
    <!--<link rel="stylesheet" type="text/css" media="screen and (max-width: 768px)" href="css/mobile.css"> -->

</head>
<body>
    <img src="images/mcsa_logo.jpg" id="mcsa_logo" alt="MCSA_logo.jpg"/>
    <!--<img src="images/ymg_logo.jpg" id="ymg_logo" alt="YMG_logo.jpg"/> -->
    
    <img src="images/mcsa_banner.jpg" class="center" alt="MCSA_banner.jpg"/>
    <div class="text"><h1>Bethesda Methodist Mission</h1></div>

<?php
//database connection

$config = parse_ini_file('../config.ini');

$conn = new mysqli($config['serverhost'], $config['username'], $config['password'], $config['database']);


//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//get HMTL form field values
$firstName = $conn -> real_escape_string($_POST['firstname']);
$lastName = $conn -> real_escape_string($_POST['lastname']);
$email = $conn -> real_escape_string($_POST['email']);
$cell = $conn -> real_escape_string($_POST['cell']);
$streetaddress = $conn -> real_escape_string($_POST['homeaddress']);

$residents_details = array(
    $conn -> real_escape_string($_POST['person1']), $conn -> real_escape_string($_POST['cell1']),
    $conn -> real_escape_string($_POST['person2']), $conn -> real_escape_string($_POST['cell2']),
    $conn -> real_escape_string($_POST['person3']), $conn -> real_escape_string($_POST['cell3']),
    $conn -> real_escape_string($_POST['person4']), $conn -> real_escape_string($_POST['cell4']), 
    $conn -> real_escape_string($_POST['person5']), $conn -> real_escape_string($_POST['cell5'])
);


//create new residents array but now only with non-empty values
$filtered_residents = array_filter($residents_details);
$new_insert_values = '';

$sqlGetMaxID = "SELECT max(ID) AS ID FROM bookings";
$result = $conn->query($sqlGetMaxID);
if ($result->num_rows > 0) {
    $maxID = $result->fetch_assoc();
    $maxID = $maxID["ID"];
    $seatnumber = $maxID + 1; 
} else { echo "Something went wrong with seat numbers";}

if ($seatnumber <= 50) {
    //INSERT into database
    $sqlNewBooking = "INSERT INTO bookings (firstname, lastname, emailaddress, cellnum, homeaddress, currentdate) 
    VALUES ('$firstName', '$lastName', '$email', '$cell', '$streetaddress', curdate())";
    if ($conn->query($sqlNewBooking) === TRUE) {
        echo "<h2 style=\"text-align:center\"> Thank you, your seat has been reserved. </h2> <br>";
        echo "<h2 style=\"text-align:center\"> You have been allocated seat number: </h2> <br>";
        echo "<h1 style=\"text-align:center\"> $seatnumber </h1>";
    } else { echo "Error: Failed to add new record.. " . $sqlNewBooking . "<br>" . $conn->error;}

    if (count($filtered_residents) > 0) {
        for ($i=0; $i < count($filtered_residents); $i++) {
            $insert_values = ' (' . '\'' . $seatnumber . '\',' . '\''. $filtered_residents[$i] . '\'' . ',' . '\'' . $filtered_residents[$i+1] . '\'' . '),';
            $new_insert_values .= $insert_values;
            $i++;
        }
        $new_insert_values = substr($new_insert_values,0,strlen($new_insert_values)-1);
        //echo $new_insert_values;
        $sqlAddResidents = "INSERT INTO residents (ID, resident, cell) 
        VALUES " . $new_insert_values;

        if ($conn->query($sqlAddResidents) === TRUE) {
            echo "<br>";
        } else { echo "Error: could not add residents... " . $sqlAddResidents . "<br>" . $conn->error;}
    }

} else { echo "<h2 style=\"text-align:center\"> We are sorry, but there are no more seats available for this Sunday</h2> <br>";}


    
$conn->close();

?>

<div style="font-family: verdana; font-weight: bold; text-align: center; color: #808080; font-size: 20px"><a href="/book">Go Back</a></div>
</body>
</html>