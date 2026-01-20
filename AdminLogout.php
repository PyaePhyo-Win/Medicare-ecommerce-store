<?php 

session_start();

unset($_SESSION['AID']);

session_destroy();

if (isset($_SESSION['AID'])) {
	echo "Error";
}
else{
	echo "<script>window.alert('Logout Successful')</script>";
echo "<script>window.location='AdminLogin.php'</script>";
}


?>