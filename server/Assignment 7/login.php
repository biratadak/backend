<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$userIdErr = $passErr = "";
$userId = $pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!empty($_POST["userId"]) && !empty($_POST["pass"]))
  
  
  if (empty($_POST["userId"])) {
    $userIdErr = "UserId is required";
  } else {
    $userId = test_input($_POST["userId"]);
    // check if userId only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$userId)) {
      $userIdErr = "Only letters and white space allowed";

    }
  }
  
  if (empty($_POST["pass"])) {
    $passErr = "Email is required";
  } else {
    $pass = test_input($_POST["pass"]);
  }
    
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Login Page</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="index.php">  
  User Id: <input type="text" name="userId" value="<?php echo $userId;?>">
  <span class="error">* <?php echo $userIdErr;?></span>
  <br><br>
  Password: <input type="text" name="pass" value="<?php echo $pass;?>">
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>
  
  <input type="submit" name="submit" value="Submit">  
</form>



</body>
</html>
