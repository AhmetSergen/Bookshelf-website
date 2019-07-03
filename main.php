<?php
session_start();
?>
<!DOCTYPE HTML>

<html>

<head>
	<title>Kütüphane</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body onload="javascript:Refresh()">


<style>
@font-face {
  font-family: "TheShaker";
  src: url(TheShaker.ttf) format("truetype");
}
@font-face {
  font-family: "Scretch";
  src: url(Scretch.TTF) format("truetype");
}
@font-face {
  font-family: "Goodvibe";
  src: url(Goodvibe.ttf) format("truetype");
}

p{
	font-family:"TheShaker";
}
#header{
	width:100%;
	height:10vw;
 	min-height: 120px;
	margin:0;
	border:0;
	padding:0;
}
#title{
	font-family:"Scretch";
	font-size:calc(20px + 3vw);
	position: absolute;
  	top: 50px;
  	left: 25%;
  	transform: translate(-50%, -50%);
}

#navbar{
	position:absolute;
	width:100%;
	height:50px;
	margin:0;
	border:0;
	padding:0;
	left:1%;
	float:left;
	z-index:-1;
} 
#navbar input{
width:35%;
}

#dropdown{
	position: absolute;
	width:55%;
	height:99%;
    min-height: 950px;
	margin:0;
	border:0;	
	padding:0;
	left:40%;
    top: -850px;
	transition: .5s ease-out
}
#dropdownbottomheader{
	font-family:"TheShaker";
	font-size:calc(5px + 3vw);
	position: absolute;
	bottom: -40px;
	left: 5vw;
	min-height: 80px;
}
.dropdownheader{
	font-family:"Goodvibe";
	position:absolute;
	font-size:calc(5px + 3vw);
	text-align:center;
	top:0;
	font-weight:bold;
}
.dropdownheader2{
	font-family:"Goodvibe";
	position:absolute;
	font-size:calc(5px + 3vw);
	text-align:center;
	font-weight:bold;
	
}
#dropdown:hover{
	top: 0;
}
.dropdowntext{
	position:absolute;
	margin-bottom:0;
	margin-top:1px;
}
form{
	font-family:"TheShaker";
	font-size:calc(8px + 1.5vw);
	position:absolute;
	width:100%;
	left:10%;
	top:0;
}

input[type=submit]{
	margin-top:10px;
	border-radius:12px;
	
	background: transparent;
}
input[type=text]{
    font-family:"Times New Roman";
	width:50%;
	border-radius:8px;
	border:none;
	background: transparent;
	border-bottom: 2px solid;
	height:40px;
	transition:0.2s
}
input[type=text]:hover {
	border-bottom: 5px solid;
}
h2{
    font-family: "TheShaker";
    font-weight:700;
}
h6{
    position:absolute;
    font-family:"TheShaker";
    top:2px;
    left:3vw;
    font-size:15px;
}
#container{
	background-color:#aaa;
	position:absolute;
	top:220px;
	width:100%;
	z-index:-1;
}
.w3-third{
    float:left;
}
</style>

<body style="background-color:#aaa;margin:0;">

	<div id="header">
		<img src="header.png" id="header"> 
		<h1 id="title">KITAPLIK</h1>
		<h6 id="username"></h6>
	</div>
	
	<div id="dropdown">
		<img src="dropdown.png" style="height:100%; width:100%; bottom:0;">
		<p id="dropdownbottomheader">Kitapligi Duzenle </p>
		
		<form action="kitaplik.php" method="post">
			<h1 class="dropdownheader">Kitap Ekle</h1><br><br>
			Kitap Ismi <br><input type="text" name="kitapisim" autocomplete="off"><br>
			Kitap Yazari <br><input type="text" name="kitapyazar" autocomplete="off"><br>
			Kitap Yayin Evi <br><input type="text" name="kitapyayinevi" autocomplete="off"><br>
			<span class="dropdownheader2">Kitap Çikar</span><br><br>
			Kitap Numarasi <br><input type="text" name="kitapnum" autocomplete="off"><br>
			<input type="submit" value="Tamam" >
		</form>
	</div>
	
	<div id="navbar">
		<input id="searchbar" type="text" name="arama" placeholder="Kitap İsmi Aratın" onkeyup="Refresh()" autocomplete="off">
		<span id="error" style="color:#900000;"> <span>
	</div>
	
	<div id="container">
		<div id="contentArea" class="w3-row-padding">
			<!-- İçerik buraya yerleşecek -->
		</div>
	</div>
	
<!-- PHP MySQL start-->
<?php

$servername = "localhost:3306";
$username = "ahmetboncuk";
$password = "ahmet-123*.7";
$dbname = "ahmetboncuk_okul";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die('<script>document.getElementById("error").style.display = "inline";'
	     .'document.getElementById("error").innerHTML = '
		 .'"Connection failed: '.$conn->connect_error .' "; </script>');
	     
	
}

$sql = "SELECT * FROM Kutuphane";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
	//prepare json file for writing
	$fileName = "json_data.txt"; 
	$x = count($file_content); 
	$file_content = file($fileName); 
	$myfile = fopen($fileName, "w") or die("Unable to open file!");
	
	$jsonHead = ' {"contents":[ ';
	fwrite($myfile, $jsonHead);
	
	$counter = 0; //to count fetched rows
    // output data of each row and write to json text file
    while($row = $result->fetch_assoc()) {
		
	    //Ekleme değişkenleri
		$kitapAd= $row["KitapAd"] ;
		$kitapYazar = $row["KitapYazar"];
		$kitapYayinEvi = $row["KitapYayinEvi"] ;
		//Çıkarma değişkeni
	    $kitapNum = $row["KitapNum"];
		
		//write data to json file
		$txt = '{"kitapAd":"'.$kitapAd.'","kitapYazar":"'.$kitapYazar.'", "kitapYayinEvi":"'.$kitapYayinEvi.'","kitapNum":"'.$kitapNum.'" }';
		fwrite($myfile, $txt);
		
		$counter++; //one row fetched
		
		if($result->num_rows != $counter ){ //if it was not last row
		    fwrite($myfile, ',');
		}
   
    }

	$jsonTail = ' ]} '; //do when fetching ends
	fwrite($myfile, $jsonTail);
	
	fclose($myfile);
}   
else{
    //prepare json file for writing
	$fileName = "json_data.txt"; 
	$x = count($file_content); 
	$file_content = file($fileName); 
	$myfile = fopen($fileName, "w") or die("Unable to open file!");
	fwrite($myfile, "No Data");
	fclose($myfile);
	
}

$conn->close();

?> <!-- PHP MySQL end -->

<?php
echo "<script>document.getElementById('username').innerHTML = 'Hoşgeldin ". $_SESSION["userName"]."';</script>" ;
?>

<script>
function Refresh(){
    var i;
    var myObj;
    var filter = document.getElementById("searchbar").value;
    
    document.getElementById("contentArea").innerHTML = " "; //clear content area
    
    if(filter){ //if filter is not null ,
    var resultCounter=0;
    //document.getElementById("error").innerHTML="filter is not null";
    
    
        var filterLen = filter.length;
        filter=filter.toUpperCase();
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
        
   
                for (i in myObj.contents) { // Get book name from every JSON array value 
                    var kitapAd = myObj.contents[i].kitapAd ;
                    kitapAd = kitapAd.toUpperCase();
                    kitapAd = kitapAd.substring(0, filterLen);
                    
                    if(kitapAd == filter){ // show them on page
                        document.getElementById("error").innerHTML = " ";
	                    document.getElementById("contentArea").innerHTML += "<div class='w3-third'>"+
																	"<h2 id='"+myObj.contents[i].kitapNum+"kitapAd'>&nbsp;"+myObj.contents[i].kitapAd+"</h2>"+
																	"<p id='"+myObj.contents[i].kitapNum+"kitapYazar'>&nbsp;"+myObj.contents[i].kitapYazar+"</p>"+
																	"<p id='"+myObj.contents[i].kitapNum+"kitapYayinEvi'>&nbsp;"+myObj.contents[i].kitapYayinEvi+"</p>"+
																	"<p id='"+myObj.contents[i].kitapNum+"kitapNum'>KitapNum:"+myObj.contents[i].kitapNum+" </p>"+
															        "</div>"; 
                    resultCounter++;
                    }
	            }
	            document.getElementById("error").innerHTML = resultCounter+" Sonuç bulundu.";
            }
        };
        xmlhttp.open("GET", "json_data.txt", true);
        xmlhttp.send();
    }
        
    
    else{ // if filter is null, get all JSON data
        //document.getElementById("error").innerHTML="filter is null";
        document.getElementById("error").innerHTML = ""; 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
        
                
                for (i in myObj.contents) { // show them on page
	                document.getElementById("contentArea").innerHTML +=  "<div class='w3-third'>"+
																	"<h2 id='"+myObj.contents[i].kitapNum+"kitapAd'>&nbsp;"+myObj.contents[i].kitapAd+"</h2>"+
																	"<p id='"+myObj.contents[i].kitapNum+"kitapYazar'>&nbsp; "+myObj.contents[i].kitapYazar+"</p>"+
																	"<p id='"+myObj.contents[i].kitapNum+"kitapYayinEvi'>&nbsp;"+myObj.contents[i].kitapYayinEvi+"</p>"+
																	"<p id='"+myObj.contents[i].kitapNum+"kitapNum'>KitapNum:"+myObj.contents[i].kitapNum+" </p>"+
														        	"</div>"; 
	            }
            }
        };
    xmlhttp.open("GET", "json_data.txt", true);
    xmlhttp.send();
    }
}




 
 
</script>
</body>

</html>
