<?php
session_start();
require('features.php');



$f=new features();
$f->setPDF($_SESSION['name'],$_SESSION['mailId'],$_SESSION['marks'],$_SESSION['phoneNo'],"../uploaded_Images/".$_SESSION['imagePath']);
$f->getPDF();
?>