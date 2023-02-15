<html>

<head>
<title>Assgnment 1</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #bfff9380;
      color: #5d71dcc9
    }
  </style>
</head>

<?php
// Defining globals
$fNameErr = $lNameErr = "";
$fName = $lName = "";
// Check if server request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Checking validation of FirstName
  if (empty($_POST["fname"])) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name required";
  }
  // Check if name only contains letters and whitespace
  elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["fname"])) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name Not contains only alphabets";
  }
  // Checking validation of LastName
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

<body>
  <div class="fd-col">
    <span>
      <span class="banner-text">
        <?php
        if ($fNameErr === "" && $lNameErr === "") {
          echo "Welcome &nbsp" . $_POST["fname"] .
            "<h5> FORM SUCCESSFULLY SUBMITTED </h4><br>";
        } else
          echo "error:";
        echo $fNameErr;
        echo $lNameErr;
        ?>
      </span>
    </span>

  </div>



</body>

</html>