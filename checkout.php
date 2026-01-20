<?php
session_start();
include ("connectmedicare.php");
include ("cartfunction.php");


if (isset($_POST['btnorder'])) {

    if (isset($_SESSION['CID'])){

        $cusid = $_SESSION['CID'];
        $paymenttype=$_POST['cbopay'];
        $txtcusname=$_POST['txtcusname'];
        $txtemail=$_POST['txtemail'];
        $txtphone=$_POST['txtphone'];
        $txtaddress=$_POST['txtaddress'];
        $txtcity=$_POST['txtcity'];
        $cboregion=$_POST['cboregion'];
        $totalquantity=CalculateTotalQuantity();
        $totalprice=CalculateTotalAmount();
        $totalpromoprice=CalculateTotalPromotionPrice();
        $totalnetprice=$totalprice - $totalpromoprice;
        $status='Pending';
        $orderdate=date('Y-m-d');

        /* Auto Increment ID for Order */
        $ordercode = 'Or_';
        $checkingrecentid = "SELECT MAX(RIGHT(OrderCode, LENGTH(OrderCode)-6)) AS RecentID FROM Ordertb";
        $recentid=mysqli_query($dbconnect,$checkingrecentid);
        $row = mysqli_fetch_assoc($recentid);
        $recentid = $row['RecentID'];
        $ordernewcode = (int)$recentid + 1;
        $ordercode = $ordercode.(str_pad($ordernewcode, 6, '0', STR_PAD_LEFT));

        $insert="INSERT INTO Ordertb(OrderCode, OrderDate, CustomerID, PaymentTypeCode, OrderCustomerName, OrderEmail, OrderPhone, OrderAddress, OrderCity, OrderRegion,	TotalQuantity, TotalPrice, TotalPromotionPrice, TotalNetPrice, OrderStatus	) VALUES ('$ordercode','$orderdate','$cusid','$paymenttype','$txtcusname','$txtemail','$txtphone','$txtaddress','$txtcity','$cboregion','$totalquantity','$totalprice','$totalpromoprice','$totalnetprice','$status')";
		$insertquery=mysqli_query($dbconnect,$insert);

        $count = count($_SESSION["Cart_Function"]);

        for ($i = 0; $i < $count; $i++) {
            $BeautyProductCode = $_SESSION['Cart_Function'][$i]['BeautyProductCode'];
            $Price = $_SESSION['Cart_Function'][$i]['Price'];
            $Quantity = $_SESSION['Cart_Function'][$i]['Quantity'];
            $BeautyProductName = $_SESSION['Cart_Function'][$i]['BeautyProductName'];
            $SubTotal = $Price * $Quantity;
            $PromoPrice=$_SESSION['Cart_Function'][$i]['PromotionPrice'];
            $Netprice=$SubTotal - $PromoPrice;

            /* Auto Increment ID for Order */
            $orbcode = 'OrB_';
            $checkingrecentid = "SELECT MAX(RIGHT(OrderBeautyProductCode, LENGTH(OrderBeautyProductCode)-7)) AS RecentID FROM Order_BeautyProducttb";
            $recentid=mysqli_query($dbconnect,$checkingrecentid);
            $row = mysqli_fetch_assoc($recentid);
            $recentid = $row['RecentID'];
            $orbnewcode = (int)$recentid + 1;
            $orbcode = $orbcode.(str_pad($orbnewcode, 7, '0', STR_PAD_LEFT));

            $insert1="INSERT INTO Order_BeautyProducttb(OrderBeautyProductCode,BeautyProductCode,OrderCode,OrderProductQty,OrderProductPrice,TotalAmount,PromotionPrice,NetPrice) VALUES ('$orbcode','$BeautyProductCode','$ordercode','$Quantity','$Price','$SubTotal','$PromoPrice','$Netprice')";
		    $insertquery1=mysqli_query($dbconnect,$insert1);

            $update="UPDATE BeautyProducttb
			SET 
			ProductQuantity=ProductQuantity-'$Quantity'
			WHERE BeautyProductCode='$BeautyProductCode'";
            $updatequery=mysqli_query($dbconnect,$update);
        }
        
        if ($insertquery && $insertquery1 && $updatequery) {
            echo "<script>window.alert('Ordering Process is Successful.')</script>";
		    echo "<script>window.location='homepage.php'</script>";
        }
        else {
            echo "<script>window.alert('Ordering Process is Fail.')</script>";
            echo "<script>window.location='checkout.php'</script>";
        }

    }
    else {
        echo "<script>window.alert('You Cannot  Place Order. Login First!')</script>";
	    echo "<script>window.location='CustomerLogin.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link rel="stylesheet" href="CustomerStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/97dff553a5.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <header class="pro-header">
            <nav>
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <div class="logo">
                    MEDICARE
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="homepage.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="product.php">Products</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                        <li><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                        <?php

                        if (!isset($_SESSION['CID'])) {
                            echo "<li><a href='CustomerLogin.php'>Login</a></li>";
                        } else {
                            $cuname = $_SESSION['CUNAME'];
                            echo "
                                <li><a href=''>$cuname</a></li>
                                <li><a href='CustomerLogout.php'><i class='fa-solid fa-right-from-bracket'></i></a></li>
                                                ";
                        }

                        ?>
                    </ul>
                </div>
            </nav>
        </header>

        <section>
            <div class="sitepath m-4">
                <span class="text-danger mx-2">Home</span> > <span class="text-danger mx-2">Check Out</span>
            </div>
            <h3 class="text-center p-3">Check Out</h3>
            <form class="bill-content p-2" action="checkout.php" method="POST">
                <div class="bill-address bg-light p-2">
                    <h4 class="border-bottom border-danger p-3">Order Address</h4>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputCustomer">Customer Name</label>
                            <input type="text" name="txtcusname" class="form-control" id="inputCustomer" value="<?php $_SESSION['CUNAME']; ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="txtemail" class="form-control" id="inputEmail4" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone4">Phone</label>
                            <input type="text" name="txtphone" class="form-control" id="inputPhone" required>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputAddress">Address</label>
                        <input type="text" name="txtaddress" class="form-control" id="inputAddress" placeholder="1234 Main St" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City/Twonship</label>
                            <input type="text" name="txtcity" class="form-control" id="inputCity" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">State/Region</label>
                            <select name="cboregion" id="inputState" class="form-control" required>
                                <option selected>Choose State/Region</option>
                                <option value="Yangon">Yangon</option>
                                <option value="Mandalay">Mandalay</option>
                                <option value="Kachin">Kachin</option>
                                <option value="Bago">Bago</option>
                                <option value="Sagaing">Sagaing</option>
                                <option value="Ayeyarwady">Ayeyarwady</option>
                                <option value="Kayar">Kayar</option>
                                <option value="Shan">Shan</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="bill-details bg-light p-2">
                    <h4 class="border-bottom border-danger p-3">Order Details</h4>
                    <div class="table-responsive border-bottom border-dark">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <?php
                            $size = count($_SESSION['Cart_Function']);
                            if (!isset($_SESSION["Cart_Function"])) {
                                echo "<h1 class='text-center m-5'>Data Not Found</h1>";

                            } else {
                                $count = count($_SESSION["Cart_Function"]);

                                for ($i = 0; $i < $count; $i++) {
                                    $BeautyProductCode = $_SESSION['Cart_Function'][$i]['BeautyProductCode'];
                                    $Price = $_SESSION['Cart_Function'][$i]['Price'];
                                    $Quantity = $_SESSION['Cart_Function'][$i]['Quantity'];
                                    $BeautyProductName = $_SESSION['Cart_Function'][$i]['BeautyProductName'];
                                    $SubTotal = $Price * $Quantity;

                                    echo "
                                    <tbody>
                                    <tr>
                                        <td>$BeautyProductName x $Quantity</td>
                                        <td>$SubTotal Ks</td>
                                    </tr>
                                    </tbody>";

                                }
                            }

                            ?>
                        </table>
                    </div>
                    <?php
                    $count = count($_SESSION["Cart_Function"]);

                    for ($i = 0; $i < $count; $i++) {
                        $BeautyProductCode = $_SESSION['Cart_Function'][$i]['BeautyProductCode'];

                        $query1 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
                            LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode WHERE b.BeautyProductCode='$BeautyProductCode'";
                        $result1 = mysqli_query($dbconnect, $query1);
                        $data = mysqli_fetch_array($result1);
                        $prorate = $data['PromotionRate'];
                        $BeautyProductName = $data['BeautyProductName'];
                        if (isset($prorate)) {
                            echo "<label class='border-bottom border-dark py-3 w-100'>Promotion for $BeautyProductName: $prorate%</label>";
                        }

                    }

                    ?>
                    <label class="border-bottom border-dark pb-3 w-100">Total Price:
                        <?php echo CalculateTotalAmount(); ?> Ks</label><br>
                    <label class="border-bottom border-dark pb-3 w-100">Total Promotion:
                        <?php echo CalculateTotalPromotionPrice(); ?> Ks</label><br>
                    <label class="border-bottom border-dark pb-3 w-100"> Total Net Price:
                        <?php $totalprice = CalculateTotalAmount();
                        $totalpromo = CalculateTotalPromotionPrice();
                        $totalnetprice = $totalprice - $totalpromo;
                        echo $totalnetprice;
                        ?> Ks
                    </label><br>
                    <div class="form-group col-md-12">
                            <label for="inputState">Payment Type</label>
                            <select name="cbopay" id="inputState" class="form-control" requ>
                                <option>Choose Payment Type</option>
                                <?php

							        $payselect="SELECT * FROM PaymentTypetb";
							        $payquery=mysqli_query($dbconnect,$payselect);
							        $paycount=mysqli_num_rows($payquery);
							        for ($i=0; $i < $paycount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($payquery);
							            $paycode=$fetch['PaymentTypeCode'];
							            $payname=$fetch['PaymentType'];

							            echo "<option value='$paycode'>$payname</option>";
							        }
							        
							        ?>
                            </select>
                    </div>
                    <p class="policy">
                        In addition to the uses listed in our privacy policy, your personal information will be utilized to fulfill your order and enhance your online experience.
                    </p>
                    <button type="submit" name="btnorder" class="btnplaceorder btn btn-danger py-3 px-4 w-100 my-3">Place Order</button>
                </div>
            </form>
        </section>

        <footer class="footer-59391">

            <div class="container">

                <div class="row mb-5">
                    <div class="col-md-4">
                        <div class="site-logo">
                            <a href="#">Medicare</a>
                        </div>
                    </div>
                    <div class="col-md-8 text-md-right">
                        <ul class="list-unstyled social-icons">
                            <li><a href="#" class="fb"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#" class="tw"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="#" class="in"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#" class="yt"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="#" class="rd"><i class="fa-brands fa-reddit-alien"></i></a></li>
                            <li><a href="#" class="lk"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6 ">
                        <ul class="nav-links list-unstyled nav-left">
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <ul class="nav-links list-unstyled nav-right">
                            <li><a href="homepage.php">Home</a></li>
                            <li><a href="product.php">Our Products</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col ">
                        <div class="copyright">
                            <p><small>Copyright 2024. All Rights Reserved.</small></p>
                        </div>
                    </div>
                </div>

            </div>
        </footer>

    </div>
</body>

</html>