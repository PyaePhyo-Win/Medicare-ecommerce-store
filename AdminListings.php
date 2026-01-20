<?php 

session_start();

include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Add Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Listings</title>
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
                    <a href="#">
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
			<div class="admin-tables">

				<div class="supplier">

					<div class="heading">
						<h2>Admin Lists</h2>
					</div>

						<table class="tbl-supplier">

							<thead>
								<td>AdminID</td>
								<td>AdminFirstName</td>
								<td>AdminSurName</td>
								<td>AdminUsername</td>
								<td>AdminPhone</td>
								<td>AdminEmail</td>
								<td>AdminAddress</td>
								<td>Action</td>
							</thead>
							<?php 

								$adselect="SELECT * FROM Admintb";
								$result=mysqli_query($dbconnect,$adselect);
								$count=mysqli_num_rows($result);

								for ($i=0; $i <$count ; $i++) 
								{ 
									$array=mysqli_fetch_array($result);
									$admid=$array['AdminID'];
									$admfname=$array['AdminFirstName'];
									$admsname=$array['AdminSurName'];
									$admuname=$array['AdminUsername'];
									$admphone=$array['AdminPhoneNo'];
									$admemail=$array['AdminEmail'];
									$admaddress=$array['AdminAddress'];

									echo "<tbody>";
									echo "<tr>";

									echo "<td>$admid</td>";
									echo "<td>$admfname</td>";
									echo "<td>$admsname</td>";
									echo "<td>$admuname</td>";
									echo "<td>$admphone</td>";
									echo "<td>$admemail</td>";
									echo "<td>$admaddress</td>";
									echo "<td>
									
									<a href='AdminUpdate.php?admid=$admid'><i class='fa-solid fa-pen-to-square'></i></a>
									<a href='AdminDelete.php?admid=$admid'><i class='fa-solid fa-trash'></i></a>

									</td>";

									echo "</tr>";
									echo "</tbody>";

								}

							?>





						</table>
					
				</div>

			</div>
			</div>
            
            <footer class="admin-footer">
                <p>Copyright © 2024 Medicare. All rights reserved. Created by PPW.</p>
            </footer>

		</main>
</div>

</body>
</html>