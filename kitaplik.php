
<?php

//Ekleme değişkenleri
$kitapAd = $_POST["kitapisim"];
$kitapYazar = $_POST["kitapyazar"];
$kitapYayinEvi = $_POST["kitapyayinevi"];
//Çıkarma değişkeni
$kitapNum = $_POST["kitapnum"];
// Variables are always get set even strings from textboxes are empty. Means they couldn't be NULL but they could be empty.

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
if(!empty($kitapAd)){
    $sql = "INSERT INTO Kutuphane (KitapAd, KitapYazar, KitapYayinEvi)
    VALUES ('".$kitapAd."', '".$kitapYazar."', '".$kitapYayinEvi."')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully : ".$kitapAd.", ".$kitapYazar.", ".$kitapYayinEvi." |";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if(!empty($kitapNum)){ //kitapNum değişkeni null değil ise
    $sql = "DELETE FROM Kutuphane WHERE KitapNum=".$kitapNum  ;

    if ($conn->query($sql) === TRUE) {
        echo "A record has beed deleted : ".$kitapNum." |";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

echo '<script>window.location.href = "main.php";</script>';

?>