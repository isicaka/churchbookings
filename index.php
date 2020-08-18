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
    <div class="form">
        <form action="reservations" method="POST">
            <input type="text" placeholder="name" name="firstname" id="firstname" required/>
            <input type="text" placeholder="surname" name="lastname" id="lastname" required/>
            <input type="text" placeholder="home address" name="homeaddress" id="homeaddress" required/>
            <input type="email" placeholder="email address" name="email" id="email" required/>
            <input type="text" placeholder="cell number" name="cell" id="cell" required/>
            <table>
                <tr>
                    <th>Resident Name</th>
                    <th>Contact Number</th>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident 1" name="person1" id="person1" /></td>
                    <td><input type="text" placeholder="cell" name="cell1" id="cell1" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident 2" name="person2" id="person2" /></td>
                    <td><input type="text" placeholder="cell" name="cell2" id="cell2" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident 3" name="person3" id="person3" /></td>
                    <td><input type="text" placeholder="cell" name="cell3" id="cell3" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident 4" name="person4" id="person4" /></td>
                    <td><input type="text" placeholder="cell" name="cell4" id="cell4" /></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Resident 5" name="person5" id="person5" /></td>
                    <td><input type="text" placeholder="cell" name="cell5" id="cell5" /></td>
                </tr>
            </table>
            <button type="submit">Reserve a seat</button>
        </form>
    </div>
</body>
</html>