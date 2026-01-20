<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $brcode=$_GET['brcode'];

   $delete="DELETE FROM Brandtb WHERE BrandCode='$brcode'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Brand is Successful.')</script>";
        echo "<script>window.location='Brand.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Brand Delete</p>";
   }

?>