<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $supdcode=$_GET['supdcode'];

   $delete="DELETE FROM Supplier_BeautyProducttb WHERE SuppliedCode='$supdcode'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Supplied Product is Successful.')</script>";
        echo "<script>window.location='SuppliedProduct.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Supplied Product Delete</p>";
   }

?>