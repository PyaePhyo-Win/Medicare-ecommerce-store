<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $beaprocode=$_GET['beaprocode'];

   $delete="DELETE FROM BeautyProducttb WHERE BeautyProductCode='$beaprocode'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Beauty Product is Successful.')</script>";
        echo "<script>window.location='BeautyProduct.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Beauty Product Delete</p>";
   }

?>