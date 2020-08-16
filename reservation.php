
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
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$email = $_POST['email'];
$cell = $_POST['cell'];
$streetaddress = $_POST['homeaddress'];

$residents_details = array($_POST['person1'], $_POST['cell1'], 
$_POST['person2'], $_POST['cell2'], $_POST['person3'], $_POST['cell3'], 
$_POST['person4'], $_POST['cell4'], $_POST['person5'], $_POST['cell5']);


//create new residents array but now only with non-empty values
$filtered_residents = array_filter($residents_details);
$new_insert_values = '';

//INSERT into database
$sqlNewBooking = "INSERT INTO bookings (firstname, lastname, emailaddress, cellnum, homeaddress) 
VALUES ('$firstName', '$lastName', '$email', '$cell', '$streetaddress')";

if ($conn->query($sqlNewBooking) === TRUE) {
    echo "<h2 style=\"text-align:center\"> Thank you, your seat has been reserved </h2> <br>";
} else { echo "Error: Failed to add new record.. " . $sqlNewBooking . "<br>" . $conn->error;}

//get the maximum ID
if (count($filtered_residents) > 0) {
    $sqlGetMaxID = "SELECT max(ID) AS ID FROM bookings";

    $result = $conn->query($sqlGetMaxID);
    if ($result->num_rows > 0) {
        $maxID = $result->fetch_assoc();
        $maxID = $maxID["ID"]; 
    } else { echo "Something went wrong with seat numbers";}


    for ($i=0; $i < count($filtered_residents); $i++) {
        $insert_values = ' (' . '\'' . $maxID . '\',' . '\''. $filtered_residents[$i] . '\'' . ',' . '\'' . $filtered_residents[$i+1] . '\'' . '),';
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
    
$conn->close();

?>

</body>
</html>