<?php

session_start();

include ('connectmedicare.php');

if (!isset($_SESSION['AID'])) {
    echo "<script>window.alert('You Cannot Add Data. Login Again!')</script>";
    echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN = $_SESSION['AUNAME'];




?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Listings</title>
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
                            <h2>Customer Lists</h2>
                        </div>

                        <table class="tbl-supplier">

                            <thead>
                                <td>Customer Name</td>
                                <td>Customer PhoneNo</td>
                                <td>Customer Username</td>
                                <td>Customer Email</td>
                                <td>Customer Address</td>
                            </thead>
                            <?php

                            $cusselect = "SELECT * FROM Customertb";
                            $result = mysqli_query($dbconnect, $cusselect);
                            $count = mysqli_num_rows($result);

                            for ($i = 0; $i < $count; $i++) {
                                $array = mysqli_fetch_array($result);
                                $cusname = $array['CustomerName'];
                                $cusphone = $array['CustomerPhoneNo'];
                                $usename = $array['CustomerUsername'];
                                $cusemail = $array['CustomerEmail'];
                                $cusaddress = $array['CustomerAddress'];

                                echo "<tbody>";
                                echo "<tr>";

                                echo "<td>$cusname</td>";
                                echo "<td>$cusphone</td>";
                                echo "<td>$usename</td>";
                                echo "<td>$cusemail</td>";
                                echo "<td>$cusaddress</td>";

                                echo "</tr>";
                                echo "</tbody>";

                            }

                            ?>





                        </table>

                    </div>

                </div>
            </div>

            <div class="SupContainer">
                <div class="admin-tables">

                    <div class="supplier">

                        <div class="heading">
                            <h2>Order_BeautyProduct Lists</h2>
                        </div>

                        <table class="tbl-supplier">

                            <thead>
                                <td>Product Code</td>
                                <td>Order Code</td>
                                <td>Order Quantity</td>
                                <td>Product Price</td>
                                <td>Total Amount</td>
                                <td>Promotion Price</td>
                                <td>Net Price</td>
                            </thead>
                            <?php

                            $bpselect = "SELECT * FROM Order_BeautyProducttb";
                            $result = mysqli_query($dbconnect, $bpselect);
                            $count = mysqli_num_rows($result);

                            for ($i = 0; $i < $count; $i++) {
                                $array = mysqli_fetch_array($result);
                                $procode = $array['BeautyProductCode'];
                                $orcode = $array['OrderCode'];
                                $orpqty = $array['OrderProductQty'];
                                $orprice = $array['OrderProductPrice'];
                                $amount = $array['TotalAmount'];
                                $promoprice = $array['PromotionPrice'];
                                $netprice = $array['NetPrice'];

                                echo "<tbody>";
                                echo "<tr>";

                                echo "<td>$procode</td>";
                                echo "<td>$orcode</td>";
                                echo "<td>$orpqty</td>";
                                echo "<td>$orprice</td>";
                                echo "<td>$amount</td>";
                                echo "<td>$promoprice</td>";
                                echo "<td>$netprice</td>";

                                echo "</tr>";
                                echo "</tbody>";

                            }

                            ?>





                        </table>

                    </div>

                </div>

                <div class="SupContainer">
                <div class="admin-tables">

                    <div class="supplier">

                        <div class="heading">
                            <h2>Order Lists</h2>
                        </div>

                        <table class="tbl-supplier">

                            <thead>
                                <td>OrderCode</td>
                                <td>OrderDate</td>
                                <td>CustomerName</td>
                                <td>PaymentType</td>
                                <td>OrderEmail</td>
                                <td>OrderPhone</td>
                                <td>OrderAddress</td>
                                <td>OrderCity</td>
                                <td>OrderRegion</td>
                                <td>TotalQuantity</td>
                                <td>TotalPrice</td>
                                <td>Total PromotionPrice</td>
                                <td>Total NetPrice</td>
                                <td>Status</td>
                                <td>DeliveryID</td>
                                <td>Action</td>
                            </thead>
                            <?php

                            $orselect = "SELECT * FROM Ordertb,PaymentTypetb WHERE Ordertb.PaymentTypeCode=PaymentTypetb.PaymentTypeCode";
                            $result = mysqli_query($dbconnect, $orselect);
                            $count = mysqli_num_rows($result);

                            for ($i = 0; $i < $count; $i++) {
                                $array = mysqli_fetch_array($result);
                                $orcode = $array['OrderCode'];
                                $ordate = $array['OrderDate'];
                                $cusname = $array['OrderCustomerName'];
                                $paytype = $array['PaymentType'];
                                $oremail = $array['OrderEmail'];
                                $orphone = $array['OrderPhone'];
                                $oraddress = $array['OrderAddress'];
                                $orcity = $array['OrderCity'];
                                $orregion = $array['OrderRegion'];
                                $ttlqty = $array['TotalQuantity'];
                                $ttlprice = $array['TotalPrice'];
                                $ttlpromprice = $array['TotalPromotionPrice'];
                                $ttlneprice = $array['TotalNetPrice'];
                                $status = $array['OrderStatus'];
                                $deliid = $array['DeliveryID'];
	

                                echo "<tbody>";
                                echo "<tr>";

                                echo "<td>$orcode</td>";
                                echo "<td>$ordate</td>";
                                echo "<td>$cusname</td>";
                                echo "<td>$paytype</td>";
                                echo "<td>$oremail</td>";
                                echo "<td>$orphone</td>";
                                echo "<td>$oraddress</td>";
                                echo "<td>$orcity</td>";
                                echo "<td>$orregion</td>";
                                echo "<td>$ttlqty</td>";
                                echo "<td>$ttlprice</td>";
                                echo "<td>$ttlpromprice</td>";
                                echo "<td>$ttlneprice</td>";
                                echo "<td>$status</td>";
                                echo "<td>$deliid</td>";
                                echo "<td>
									
									<a href='OrderConfirmAssign.php?orcode=$orcode'><i class='fa-solid fa-pen-to-square'></i></a>

									</td>";


                                echo "</tr>";
                                echo "</tbody>";

                            }

                            ?>





                        </table>

                    </div>

                </div>

                <div class="SupContainer">
                <div class="admin-tables">

                    <div class="supplier">

                        <div class="heading">
                            <h2>Order Lists By Date</h2>
                        </div>

                        <table class="tbl-supplier">

                            <thead>
                                <td>OrderCode</td>
                                <td>OrderDate</td>
                                <td>CustomerName</td>
                                <td>PaymentType</td>
                                <td>OrderEmail</td>
                                <td>OrderPhone</td>
                                <td>OrderAddress</td>
                                <td>OrderCity</td>
                                <td>OrderRegion</td>
                                <td>TotalQuantity</td>
                                <td>TotalPrice</td>
                                <td>Total PromotionPrice</td>
                                <td>Total NetPrice</td>
                                <td>Status</td>
                                <td>DeliveryID</td>
                                <td>Action</td>
                            </thead>
                            <?php

                            $orselect = "SELECT * FROM Ordertb,PaymentTypetb WHERE Ordertb.PaymentTypeCode=PaymentTypetb.PaymentTypeCode ORDER BY OrderDate";
                            $result = mysqli_query($dbconnect, $orselect);
                            $count = mysqli_num_rows($result);

                            for ($i = 0; $i < $count; $i++) {
                                $array = mysqli_fetch_array($result);
                                $orcode = $array['OrderCode'];
                                $ordate = $array['OrderDate'];
                                $cusname = $array['OrderCustomerName'];
                                $paytype = $array['PaymentType'];
                                $oremail = $array['OrderEmail'];
                                $orphone = $array['OrderPhone'];
                                $oraddress = $array['OrderAddress'];
                                $orcity = $array['OrderCity'];
                                $orregion = $array['OrderRegion'];
                                $ttlqty = $array['TotalQuantity'];
                                $ttlprice = $array['TotalPrice'];
                                $ttlpromprice = $array['TotalPromotionPrice'];
                                $ttlneprice = $array['TotalNetPrice'];
                                $status = $array['OrderStatus'];
                                $deliid = $array['DeliveryID'];
	

                                echo "<tbody>";
                                echo "<tr>";

                                echo "<td>$orcode</td>";
                                echo "<td>$ordate</td>";
                                echo "<td>$cusname</td>";
                                echo "<td>$paytype</td>";
                                echo "<td>$oremail</td>";
                                echo "<td>$orphone</td>";
                                echo "<td>$oraddress</td>";
                                echo "<td>$orcity</td>";
                                echo "<td>$orregion</td>";
                                echo "<td>$ttlqty</td>";
                                echo "<td>$ttlprice</td>";
                                echo "<td>$ttlpromprice</td>";
                                echo "<td>$ttlneprice</td>";
                                echo "<td>$status</td>";
                                echo "<td>$deliid</td>";
                                echo "<td>
									
									<a href='OrderConfirmAssign.php?orcode=$orcode'><i class='fa-solid fa-pen-to-square'></i></a>

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