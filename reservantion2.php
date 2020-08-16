<?php

//database connection
try {
    $serverhost = 'localhost:8889';
    $dbusername = 'root';
    $dbpassword = 'root';
    $dbname = 'bethesda';
    $conn = new PDO("mysql:host=$serverhost;dbname=$dbname", $dbusername, $dbpassword);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
//get HMTL form field values
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$email = $_POST['email'];
$cell = $_POST['cell'];
$streetaddress = $_POST['homeaddress'];
$residents = array($_POST['person1'], $_POST['cell1'], 
$_POST['person2'], $_POST['cell2'], $_POST['person3'], $_POST['cell3'], 
$_POST['person4'], $_POST['cell4'], $_POST['person5'], $_POST['cell5']);

$filtered_residents = array_filter($residents);

//this section builds the "VALUES" part of the INSERT statement. The plan is to plug this into 
//the INSERT just before it runs
$maxID='';
$new_insert_values = '';
for ($i=0; $i < count($filtered_residents); $i++) {
    //echo "(" .$filtered_residents[$i] . "," . $filtered_residents[$i+1] . "),". "<br>";
    $insert_values = ' (' . '\'' . $maxID . '\',' . '\''. $filtered_residents[$i] . '\'' . ',' . '\'' . $filtered_residents[$i+1] . '\'' . '),';
    $new_insert_values .= $insert_values;
    
    $i++;
}

$new_insert_values = substr($new_insert_values,0,strlen($new_insert_values)-1) . "\"";




/*$sql = 'SELECT lastname,
firstname,
jobtitle
FROM employees
ORDER BY lastname';

$q = $pdo->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC); */



?>