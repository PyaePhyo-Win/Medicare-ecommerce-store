<?php 

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
   echo "<script>window.alert('You can't delete data. Login Again!')</script>";
   echo "<script>window.location='AdminLogin.php'</script>";
}

   $promocode=$_GET['promocode'];
   $beautycode=$_GET['beautycode'];

   $delete="DELETE FROM Promotion_BeautyProducttb WHERE PromotionCode='$promocode' AND BeautyProductCode='$beautycode'";
   $query=mysqli_query($dbconnect,$delete);

   if ($query) {
   		echo "<script>window.alert('Deleting Assigned Promotion is Successful.')</script>";
        echo "<script>window.location='AssignPromotion.php'</script>";
   }
   else
   {
   		echo"<p>Something Went Wrong in Assigned Promotion Delete</p>";
   }

?>