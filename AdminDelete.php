<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $admid=$_GET['admid'];

   $delete="DELETE FROM Admintb WHERE AdminID='$admid'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Admin data is Successful.')</script>";
        echo "<script>window.location='AdminListings.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Admin Delete</p>";
   }

?>