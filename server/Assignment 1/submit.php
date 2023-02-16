<!-- SERVER SIDE CODE -->
<html>

<head>
  <title>Assgnment 1</title>
  <link rel="stylesheet" href="../stylesheet/style.css">
</head>

<?php
include("../class/person.php");
include("../class/features.php");
// Defining globals
$user = new person($_POST['fname'], $_POST['lname']);
$feature = new features();
$fNameErr = $lNameErr = "";
// Check if server request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Checking validation of FirstName
  if (empty($user->getFName())) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name required";
  }
  // Check if name only contains letters and whitespace
  elseif (!$feature->onlyAlpha($user->getFName())) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name Not contains only alphabets";
  }
  // Checking validation of LastName
  if (empty($user->getLName())) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $lNameErr = "<br>Last Name required";
  }
  // Check if name only contains letters and whitespace
  elseif (!$feature->onlyAlpha($user->getLName())) {
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
        //If fName and lName fields are filled then show Welcome text
        if ($fNameErr === "" && $lNameErr === "") {
          echo "Welcome &nbsp" . $user->getFName() .
            "<h5> FORM SUCCESSFULLY SUBMITTED </h4><br>";
        }

        //If fName or lName is not filled then show error
        else {
          echo "error:";
          echo $fNameErr;
          echo $lNameErr;
        }
        ?>
      </span>
    </span>

  </div>

</body>

</html>