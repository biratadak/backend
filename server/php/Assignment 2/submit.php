<!-- SERVER SIDE CODE -->
<?php
// setcookie("user1","veer",time()+3,"/");
// setcookie("user2","vr",time()+9,"/");
// setcookie("user3","ver",time()+6,"/");
?>
<html>
<head>
<title>Assgnment 2</title>
  <link rel="stylesheet" href="style.css">
</head>

<?php
// Defining globals
$fNameErr = $lNameErr = "";
// $fName = $lName = "";
// Check if server request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the FirstName is empty.
  if (empty($_POST["fname"])) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name required";
  }
  // Check if name only contains letters and whitespace
  elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["fname"])) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name Not contains only alphabets";
  }
  // Check if the LastName is empty.
  if (empty($_POST["lname"])) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $lNameErr = "<br>Last Name required";
  }
  // Check if name only contains letters and whitespace
  elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["lname"])) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $lNameErr = "<br>Last Name Not contains only alphabets";
  }
}
?>

<!-- Image upload script -->
<?php
if(!empty($_FILES['pic']['name'])){
  $file_name=$_FILES['pic']["name"];
  $file_size=$_FILES['pic']["size"];
  $file_temp=$_FILES['pic']["tmp_name"];
  $file_type=$_FILES['pic']["type"];
  move_uploaded_file($file_temp,"uploaded_Images/".$file_name );
}
else
  $file_name="default.png";
?>

<body>
  <div class="ID">
    <div class="profile-pic">
      <img src="uploaded_Images/<?php echo  $file_name; ?>" alt="">
    </div>
    <h4 class="fullname">
      <?php echo $_POST["fname"]." ".$_POST["lname"]; ?>

    </h4>
  </div>
  <div class="fd-col">
    <span>
      <span class="banner-text">
        <?php
        if ($fNameErr === "" && $lNameErr === "") {
          echo "Welcome &nbsp" . $_POST["fname"] .
            "<h5> FORM SUCCESSFULLY SUBMITTED </h4><br>";
        } 
        else{

          echo "error:";
          echo $fNameErr;
          echo $lNameErr;
        }
          // print_r($_COOKIE);
          // echo ;
        ?>
      </span>
    </span>
  </div>
</body>

</html>