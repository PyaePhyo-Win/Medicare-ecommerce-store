<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $supid=$_GET['supid'];

   $delete="DELETE FROM Suppliertb WHERE SupplierID='$supid'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Supplier is Successful.')</script>";
        echo "<script>window.location='Supplier.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Supplier Delete</p>";
   }

?>