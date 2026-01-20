<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $ptcode=$_GET['ptcode'];

   $delete="DELETE FROM PaymentTypetb WHERE PaymentTypeCode='$ptcode'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Payment Type is Successful.')</script>";
        echo "<script>window.location='PaymentType.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Payment Type Delete</p>";
   }

?>