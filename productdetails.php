<?php

session_start();
include ('connectmedicare.php');
include ('cartfunction.php');

if (isset($_GET['BeaCode'])) 
{
	$BeaCode=$_GET['BeaCode'];
	$selectquery="SELECT * FROM BeautyProducttb bp,  Brandtb b, ProductTypetb pt
	WHERE bp.BrandCode=b.BrandCode
	AND pt.ProductTypeCode=bp.ProductTypeCode 
	AND bp.BeautyProductCode='$BeaCode'";

	$query2=mysqli_query($dbconnect,$selectquery);

	$data=mysqli_fetch_array($query2);

	$BeautyProductCode=$data['BeautyProductCode'];
	$BeautyProductName=$data['BeautyProductName'];
	$BenefitsofProduct=$data['BenefitsofProduct'];
	$UsageInstruction=$data['UsageInstruction'];
	$Storagelnstruction=$data['Storagelnstruction'];
	$CountryofOrigin=$data['CountryofOrigin'];
	$ProductPrice=$data['ProductPrice'];
	$ProductQuantity=$data['ProductQuantity'];
	$ExpiredDate=$data['ExpiredDate'];
	$ManufacturedDate=$data['ManufacturedDate'];
	$BeautyProductImg1=$data['BeautyProductImg1'];
	$BeautyProductImg2=$data['BeautyProductImg2'];
	$BrandCode=$data['BrandCode'];
	$BrandName=$data['BrandName'];
	$MAL=$data['Description'];
	$ProductTypeCode=$data['ProductTypeCode'];
	$ProductTypeName=$data['ProductTypeName'];
	$ProtypeDescription=$data['Description'];

    $query2 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode WHERE pb.BeautyProductCode='$BeaCode'";
    $ret = mysqli_query($dbconnect, $query2);
    $data2 = mysqli_fetch_array($ret);

    $PromotionName=$data2["PromotionName"];
    $PromotionCode=$data2["PromotionCode"];
    $PromotionRate=$data2["PromotionRate"];

}
if (isset($_POST['btnADD'])) {
    $procode=$_POST['txtprocode'];
    $proqty=$_POST['txtproqty'];

    AddProduct($procode,$proqty);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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

        <section class="prodetail-body">
            <div class="sitepath m-4">
                <span class="text-danger mx-2">Products</span>  > <span class="text-danger mx-2">Product Details</span>  =  <span class="text-danger mx-2"><?php echo $BeautyProductName;?></span>
            </div>
            <form action="" method="POST">
                <div class="detail-img">
                    <div class="image">
                        <img class="img-fluid" src="<?php echo $BeautyProductImg1; ?>" alt="">
                    </div>
                    <div class="image">
                        <img class="img-fluid" src="<?php echo $BeautyProductImg2; ?>" alt="">
                    </div>
                    <div class="product-content">
                        <div class="heading border-bottom border-danger pb-2">
                            <p><?php echo $ProductTypeName;?></p>
                            <h3><?php echo $BeautyProductName;?></h3>
                            <?php
                                if ($ProductQuantity == 0) {
                                    
                                    echo "<p class='text-danger'>Out of Stock</p>";
                                }
                                else {
                                    echo "<p>Availability:<span class='text-info'> $ProductQuantity in stock</span></p>";
                                }

                                if (isset($PromotionCode)) {
                                    echo "Tags:<span class='text-white p-2 bg-danger border border-danger rounded'> $PromotionName ($PromotionRate%) </span>";
                                }
                            ?>
                        </div>
                        <div class="prodetail py-4">
                            <h3><?php echo $ProductPrice; ?> Ks</h3>
                            <p><?php echo $BrandName;?></p>
                            <input class="num mx-2" type="number" name="txtproqty" min="1" max="<?php echo $ProductQuantity;?>">
                            <input type="text" name="txtprocode" value="<?php echo $BeautyProductCode; ?>" hidden>
                            <input class="btn btn-primary" type="submit" name="btnADD" value="Add to Cart">
                           
                        </div>
                    </div>
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