<?php
session_start();
if(isset($_SESSION['userId'])){
    session_destroy();
    echo '<script>location.href="login.php"</script>';
}
else{

    echo '<script>location.href="index.php"</script>';
}


?>