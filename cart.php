<?php
session_start();
include ("connectmedicare.php");
include ("cartfunction.php");


if (isset($_REQUEST['pcode'])) {
    $pcode = $_REQUEST['pcode'];
    RemoveProduct($pcode);
}

if (isset($_POST['btnUpdate'])) {
    $bpcode = $_POST['txtbpcode'];
    $proqty = $_POST['txtproqty'];
    updateProduct($bpcode, $proqty);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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

        <section class="cart-body">
            <div class="sitepath m-4">
                <span class="text-danger mx-2">Home</span> > <span class="text-danger mx-2">Cart</span>
            </div>
            <?php
            $size = count($_SESSION['Cart_Function']);
            if (!isset($_SESSION["Cart_Function"])) {
                echo "<h1 class='text-center m-5'>Your Cart is Empty</h1>";

            } elseif ($size < 1) {
                echo "<h1 class='text-center m-5'>Your Cart is Empty</h1>";
            } else {
                ?>
                <div class="table-section">
                    <div class="heading text-center m-5 font-weight-bold">Shopping Cart</div>
                    <form action="cart.php" method="POST">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $count = count($_SESSION["Cart_Function"]);

                                for ($i = 0; $i < $count; $i++) {
                                    $BeautyProductCode = $_SESSION['Cart_Function'][$i]['BeautyProductCode'];
                                    $Price = $_SESSION['Cart_Function'][$i]['Price'];
                                    $Quantity = $_SESSION['Cart_Function'][$i]['Quantity'];
                                    $BeautyProductName = $_SESSION['Cart_Function'][$i]['BeautyProductName'];
                                    $BeautyProductImage = $_SESSION['Cart_Function'][$i]['BeautyProductImg1'];
                                    $Subtotal = $Price * $Quantity;

                                    echo "
                            <tbody>
                            <tr>
                                <td><div class='cart-image'><img src='$BeautyProductImage' alt=''></div></td>
                                <td>$BeautyProductName</td>
                                <td>$Price</td>
                                <td><input class='num mx-2' type='number' name='txtproqty' min='1' max='50' value='$Quantity'></td>
                                <td>$Subtotal</td>
                                <td><a class='btn btn-danger' href='cart.php?pcode=$BeautyProductCode'>Remove</a></td>
                            </tr>
                            </tbody>";

                                }
                                ?>
                            </table>
                            <input type="text" name="txtbpcode" value="<?php echo $BeautyProductCode; ?>" hidden>
                        </div>
                        <?php
                        echo "
                        <div class='buttons text-right m-3'>
                        <input class='btn btn-success m-1' type='submit' name='btnUpdate' value='Update Cart'>
                        <a class='btn btn-info m-1' href='checkout.php'>Check Out</a>
                        </div>
                        ";
            }
            ?>
                </form>
                <div class="cart-total text-right">
                    <div class="m-3">
                        <h3 class="border-bottom py-3 border-danger">Cart Totals</h3>
                        <p class="border-bottom pb-2 border-dark">Total Amount - <?php echo CalculateTotalAmount() ?></p>
                        <p class="bp-2">Total Quantity - <?php echo CalculateTotalQuantity() ?></p>
                    </div>
                </div>
            </div>

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