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

	$deliname=$_POST['txtdeliname'];
	$deliphone=$_POST['txtdeliphone'];
	$deliemail=$_POST['txtdeliemail'];
	$deliaddress=$_POST['txtdeliaddress'];

	// Auto Increment ID for Delivery
	$deliid = 'Del_';
	$checkingrecentid = "SELECT MAX(RIGHT(DeliveryID, LENGTH(DeliveryID)-4)) AS RecentID FROM Deliverytb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$delinewid = (int)$recentid + 1;
	$deliid = $deliid.(str_pad($delinewid, 4, '0', STR_PAD_LEFT));

	$checkdeli="SELECT * FROM Deliverytb WHERE DeliveryName='$deliname'";
	$checkresult=mysqli_query($dbconnect,$checkdeli);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Duplicate Delivery Name in Database')</script>";
		echo "<script>window.location='Delivery.php'</script>";
	}
	else{
	    $deliinsert="INSERT INTO Deliverytb(DeliveryID, DeliveryName,
	    	DeliveryPhone, DeliveryEmail, DeliveryOfficeAddress	) 
					VALUES ('$deliid','$deliname','$deliphone','$deliemail','$deliaddress')";
		$deliinsertquery=mysqli_query($dbconnect,$deliinsert);

		if ($deliinsertquery) {
			echo "<script>window.alert('Adding Delivery is Successful.')</script>";
		echo "<script>window.location='Delivery.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Delivery.')</script>";
		echo "<script>window.location='Delivery.php'</script>";
		}
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Delivery</title>
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
                    <a href="Supplier.php">
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
                    <a href="#">
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

					<h1 class="title-form">Add Delivery</h1>

					<form action="Delivery.php" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="deliname">Delivery Name</label><br>
								<input type="text" id="deliname" name="txtdeliname" placeholder="Enter Delivery Name" required><br>

								<label for="deliphone">Delivery Phone</label><br>
								<input type="text" id="deliphone" name="txtdeliphone" placeholder="Enter Delivery Phone Number" required><br>

								<label for="delieamil">Delivery Email</label><br>
								<input type="email" id="deliemail" name="txtdeliemail" placeholder="Enter Delivery Email" required><br>

								<label for="deliaddress">Delivery Address</label><br>
								<input type="text" id="deliaddress" name="txtdeliaddress" placeholder="Enter Delivery Address" required><br>
							
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
						<h2>Delivery Lists</h2>
					</div>

					<table class="tbl-supplier">
						<thead>
						
							<td>Delivery ID</td>
							<td>Delivery Name</td>
							<td>Delivery Phone</td>
							<td>Delivery Email</td>
							<td>Delivery Address</td>
							<td>Action</td>
						
						</thead>
						<?php 

							$deliselect="SELECT * FROM Deliverytb";
							$result=mysqli_query($dbconnect,$deliselect);
							$count=mysqli_num_rows($result);

							for ($i=0; $i <$count ; $i++) 
							{ 
								$array=mysqli_fetch_array($result);
								$deliid=$array['DeliveryID'];
								$deliname=$array['DeliveryName'];
								$deliphone=$array['DeliveryPhone'];
								$deliemail=$array['DeliveryEmail'];
								$deliaddress=$array['DeliveryOfficeAddress'];

								echo "<tbody>";
								echo "<tr>";

								echo "<td>$deliid</td>";
								echo "<td>$deliname</td>";
								echo "<td>$deliphone</td>";
								echo "<td>$deliemail</td>";
								echo "<td>$deliaddress</td>";
								echo "<td>
								
								<a href='DeliveryUpdate.php?deliid=$deliid'><i class='fa-solid fa-pen-to-square'></i></a>
								<a href='DeliveryDelete.php?deliid=$deliid'><i class='fa-solid fa-trash'></i></a>

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