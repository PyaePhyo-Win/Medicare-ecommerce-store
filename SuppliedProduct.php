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

	$cbobeapro=$_POST['cbobeapro'];
    $cbosup=$_POST['cbosup'];
	$txtsupplieddate=$_POST['txtsupplieddate'];
    $txtsupproductqty=$_POST['txtsupproductqty'];
    $txtsupunitprice=$_POST['txtsupunitprice'];
    $txttotalprice=$txtsupproductqty * $txtsupunitprice;

    /* Auto Increment ID for Supplied Product */
	$spcode = 'SP_';
	$checkingrecentid = "SELECT MAX(RIGHT(SuppliedCode, LENGTH(SuppliedCode)-6)) AS RecentID FROM Supplier_BeautyProducttb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$spnewcode = (int)$recentid + 1;
	$spcode = $spcode.(str_pad($spnewcode, 6, '0', STR_PAD_LEFT));

	// Checking duplicate Supplied Product 
	$checksuppro="SELECT * FROM Supplier_BeautyProducttb WHERE 
	BeautyProductCode='$cbobeapro' AND SupplierID ='$cbosup' AND SuppliedDate='$txtsupplieddate'";
	$checkresult=mysqli_query($dbconnect,$checksuppro);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Supplier has been supplied this product in this day. If you want to add more quantity, please try in update.')</script>";
		echo "<script>window.location='SuppliedProduct.php'</script>";
	}
	else{
		// Inserting data into supplied product table
	    $spinsert="INSERT INTO Supplier_BeautyProducttb(SuppliedCode, BeautyProductCode, SupplierID, SuppliedDate, SuppliedProductQuantity, SuppliedUnitPrice, TotalPrice) VALUES ('$spcode','$cbobeapro','$cbosup','$txtsupplieddate','$txtsupproductqty','$txtsupunitprice','$txttotalprice')";
		$spinsertquery=mysqli_query($dbconnect,$spinsert);

		if ($spinsertquery) {
			echo "<script>window.alert('Adding supplied product record is Successful.')</script>";
		echo "<script>window.location='SuppliedProduct.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Supplied Product.')</script>";
		echo "<script>window.location='SuppliedProduct.php'</script>";
		} 
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Supplied Product</title>
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
                    <a href="#">
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

					<h1 class="title-form">Add Supplied Product</h1>

					<form action="SuppliedProduct.php" method="POST">

						<div class="supform"> 

							<div class="supinfo">

								<label>Choose Beauty Product</label><br>
			                    <select name="cbobeapro">
			                        <option>Select Beauty Product</option>
							        <?php

							        echo $beaproselect="SELECT * FROM BeautyProducttb";
							        $beaproquery=mysqli_query($dbconnect,$beaproselect);
							        $beaprocount=mysqli_num_rows($beaproquery);
							        for ($i=0; $i < $beaprocount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($beaproquery);
							            $bpCode=$fetch['BeautyProductCode'];
							            $bpName=$fetch['BeautyProductName'];

							            echo "<option value='$bpCode'>$bpName</option>";
							        }
							        
							        ?>
						    	</select><br>

						    	<label>Choose Supplier</label><br>
			                    <select name="cbosup">
			                        <option>Select Supplier</option>
							        <?php

							        echo $supselect="SELECT * FROM Suppliertb";
							        $supquery=mysqli_query($dbconnect,$supselect);
							        $supcount=mysqli_num_rows($supquery);
							        for ($i=0; $i < $supcount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($supquery);
							            $supid=$fetch['SupplierID'];
							            $supname=$fetch['SupplierName'];

							            echo "<option value='$supid'>$supname</option>";
							        }
							        
							        ?>
						    	</select><br>

						    	<label for="supplieddate">Supplied Date</label><br>
								<input type="date" id="supplieddate" name="txtsupplieddate"value="<?php echo date('d-m-Y'); ?>" required><br>

								<label for="supproductqty">Supplied Product Quantity</label><br>
								<input type="text" id="supproductqty" name="txtsupproductqty" placeholder="Enter Supplied Product Quantity" required><br>

								<label for="supunitprice">Supplied Unit Price</label><br>
								<input type="text" id="supunitprice" name="txtsupunitprice" placeholder="Enter Supplied Unit Price" required><br>
							
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
							<h2>Supplied Product Records</h2>
						</div>

						<table class="tbl-supplier">

							<thead>
							
								<td>Beauty Product Name</td>
								<td>Supplier Name</td>
								<td>Supplied Date</td>
								<td>Supplied Product Qty </td>
								<td>Supplied Unit Price</td>
								<td>Total Price</td>
								<td>Action</td>
							
							</thead>
							<?php 

								$spselect="SELECT * FROM Supplier_BeautyProducttb, BeautyProducttb, Suppliertb WHERE BeautyProducttb.BeautyProductCode = Supplier_BeautyProducttb.BeautyProductCode AND Suppliertb.SupplierID = Supplier_BeautyProducttb.SupplierID";
								$result=mysqli_query($dbconnect,$spselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$supdcode=$array['SuppliedCode'];
									$beaproname=$array['BeautyProductName'];
									$supname=$array['SupplierName'];
									$suprice=$array['SuppliedUnitPrice'];
									$supqty=$array['SuppliedProductQuantity'];
									$supddate=$array['SuppliedDate'];
									$totalprice=$array['TotalPrice'];
									

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$beaproname</td>";
									echo "<td>$supname</td>";
									echo "<td>$supddate</td>";
									echo "<td>$supqty</td>";
									echo "<td>$suprice</td>";
									echo "<td>$totalprice</td>";
									echo "<td>
									
									<a href='SuppliedProductUpdate.php?supdcode=$supdcode'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='SuppliedProductDelete.php?supdcode=$supdcode'><i class='fa-solid fa-trash'></i></a>

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