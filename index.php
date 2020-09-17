<?php
    //database connection
    $config = parse_ini_file('../config.ini');
    $conn = new mysqli($config['serverhost'], $config['username'], $config['password'], $config['database']);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed");
    }

    $RecordCount = "SELECT count(*) AS totalbookings FROM bookings";
    $res = $conn->query($RecordCount); 
    if ($res->num_rows > 0) {
    $totalbookings = $res->fetch_assoc();
    $totalbookings = $totalbookings["totalbookings"];
    $available_Seats = 40 - $totalbookings;  
    } else {echo "Error. Please contact administrator.";}
  
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
    <!--<link rel="stylesheet" type="text/css" media="screen and (max-width: 768px)" href="css/mobile.css"> 
    <style>
        table, th, td {border: 1px solid black;}
    </style> -->

</head>
<body>
    <img src="images/mcsa_logo.jpg" id="mcsa_logo" alt="MCSA_logo.jpg"/>
    <!--<img src="images/ymg_logo.jpg" id="ymg_logo" alt="YMG_logo.jpg"/> -->
    
    <img src="images/mcsa_banner.jpg" class="center" alt="MCSA_banner.jpg"/>
    <div class="text"><h1>Bethesda Methodist Mission</h1></div>
    <?php echo "<h2 style=\"text-align:center; color: #696969;\"> Number of seats available: $available_Seats </h2>" ?>

    <div class="form">
        <form action="reservations" method="POST">
            <input type="text" placeholder="name" name="firstname" id="firstname" required/>
            <input type="text" placeholder="surname" name="lastname" id="lastname" required/>
            <input type="text" placeholder="home address" name="homeaddress" id="homeaddress" required/>
            <input type="email" placeholder="email address" name="email" id="email" required/>
            <input type="text" placeholder="cell number" name="cell" id="cell" required/>
            <!--<input type="radio" value="Yes" name="symptomsyes" id="Yes" required/><label for="Yes">Yes</label> 
            
            
            <input type="text" placeholder="Have you (or anyone you've been in contact with) in the past 14 days been in close contact with a known probable case of COVID-19 infections?" name="question1" id="question1" readonly/> -->
            <div>
            <div style="font-family: verdana; font-weight: normal; color: #808080; font-size: 12px">
            Have you been in close contact with anyone known to have been infected with COVID-19?</div>
            <label style="font-family: verdana; font-weight: normal; font-size: 12px; color: #808080">
                <input type="radio" value="Yes" name="radio_q1"/>Yes
            </label> 
            <label style="font-family: verdana; font-weight: normal; font-size: 12px; color: #808080">
                <input type="radio" value="No" name="radio_q1" checked/>No
            </label>
            </div>
            <p></p>

            <div>
            <div style="font-family: verdana; font-weight: normal; color: #808080; font-size: 12px">
            Do you (or anyone you've been in close contact with) have any of the following symptoms 
            associated with COVID-19: cough, sore throat, shortness of breath, loss of taste or smell 
            or a fever (temp over 37.5C)? If yes, we humbly ask that you please stay at home.</div>
            
            <label style="font-family: verdana; font-weight: normal; font-size: 12px; color: #808080">
                <input type="radio" value="Yes" name="radio_q2"/>Yes
            </label> 
            <label style="font-family: verdana; font-weight: normal; font-size: 12px; color: #808080">
                <input type="radio" value="No" name="radio_q2" checked/>No
            </label>
            </div>
                    
         

           <!-- <table>
                <tr>
                    <th style="font-family: verdana; font-weight: bold; color: #808080; font-size: 17px">Resident Name</th>
                    <th style="font-family: verdana; font-weight: bold; color: #808080; font-size: 17px">Contact Number</th>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident" name="person1" id="person1" /></td>
                    <td><input type="text" placeholder="cell" name="cell1" id="cell1" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident" name="person2" id="person2" /></td>
                    <td><input type="text" placeholder="cell" name="cell2" id="cell2" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident" name="person3" id="person3" /></td>
                    <td><input type="text" placeholder="cell" name="cell3" id="cell3" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident" name="person4" id="person4" /></td>
                    <td><input type="text" placeholder="cell" name="cell4" id="cell4" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident" name="person5" id="person5" /></td>
                    <td><input type="text" placeholder="cell" name="cell5" id="cell5" /></td>
                </tr>
            </table> -->
            <button type="submit" name="book_btn">Reserve a seat</button>
            <p></p>
            <p></p>
            
        </form>
        

        <div style="font-family: verdana; font-weight: bold; color: #808080; font-size: 20px">To cancel a seat reservation <a href="cancelbooking">click here</a></div>
    </div>
</body>
</html>