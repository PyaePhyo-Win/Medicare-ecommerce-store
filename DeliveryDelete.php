<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $deliid=$_GET['deliid'];

   $delete="DELETE FROM Deliverytb WHERE DeliveryID='$deliid'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Delivery Deletion is Successful.')</script>";
        echo "<script>window.location='Delivery.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Delivery Delete</p>";
   }

?>