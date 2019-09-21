<!DOCTYPE html>
<html>
<head>
	<style>
.error {color: rgb(229, 255, 0);
padding: auto;}

</style>
	<title>Register</title>
	<link rel="icon" href="registeric.png">
	<link rel="stylesheet" type="text/css" href="register2.css">
</head>
<body>
	<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $mobileErr =$passwordErr= "";
$name = $email = $gender =  $mobile =$password= $cpassword=$institute= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }

if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
if (empty($_POST["mobile"])) {
    $mobileErr = "Mobile no. is required";
  } else {
    $mobile = test_input($_POST["mobile"]);
    if (!preg_match("/^[0-9]*$/",$mobile)) {
      $mobileErr = "Invalid mobile no."; 
    }
  }
  if(empty($_POST["password"])){
  	$passwordErr= "password not enterd";
  }
  else{
  	$password = test_input($_POST["password"]);
  	$cpassword = test_input($_POST["cpassword"]);
  	
  	if($password!==$cpassword)
  	{
  		$passwordErr= "confirm password and password is not same";
  	}
  }
  if(empty($_POST["institute"]))
  {
    $institute="";
  }
  else{
    $institute=test_input($_POST["institute"]);
  }  


if(($nameErr==null)and($emailErr==null)and($mobileErr==null)and($passwordErr==null)and($genderErr==null)){
$servername = 'localhost';
$username = 'root';
$pass = '';
$dbname = 'register';


// Create connection
$conn = mysqli_connect($servername,$username, $pass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO register (Username, Password, Email,Mobile,Institute,Gender)
VALUES ('$name', '$password', '$email','$mobile','$institute','$gender')";

$sqli = "INSERT INTO events (Username)
VALUES('$name')";

if ((mysqli_query($conn, $sql))and(mysqli_query($conn, $sqli)) ){
    header("refresh:2;url=rstsuc.html");
} else {
   
  echo '<script type="text/javascript">alert("Username is already registered")</script>';
}

mysqli_close($conn);

}
}
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<form class="Register" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<img width="250px" src="registerlogo1.gif" width="80px" height="80px">
	
	<input id="name" type="text" value="<?php echo $name;?>" name="name" placeholder="enter username"><br><center class="error">* <?php echo $nameErr;?></center>
	<br>

	<input type="text" name="gender"value="<?php echo $gender;?>" id="gender" placeholder="gender"><center class="error">*<?php echo $genderErr;?></center><br>

	<input type="text" name="institute" value="<?php echo $institute;?>" id="city" placeholder="enter institute name"><br><br><br>

	<input type="e-mail" name="email" value="<?php echo $email;?>" id="email" placeholder="email address "><center class="error">* <?php echo $emailErr;?></center>	<br>
	
	<input type="text" value="<?php echo $mobile;?>" name="mobile" id="phno" placeholder="mobile number"><center class="error">* <?php echo $mobileErr;?></center><br>
	
	<input type="password" name="password" id="cpassword" placeholder="create password"><center class="error">*<?php echo $passwordErr;?></center><br>
	
	<input type="password" name="cpassword" id="copassword" placeholder="confirm password"><br><p class="error">*required condition</p>

	<input id="submit" type="submit" name="submit"value="Register" >

</form>
</body>
</html>