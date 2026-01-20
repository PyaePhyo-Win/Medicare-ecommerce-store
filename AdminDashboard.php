<?php

session_start();

include ('connectmedicare.php');

if (!isset($_SESSION['AID'])) {
    echo "<script>window.alert('You need to login first to enter admin dashboard.')</script>";
    echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN = $_SESSION['AUNAME'];

$checksup = "SELECT * FROM Suppliertb";
$result = mysqli_query($dbconnect, $checksup);
$supcount = mysqli_num_rows($result);

$checkbrand = "SELECT * FROM Brandtb";
$brandresult = mysqli_query($dbconnect, $checkbrand);
$brandcount = mysqli_num_rows($brandresult);

$checkdeli = "SELECT * FROM Deliverytb";
$deliresult = mysqli_query($dbconnect, $checkdeli);
$delicount = mysqli_num_rows($deliresult);

$checkpay = "SELECT * FROM PaymentTypetb";
$payresult = mysqli_query($dbconnect, $checkpay);
$paycount = mysqli_num_rows($payresult);

$checkprotype = "SELECT * FROM ProductTypetb";
$protyperesult = mysqli_query($dbconnect, $checkprotype);
$protypecount = mysqli_num_rows($protyperesult);

$checkorder = "SELECT * FROM Ordertb";
$orderresult = mysqli_query($dbconnect, $checkorder);
$ordercount = mysqli_num_rows($orderresult);

$checkbeapro = "SELECT * FROM BeautyProducttb";
$beaproresult = mysqli_query($dbconnect, $checkbeapro);
$beaprocount = mysqli_num_rows($beaproresult);

$checkpromo = "SELECT * FROM Promotiontb";
$promoresult = mysqli_query($dbconnect, $checkpromo);
$promocount = mysqli_num_rows($promoresult);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="AdminStyle.css">
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
                    <a href="#">
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
        <div class="main">
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
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="card-number"><?php echo $supcount ?></div>
                        <div class="card-name">Total Suppliers</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-number"><?php echo $protypecount ?></div>
                        <div class="card-name">Total ProductTypes</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-brands fa-product-hunt"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-number"><?php echo $brandcount ?></div>
                        <div class="card-name">Total Brands</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-solid fa-b"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-number"><?php echo $paycount ?></div>
                        <div class="card-name">Total PaymentTypes</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-number"><?php echo $delicount ?></div>
                        <div class="card-name">Total Deliveries</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-solid fa-truck"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-number"><?php echo $ordercount ?></div>
                        <div class="card-name">Total Orders</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-content">
                        <div class="card-number"><?php echo $beaprocount ?></div>
                        <div class="card-name">Total BeautyProducts</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-solid fa-pills"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-number"><?php echo $promocount ?></div>
                        <div class="card-name">Total Promotion</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa-solid fa-percent"></i>
                    </div>
                </div>
            </div>
            <div class="admin-tables">
                <div class="supplier">
                    <div class="heading-pending">
                        <h2>Pending Orders</h2>
                        <a href="CustomerListing.php" class="btnViewall">View All</a>
                    </div>

                    <table class="tbl-supplier">

                        <thead>
                            <td>OrderDate</td>
                            <td>CustomerName</td>
                            <td>OrderAddress</td>
                            <td>Status</td>
                            <td>Action</td>
                        </thead>
                        <?php

                        $orselect = "SELECT * FROM Ordertb WHERE OrderStatus='Pending' LIMIT 5";
                        $result = mysqli_query($dbconnect, $orselect);
                        $count = mysqli_num_rows($result);

                        for ($i = 0; $i < $count; $i++) {
                            $array = mysqli_fetch_array($result);
                            $orcode = $array["OrderCode"];
                            $ordate = $array['OrderDate'];
                            $cusname = $array['OrderCustomerName'];
                            $oraddress = $array['OrderAddress'];
                            $status = $array['OrderStatus'];


                            echo "<tbody>";
                            echo "<tr>";

                            echo "<td>$ordate</td>";
                            echo "<td>$cusname</td>";
                            echo "<td>$oraddress</td>";
                            echo "<td>$status</td>";
                            echo "<td>
            
                                <a href='OrderConfirmAssign.php?orcode=$orcode'><i class='fa-solid fa-pen-to-square'></i></a>

                                </td>";


                            echo "</tr>";
                            echo "</tbody>";

                        }

                        ?>





                    </table>

                </div>
                <div class="supplier">

					<div class="heading">
						<h2>Our Promotion Products</h2>
					</div>

						<table class="tbl-supplier">

							<thead>
								<td>BeautyProductName</td>
								<td>PromotionName</td>
                                <td>PromotionDuration</td>
                                <td>PromotionRate</td>
								<td>Action</td>
							</thead>
							<?php 

								$promoselect="SELECT * FROM BeautyProducttb,Promotiontb,Promotion_BeautyProducttb WHERE Promotion_BeautyProducttb.PromotionCode=Promotiontb.PromotionCode AND Promotion_BeautyProducttb.BeautyProductCode=BeautyProducttb.BeautyProductCode LIMIT 5";
								$result=mysqli_query($dbconnect,$promoselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$beautyname=$array['BeautyProductName'];
									$proname=$array['PromotionName'];
									$prorate=$array['PromotionRate'];
                                    $produration=$array['PromotionDuration'];
                                    $promocode=$array['PromotionCode'];
                                    $beautycode=$array['BeautyProductCode'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$beautyname</td>";
									echo "<td>$proname</td>";
                                    echo "<td>$produration</td>";
                                    echo "<td>$prorate%</td>";
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
        </div>
    </div>
</body>

</html>