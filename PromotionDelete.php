<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $promocode=$_GET['promocode'];

   $delete="DELETE FROM Promotiontb WHERE PromotionCode='$promocode'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Promotion is Successful.')</script>";
        echo "<script>window.location='Promotion.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Promotion Delete</p>";
   }

?>