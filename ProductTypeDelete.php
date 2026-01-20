<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $protcode=$_GET['protcode'];

   $delete="DELETE FROM ProductTypetb WHERE ProductTypeCode='$protcode'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Product Type is Successful.')</script>";
        echo "<script>window.location='ProductType.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Product Type Delete</p>";
   }

?>