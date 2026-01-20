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

	$beautyproduct=$_POST['txtbeautyproduct'];
	$cbobrand=$_POST['cbobrand'];
    $cboprotype=$_POST['cboprotype'];
	$benefitsofproduct=$_POST['txtbenefitsofproduct'];
    $usageinstruction=$_POST['txtusageinstruction'];
    $storageinstruction=$_POST['txtstorageinstruction'];
    $countryoforigin=$_POST['txtcountryoforigin'];
    $productprice=$_POST['txtproductprice'];
    $productquantity=$_POST['txtproductquantity'];
    $expireddate=$_POST['txtexpireddate'];
    $manudate=$_POST['txtmanudate'];
	

	/* Auto Increment ID for Beauty Product */
	$bpcode = 'BP_';
	$checkingrecentid = "SELECT MAX(RIGHT(BeautyProductCode, LENGTH(BeautyProductCode)-6)) AS RecentID FROM BeautyProducttb";
	$recentid=mysqli_query($dbconnect,$checkingrecentid);
	$row = mysqli_fetch_assoc($recentid);
	$recentid = $row['RecentID'];
	$bpnewcode = (int)$recentid + 1;
	$bpcode = $bpcode.(str_pad($bpnewcode, 6, '0', STR_PAD_LEFT));

	// Copying image
	$productimg1=$_FILES['txtproductimg1']['name'];
	$folder="Medicareimage/";
	$proimgfilename=$folder."_".$productimg1;

	$copy=copy($_FILES['txtproductimg1']['tmp_name'], $proimgfilename);

	if (!$copy) {
		echo "<p>('Cannot upload Beauty Product Image 1')</p>";
		exit();
	}

	$productimg2=$_FILES['txtproductimg2']['name'];
	$folder="Medicareimage/";
	$proimgfilename1=$folder."_".$productimg2;

	$copy1=copy($_FILES['txtproductimg2']['tmp_name'], $proimgfilename1);

	if (!$copy1) {
		echo "<p>('Cannot upload Beauty Product Image 2')</p>";
		exit();
	}

	// Checking duplicate payment type
	$checkbp="SELECT * FROM BeautyProducttb WHERE BeautyProductName='$beautyproduct' AND ExpiredDate='$expireddate' AND ManufacturedDate='$manudate'";
	$checkresult=mysqli_query($dbconnect,$checkbp);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Duplicate Beauty Product Name, Expired Date and Manufactured Date in Database. Try Updating Quantity or Price.')</script>";
		echo "<script>window.location='BeautyProduct.php'</script>";
	}
	else{
		// Inserting data into beauty product table
	    $bpinsert="INSERT INTO BeautyProducttb(BeautyProductCode, BrandCode,					ProductTypeCode, BeautyProductName, BenefitsofProduct, 						UsageInstruction, Storagelnstruction, CountryofOrigin, 
						ProductPrice, ProductQuantity, ExpiredDate, ManufacturedDate,BeautyProductImg1, BeautyProductImg2) 
						VALUES ('$bpcode','$cbobrand','$cboprotype','$beautyproduct','$benefitsofproduct','$usageinstruction','$storageinstruction','$countryoforigin','$productprice','$productquantity','$expireddate','$manudate','$proimgfilename','$proimgfilename1')";
		$bpinsertquery=mysqli_query($dbconnect,$bpinsert);

		if ($bpinsertquery) {
			echo "<script>window.alert('Adding beauty product is Successful.')</script>";
		echo "<script>window.location='BeautyProduct.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Adding Beauty Product.')</script>";
		echo "<script>window.location='BeautyProduct.php'</script>";
		} 
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Beauty Product</title>
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
                    <a href="#">
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

					<h1 class="title-form">Add Beauty Product</h1>

					<form action="BeautyProduct.php" method="POST" enctype="multipart/form-data">

						<div class="supform"> 

							<div class="supinfo">
							
								<label for="beautyproduct">Beauty Product Name</label><br>
								<input type="text" id="beautyproduct" name="txtbeautyproduct" placeholder="Enter Beauty Product" required><br>

								<label>Choose Brand Name</label><br>
			                    <select name="cbobrand">
			                        <option>Select Brand Name</option>
							        <?php

							        echo $brandselect="SELECT * FROM Brandtb";
							        $brandquery=mysqli_query($dbconnect,$brandselect);
							        $brandcount=mysqli_num_rows($brandquery);
							        for ($i=0; $i < $brandcount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($brandquery);
							            $BCode=$fetch['BrandCode'];
							            $BName=$fetch['BrandName'];

							            echo "<option value='$BCode'>$BName</option>";
							        }
							        
							        ?>
						    	</select><br>

						    	<label>Choose Product Type</label><br>
			                    <select name="cboprotype">
			                        <option>Select ProductType</option>
							        <?php

							        echo $protypeselect="SELECT * FROM ProductTypetb";
							        $protypequery=mysqli_query($dbconnect,$protypeselect);
							        $protypecount=mysqli_num_rows($protypequery);
							        for ($i=0; $i < $protypecount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($protypequery);
							            $protypecode=$fetch['ProductTypeCode'];
							            $protypename=$fetch['ProductTypeName'];

							            echo "<option value='$protypecode'>$protypename</option>";
							        }
							        
							        ?>
						    	</select><br>

								<label for="benefitsofproduct">Benefits of Product</label><br>
								<input type="text" id="benefitsofproduct" name="txtbenefitsofproduct" placeholder="Enter Benefits of Product" required><br>

								<label for="usageinstruction">Usage Instruction</label><br>
								<input type="text" id="usageinstruction" name="txtusageinstruction" placeholder="Enter Usage Instruction" required><br>

								<label for="storageinstruction">Storage Instruction</label><br>
								<input type="text" id="storageinstruction" name="txtstorageinstruction" placeholder="Enter Storage Instruction" required><br>

								<label for="countryoforigin">Country of Origin</label><br>
								<input type="text" id="countryoforigin" name="txtcountryoforigin" placeholder="Enter Country of Origin" required><br>

								<label for="productprice">Product Price</label><br>
								<input type="text" id="productprice" name="txtproductprice" placeholder="Enter Product Price" required><br>

								<label for="productquantity">Product Quantity</label><br>
								<input type="text" id="productquantity" name="txtproductquantity" placeholder="Enter Product Quantity" required><br>

								<label for="expireddate">Expired Date</label><br>
								<input type="date" id="expireddate" name="txtexpireddate"value="<?php echo date('d-m-Y'); ?>" required><br>

								<label for="manudate">Manufactured Date</label><br>
								<input type="date" id="manudate"  name="txtmanudate" value="<?php echo date('d-m-Y'); ?>" required><br>

								<label for="prodcutimg1">Product Image 1</label><br>
								<input type="file" id="prodcutimg1" name="txtproductimg1" required>

								<label for="prodcutimg2">Product Image 2</label><br>
								<input type="file" id="prodcutimg2" name="txtproductimg2" required>
							
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
							<h2>Beauty Product Lists</h2>
						</div>

						<table class="tbl-supplier">

							<thead>
							
								<td>BeautyProductName</td>
								<td>BrandName</td>
								<td>ProductType</td>
								<td>BenefitsofProducts</td>
								<td>UsageInstruction</td>
								<td>StorageInstruction</td>
								<td>ProductPrice</td>
								<td>ProductQuantity</td>
								<td>ExpiredDate</td>
								<td>ManufacturedDate</td>
								<td>Product Image</td>
								<td>Action</td>
							
							</thead>
							<?php 

								$beaproselect="SELECT * FROM BeautyProducttb, Brandtb, ProductTypetb WHERE BeautyProducttb.BrandCode = Brandtb.BrandCode AND ProductTypetb.ProductTypeCode = BeautyProducttb.ProductTypeCode";
								$result=mysqli_query($dbconnect,$beaproselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$beaprocode=$array['BeautyProductCode'];
									$beaproname=$array['BeautyProductName'];
									$beneofpro=$array['BenefitsofProduct'];
									$usein=$array['UsageInstruction'];
									$storein=$array['Storagelnstruction'];
									$proprice=$array['ProductPrice'];
									$proqty=$array['ProductQuantity'];
									$exdate=$array['ExpiredDate'];
									$madate=$array['ManufacturedDate'];
									$beaproimg=$array['BeautyProductImg1'];
									$brname=$array['BrandName'];
									$protname=$array['ProductTypeName'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$beaproname</td>";
									echo "<td>$brname</td>";
									echo "<td>$protname</td>";
									echo "<td>$beneofpro</td>";
									echo "<td>$usein</td>";
									echo "<td>$storein</td>";
									echo "<td>$proprice</td>";
									echo "<td>$proqty</td>";
									echo "<td>$exdate</td>";
									echo "<td>$madate</td>";
									echo "<td><img src='$beaproimg' class='tbl-photo'></td>";
									echo "<td>
									
									<a href='BeautyProductUpdate.php?beaprocode=$beaprocode'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='BeautyProductDelete.php?beaprocode=$beaprocode'><i class='fa-solid fa-trash'></i></a>

									</td>";

									echo "</tr>";
									echo "</tbody>";

								}

							?>

						</table>

					</div>

					<div class="supplier">

						<div class="heading">
							<h2>Beauty Product Lists (By Expired Date)</h2>
						</div>

						<table class="tbl-supplier">

							<thead>
							
								<td>BeautyProductName</td>
								<td>BrandName</td>
								<td>ProductType</td>
								<td>BenefitsofProducts</td>
								<td>UsageInstruction</td>
								<td>StorageInstruction</td>
								<td>ProductPrice</td>
								<td>ProductQuantity</td>
								<td>ExpiredDate</td>
								<td>ManufacturedDate</td>
								<td>Product Image</td>
								<td>Action</td>
							
							</thead>
							<?php 

								$beaproselect="SELECT * FROM BeautyProducttb, Brandtb, ProductTypetb WHERE BeautyProducttb.BrandCode = Brandtb.BrandCode AND ProductTypetb.ProductTypeCode = BeautyProducttb.ProductTypeCode ORDER BY BeautyProducttb.ExpiredDate";
								$result=mysqli_query($dbconnect,$beaproselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$beaprocode=$array['BeautyProductCode'];
									$beaproname=$array['BeautyProductName'];
									$beneofpro=$array['BenefitsofProduct'];
									$usein=$array['UsageInstruction'];
									$storein=$array['Storagelnstruction'];
									$proprice=$array['ProductPrice'];
									$proqty=$array['ProductQuantity'];
									$exdate=$array['ExpiredDate'];
									$madate=$array['ManufacturedDate'];
									$beaproimg=$array['BeautyProductImg1'];
									$brname=$array['BrandName'];
									$protname=$array['ProductTypeName'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$beaproname</td>";
									echo "<td>$brname</td>";
									echo "<td>$protname</td>";
									echo "<td>$beneofpro</td>";
									echo "<td>$usein</td>";
									echo "<td>$storein</td>";
									echo "<td>$proprice</td>";
									echo "<td>$proqty</td>";
									echo "<td>$exdate</td>";
									echo "<td>$madate</td>";
									echo "<td><img src='$beaproimg' class='tbl-photo'></td>";
									echo "<td>
									
									<a href='BeautyProductUpdate.php?beaprocode=$beaprocode'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='BeautyProductDelete.php?beaprocode=$beaprocode'><i class='fa-solid fa-trash'></i></a>

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