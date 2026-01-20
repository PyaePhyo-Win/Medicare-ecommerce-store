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

	$cboproduct=$_POST['cboproduct'];
	$cbopromotion=$_POST['cbopromotion'];
	$txtpromorate=$_POST['txtpromorate'];
    $txtpromostdate=$_POST['txtpromostdate'];
    $txtpromoendate=$_POST['txtpromoendate'];
    $txtpromoduration=$_POST['txtpromoduration'];
	

	 $checkpro="SELECT * FROM Promotion_BeautyProducttb WHERE PromotionCode='$cbopromotion' AND BeautyProductCode='$cboproduct'";
	$checkresult=mysqli_query($dbconnect,$checkpro);
	$checkcount=mysqli_num_rows($checkresult);

	if ($checkcount) {
		echo "<script>window.alert('Promotion have already been assigned on Beauty Product.')</script>";
		echo "<script>window.location='AssignPromotion.php'</script>";
	}
	else{
	    $asspromoinsert="INSERT INTO Promotion_BeautyProducttb(BeautyProductCode,PromotionCode, PromotionRate,PromotionStartDate,PromotionEndDate,PromotionDuration) 
					VALUES ('$cboproduct','$cbopromotion','$txtpromorate','$txtpromostdate','$txtpromoendate','$txtpromoduration')";
		$asspromoinsertquery=mysqli_query($dbconnect,$asspromoinsert);

		if ($asspromoinsertquery) {
			echo "<script>window.alert('Assigning Promotion is Successful.')</script>";
		    echo "<script>window.location='AssignPromotion.php'</script>";
		}
		else{
			echo "<script>window.alert('Something went woring in Assigning Promotion.')</script>";
		    echo "<script>window.location='AssignPromotion.php'</script>";
		}
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Assign Promotion</title>
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

				<h1 class="title-form">Assign Promotion</h1>

					<form action="AssignPromotion.php" method="POST">

						<div class="supform"> 

						    <div class="supinfo">

                                <label>Choose Product Name</label><br>
			                    <select name="cboproduct">
			                        <option>Select Product Name</option>
							        <?php

							        $beautyselect="SELECT * FROM BeautyProducttb";
							        $beautyquery=mysqli_query($dbconnect,$beautyselect);
							        $beautycount=mysqli_num_rows($beautyquery);
							        for ($i=0; $i < $beautycount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($beautyquery);
							            $BPCode=$fetch['BeautyProductCode'];
							            $BPName=$fetch['BeautyProductName'];

							            echo "<option value='$BPCode'>$BPName</option>";
							        }
							        
							        ?>
						        </select><br>

                                <label>Choose Promotion Name</label><br>
			                    <select name="cbopromotion">
			                        <option>Select Promotion Name</option>
							        <?php

							        $promoselect="SELECT * FROM Promotiontb";
							        $promoquery=mysqli_query($dbconnect,$promoselect);
							        $promocount=mysqli_num_rows($promoquery);
							        for ($i=0; $i < $promocount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($promoquery);
							            $PCode=$fetch['PromotionCode'];
							            $PName=$fetch['PromotionName'];

							            echo "<option value='$PCode'>$PName</option>";
							        }
							        
							        ?>
						    	</select><br>
							
								<label for="promorate">Promotion Rate</label><br>
								<input type="text" id="promorate" name="txtpromorate" placeholder="Enter Promotion Rate" required><br>

								<label for="promostdate">Promotion Start Date</label><br>
								<input type="date" id="promostdate" name="txtpromostdate" placeholder="Enter Promotion Start Date" required><br>

                                <label for="promoendate">Promotion End Date</label><br>
								<input type="date" id="promoendate" name="txtpromoendate" placeholder="Enter Promotion End Date" required><br>

                                <label for="promoduration">Promotion Duration</label><br>
								<input type="text" id="promoduration" name="txtpromoduration" placeholder="Enter Promotion Duration" required><br>
							
						    </div>

						</div>
					
						<div class="Supform-button">
							<input type="submit" name="btnadd" value="ASSIGN">
						</div>

					</form>
			</div>

		</div>
			<div class="admin-tables">

				<div class="supplier">

					<div class="heading">
						<h2>Assigned Promotion Lists</h2>
					</div>

						<table class="tbl-supplier">

							<thead>
								<td>BeautyProductName</td>
								<td>PromotionName</td>
								<td>PromotionRate</td>
								<td>PromotionStartDate</td>
                                <td>PromotionEndDate</td>
                                <td>PromotionDuration</td>
								<td>Action</td>
							</thead>
							<?php 

								$promoselect="SELECT * FROM BeautyProducttb,Promotiontb,Promotion_BeautyProducttb WHERE Promotion_BeautyProducttb.PromotionCode=Promotiontb.PromotionCode AND Promotion_BeautyProducttb.BeautyProductCode=BeautyProducttb.BeautyProductCode";
								$result=mysqli_query($dbconnect,$promoselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$beautyname=$array['BeautyProductName'];
									$proname=$array['PromotionName'];
									$prorate=$array['PromotionRate'];
									$prostd=$array['PromotionStartDate'];
                                    $proend=$array['PromotionEndDate'];
                                    $produration=$array['PromotionDuration'];
                                    $promocode=$array['PromotionCode'];
                                    $beautycode=$array['BeautyProductCode'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$beautyname</td>";
									echo "<td>$proname</td>";
									echo "<td>$prorate</td>";
									echo "<td>$prostd</td>";
                                    echo "<td>$proend</td>";
                                    echo "<td>$produration</td>";
									echo "<td>
									
									<a href='AssignPromotionUpdate.php?procode=$promocode&beautycode=$beautycode'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='AssignPromotionDelete.php?promocode=$promocode&beautycode=$beautycode'><i class='fa-solid fa-trash'></i></a>

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