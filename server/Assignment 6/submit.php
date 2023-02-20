<!-- SERVER SIDE CODE -->
<?php session_start(); ?>
<html>

<head>
  <title>Assgnment 6</title>
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
  // Check if the FirstName is empty.
  if (empty($user->getFName())) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name required";
  }
  // Check if name only contains letters and whitespace
  elseif (!$feature->onlyAlpha($user->getFName())) {
    echo '<body style="background-color:#ff540069;color:Red">';
    $fNameErr = "<br>First Name Not contains only alphabets";
  }
  // Check if the LastName is empty.
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

<!-- Image upload script -->
<?php
// If image field is not empty show the provided image
if (!empty($_FILES['pic']['name'])) {
  $file_name = $_FILES['pic']["name"];
  $file_size = $_FILES['pic']["size"];
  $file_temp = $_FILES['pic']["tmp_name"];
  $file_type = $_FILES['pic']["type"];
  move_uploaded_file($file_temp, "../uploaded_Images/" . $file_name);
}
// If image field is empty then show the default image
else
  $file_name = "default.jpeg";
?>

<body>
  <!-- Details field that holds the Profile-pic and welcome text -->
  <div class="details">
    <!-- ID field only holds Profile-pic and fullname -->
    <div class="ID">
      <?php
      if (!empty($_FILES['pic']['name']) && $fNameErr === "" && $lNameErr === "") {
        if ($feature->validImage($file_size, $file_type)) {
          echo '<div class="profile-pic">';
          echo '<img src="../uploaded_Images/' . $file_name . '">';
          echo '</div>';
          echo '<h4 class="fullname">';
          echo $user->getFullName();
          echo '</h4>';
        } else
          echo "<br>Image not valid";
      } else {
        echo '<div class="profile-pic">';
        echo '<img src="../uploaded_Images/default.png">';
        echo '</div>';
      }
      ?>

    </div>
    <!-- This field only contains the welcome texts or errors -->
    <div class=" fd-col">
      <span class="banner-text">
        <?php
        if ($fNameErr === "" && $lNameErr === "") {
          echo "<br>Welcome &nbsp" . $user->getFName() .
            "<h5> FORM SUCCESSFULLY SUBMITTED </h4><br>";
        } else {
          echo "error:";
          echo $fNameErr;
          echo $lNameErr;
        }
        ?>
      </span>
    </div>
  </div>

  <!-- Marks Table section -->
  <?php
  $user->setMarks($_POST['marks']);
  ?>
  <div class="marks-table">
    <table>

      <?php
      // Taking a flag value to enable/disable marksheet download button
      $marksFlag = 0;
      // Checking If names are Filled
      if ($fNameErr === "" && $lNameErr === "") {
        // Checking marks field is not field 
        if (!empty($user->getMarks())) {
          echo "<tr>  
    <td>Subject</td>  
    <td>Marks</td>  
    </tr>";
          // Getting all values from textarea line-by-line
          foreach ($feature->splitMarks($user->getMarks()) as $marks) {
            echo "<tr>";
            // Check for Subject validation
            if ($feature->onlyAlpha($marks[0])) {
              echo "<td>$marks[0]</td>";
            } else {
              $marksFlag = 1;
              echo "<td class='error'>Subject should be Alphabetic </td>";
            }
            // Check for marks validation
            if (is_numeric($marks[1])) {
              echo "<td> $marks[1]</td>";
            } else {
              $marksFlag = 1;
              echo "<td class='error'>Marks should be in only Digit </td>";
            }
            echo "</tr>";
          }
        }
        // Display message if marks field is empty
        else {
          $marksFlag = 1;
          echo "<i>-Marksheet not found-</i>";
        }
      }
      ?>
    </table>
  </div>

  <!-- Phone No validation -->
  <?php
  $user->setPhoneNo($_POST['phoneNo']);
  if ($feature->validPhoneNo($user->getPhoneNo()))
    echo "<br>Phone Number is: " . $user->getPhoneNo();
  else
    echo "<div class='error'><br>Error: Invalid phone number</div>";
  ?>

  <!-- Email  validation -->

  <!-- Only format check using RegEx -->
  <?php
  $user->setMailId($_POST['mailId']);
  if ($feature->validMailId1($user->getMailId()))
    echo "<br>Mail Id is: " . $user->getMailId();
  else
    echo "<div class='error'><br>Invalid E-Mail Id</div>";
  ?>

  <!-- Checking format, mx-server, smtp, and deliverablity score for the mail -->
  <!-- <?php
  $user->setMailId($_POST['mailId']);
  if ($feature->validMailId1($user->getMailId()))
    echo "<br>Mail Id is: " . $user->getMailId();
  else
    echo "<div class='error'><br>Invalid E-Mail Id</div>";
  ?> -->

  <!-- PDF Download section -->
  <?php
  if (isset($_POST['downloadPdf'])) {

    if ($marksFlag) {
      echo "<div class='error'><br>Fix Marks syntax to print it</div>";
    } else {
      $_SESSION['name'] = $user->getFullName();
      $_SESSION['mailId'] = $user->getMailId();
      $_SESSION['phoneNo'] = $user->getPhoneNo();
      $_SESSION['imagePath'] = $file_name;
      $_SESSION['marks'] = $feature->splitMarks($user->getMarks());
      echo '<a class="pdf-btn" href="http://php.nginx/class/newPage.php">DOWNLOAD PDF</a>';

    }
  }
  ?>
</body>

</html>