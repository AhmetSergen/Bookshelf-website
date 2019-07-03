<?php
$userArray = array();

$servername = "localhost:3306";
$username = "ahmetboncuk";
$password = "ahmet-123*.7";
$dbname = "ahmetboncuk_okul";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$counter=0;
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $userArray[$counter][0]=$row["Username"];
		$userArray[$counter][1]=$row["Password"];
		$userArray[0][2]=$counter; // number of total users 
		
		$counter++;
    }
} else {
    echo "0 results";
}
$conn->close();

$userJSON = json_encode($userArray);
echo $userJSON;




?>