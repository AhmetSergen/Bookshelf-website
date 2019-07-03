<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>Kitaplık Giriş Sayfası</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@font-face {
  font-family: "Scretch";
  src: url(Scretch.TTF) format("truetype");
}
body, html {
  background-color:#aaa;
  height: 100%;
  margin: 0;
}
p{

margin:2vw;
margin-left:4vw;
position:absolute;
}

input[type=submit]{
	position:absolute;
	margin-left:4vw;
	border-radius:12px;
	background: transparent;
	padding: 15px 20px;
	width:10vw;
	min-width:70px;
}
input[type=text],input[type=password]{
	
	width:30vw;
	border-radius:8px;
	border:none;
	background: transparent;
	border-bottom: 2px solid;
	height:40px;
	transition:0.2s
}
input[type=text]:hover ,input[type=password]:hover {
	border-bottom: 5px solid;
}
#bg {
  background-image: url("page1.png");
  height: 100%; 
  min-height:300px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
#container{
	
	position:absolute;
	width:50%;
	max-width:500px;
	max-height:300px;
	height:60%;
	right:25%;
	top:20%;
}
h1{
    position:absolute;
    font-family:"Scretch";
    top:calc(12px + 1vw);
    left:30%;
    font-size:calc(30px + 1vw);
    font-weight:500;
}

@media only screen and (min-width: 1024px) {
    h1{
    position:absolute;
    font-family:"Scretch";
    top:30%;
    left:10%;
    font-size:calc(30px + 2vw);
    font-weight:500;
    }
}
@media only screen and (min-width: 1200px) {
     h1{
    position:absolute;
    font-family:"Scretch";
    top:30%;
    left:10%;
    font-size:calc(30px + 4vw);
    font-weight:500;
    }
}
</style>
</head>

<body>

<div id="bg">
    
    <h1>KiTAPLIK</h1>
    
	<div id="container">
	<img src="page2.png" style="min-height:250px; height:100%; width:100%;margin:0;">
		
		<p style="top:0.5vw;">Kullanici Adi:<br><input id="user" type="text" name="username"></p>
		<p style="top:70px; ">Parola: <br><input id="pass" type="password" name="password"></p>
		<input id="button" style="top:165px;" type="submit" value="Giriş" onclick="Check()"> 
		<p style="top:190px;color:#900000;" id="error"></p>
		
		
	</div>
	
</div>




<script>


//get json data ajax
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var myObj = JSON.parse(this.responseText);
	
	
    //document.getElementById("error").innerHTML =  myObj;
  }
};
xmlhttp.open("GET", "login.php", true);
xmlhttp.send(); 

function Check(){
var userName = document.getElementById("user").value;
var passWord = document.getElementById("pass").value;


	if(userName && passWord){ //if textboxes are not null
		//get json data ajax
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myObj = JSON.parse(this.responseText);
			
			for(var i=0 ; i <= myObj[0][2] ; i++){
				if(myObj[i][0]==userName){
					if(myObj[i][1]==passWord){ window.location.href = "main.php";  } //sayfaya yönlendir
					else{document.getElementById("error").innerHTML="Yanlış Bilgi girdiniz";}
				}else{document.getElementById("error").innerHTML="Yanlış Bilgi girdiniz";}	
			}
			
	    }
		};
    xmlhttp.open("GET", "login.php", true);
    xmlhttp.send(); 
	
	
	}
	else{
		document.getElementById("error").innerHTML = "Lütfen tüm kutucukları doldurunuz."
	}



}


</script>
<?php
//$_SESSION["userName"] = "<script> document.getElementById('user').value; </script>";
$_SESSION["userName"] = "Ahmet"
?>
</body>
</html>
