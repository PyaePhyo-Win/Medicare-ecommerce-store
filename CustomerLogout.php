<?php 

session_start();

unset($_SESSION['CID']);

session_destroy();

if (isset($_SESSION['CID'])) {
	echo "Error";
}
else{
	echo "<script>window.alert('Logout Successful')</script>";
echo "<script>window.location='homepage.php'</script>";
}


?>