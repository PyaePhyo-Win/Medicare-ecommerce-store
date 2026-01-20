<?php 

session_start();

include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Add Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_POST['btnadd'])) {

	$promoname=$_POST['txtpromoname'];
	$promomonth=$_POST['cbopromomonth'];
	$promodesc=$_POST['txtpromodesc'];
	

	$promoid = 'PM_';
	$checkingrecentid = "SELECT MAX(RIGHT(PromotionCode, LENGTH(PromotionCode)-4)) AS RecentID FROM Promotiontb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$promonewid = (int)$recentid + 1;
	$promoid = $promoid.(str_pad($promonewid, 4, '0', STR_PAD_LEFT));

	$checksup="SELECT * FROM Promotiontb WHERE PromotionName='$promoname'";
	$checkresult=mysqli_query($dbconnect,$checksup);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Duplicate Promotion Name in Database')</script>";
		echo "<script>window.location='Promotion.php'</script>";
	}
	else{
	    $promoinsert="INSERT INTO Promotiontb(PromotionCode, PromotionName,
	    	PromotionMonth, PromotionDescription) 
					VALUES ('$promoid','$promoname','$promomonth','$promodesc')";
		$promoinsertquery=mysqli_query($dbconnect,$promoinsert);

		if ($promoinsertquery) {
			echo "<script>window.alert('Adding Promotion is Successful.')</script>";
		echo "<script>window.location='Promotion.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Promotion.')</script>";
		echo "<script>window.location='Promotion.php'</script>";
		}
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Promotion</title>
	<link rel="stylesheet" type="text/css" href="AdminStyle.css">
	<script src="https://kit.fontawesome.com/97dff553a5.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="admincontainer">
        <aside class="sidebar">
            <ul>
                <li>
                    <a href="AdminDashboard.php">
                    <i class="fas fa-home"></i>
                    <div class="title">Medicare E-commerce</div>
                    </a>
                </li>
                <li>
                    <a href="AdminDashboard.php">
                    <i class="fas fa-th-large"></i>
                    <div class="title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa-solid fa-people-group"></i>
                    <div class="title">Add Supplier</div>
                    </a>
                </li>
                <li>
                    <a href="ProductType.php">
                    <i class="fa-brands fa-product-hunt"></i>
                    <div class="title">Add ProductType</div>
                    </a>
                </li>
                <li>
                    <a href="Brand.php">
                    <i class="fa-solid fa-b"></i>
                    <div class="title">Add Brand</div>
                    </a>
                </li>
                <li>
                    <a href="BeautyProduct.php">
                    <i class="fa-solid fa-pills"></i>   
                    <div class="title">Add BeautyProduct</div>
                    </a>
                </li>
                <li>
                    <a href="SuppliedProduct.php">
                    <i class="fa-solid fa-boxes-packing"></i> 
                    <div class="title">Add SuppliedProduct</div>
                    </a>
                </li>
                <li>
                    <a href="Promotion.php">
                    <i class="fa-solid fa-percent"></i>   
                    <div class="title">Add Promotion</div>
                    </a>
                </li>
                <li>
                    <a href="AssignPromotion.php">
                    <i class="fa-solid fa-tags"></i>
                    <div class="title">Assign PromotionOnProduct</div>
                    </a>
                </li>
                <li>
                    <a href="PaymentType.php">
                    <i class="fa-solid fa-money-bill-1-wave"></i>
                    <div class="title">Add PaymentType</div>
                    </a>
                </li>
                <li>
                    <a href="Delivery.php">
                    <i class="fa-solid fa-truck"></i>   
                    <div class="title">Add Delivery</div>
                    </a>
                </li>
                <li>
                    <a href="AdminListings.php">
                    <i class="fa-brands fa-black-tie"></i>   
                    <div class="title">Admin Listings</div>
                    </a>
                </li>
                <li>
                    <a href="CustomerListing.php">
                    <i class="fa-brands fa-black-tie"></i>   
                    <div class="title">Customer Listings</div>
                    </a>
                </li>
                <li>
                    <a href="AdminLogout.php">
                    <i class='fa-solid fa-right-from-bracket'></i>  
                    <div class="title">Logout</div>
                    </a>
                </li>
            </ul>
        </aside>
        <main class="main">

            <header class="admin-top-bar">

                <div class="searchbar">
                    <input type="text" name="search" placeholder="Search here">
                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                </div>

                <i class="fa-solid fa-bell"></i>

                <div class="user-admin">
                    <i class="fa-solid fa-user"></i>
					<div class="name"><?php echo $AUN ?></div>
                </div>

            </header>

		<div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Add Promotion</h1>

					<form action="Promotion.php" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="supname">Promotion Name</label><br>
								<input type="text" id="supname" name="txtpromoname" placeholder="Enter Promotion Name" required><br>

								<label for="promomonth">Choose Promotion Month</label>
                                <select name="cbopromomonth" id="promomonth">
                                    <option>Select Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>

								<label for="promodesc">Promotion Description</label><br>
								<input type="text" id="promodesc" name="txtpromodesc" placeholder="Enter Promotion Description" required><br>
							
							</div>

						</div>
					
						<div class="Supform-button">
							<input type="submit" name="btnadd" value="ADD">
						</div>

					</form>
			</div>

		</div>
			<div class="admin-tables">

				<div class="supplier">

					<div class="heading">
						<h2>Promotion Lists</h2>
					</div>

						<table class="tbl-supplier">

							<thead>
								<td>Promotion Code</td>
								<td>Promotion Name</td>
								<td>Promotion Month</td>
								<td>Promotion Description</td>
								<td>Action</td>
							</thead>
							<?php 

								$promoselect="SELECT * FROM Promotiontb";
								$result=mysqli_query($dbconnect,$promoselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$promocode=$array['PromotionCode'];
									$promoname=$array['PromotionName'];
									$promomonth=$array['PromotionMonth'];
									$promodesc=$array['PromotionDescription'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$promocode</td>";
									echo "<td>$promoname</td>";
									echo "<td>$promomonth</td>";
									echo "<td>$promodesc</td>";
									echo "<td>
									
									<a href='PromotionUpdate.php?promocode=$promocode'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='PromotionDelete.php?promocode=$promocode'><i class='fa-solid fa-trash'></i></a>

									</td>";

									echo "</tr>";
									echo "</tbody>";

								}

							?>





						</table>
					
				</div>

			</div>
            
            <footer class="admin-footer">
                <p>Copyright © 2024 Medicare. All rights reserved. Created by PPW.</p>
            </footer>

		</main>
</div>

</body>
</html>