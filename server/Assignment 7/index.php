<?php
$ID="admin";
$PASSWORD="password";
session_start();

if(isset($_SESSION['userId'])){
    echo "<h1>WELCOME ".$_SESSION['userId']."</h1>";
    echo "<a href='http://php.nginx/Assignment%201/index.html'>A1</a><br>";
    echo "<a href='http://php.nginx/Assignment%202/index.html'>A2</a><br>";
    echo "<a href='http://php.nginx/Assignment%203/index.html'>A3</a><br>";
    echo "<a href='http://php.nginx/Assignment%204/index.html'>A4</a><br>";
    echo "<a href='http://php.nginx/Assignment%205/index.html'>A5</a><br>";
    echo "<a href='http://php.nginx/Assignment%206/index.html'>A6</a><br>";
    echo "<a href='logout.php'><input type=button value='Logout' name='logout'></a>";
    

}


else{
if($_POST['userId']==$ID && $_POST['pass']==$PASSWORD)
    {
        $_SESSION['userId']=$ID;
        echo '<script>location.href="index.php"</script>';

    }
else
    echo "get lost";


}
?>