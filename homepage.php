<?php 
session_start();
include("connectmedicare.php");
include ('cartfunction.php');

if (isset($_POST['btnaddcart'])) {
  $procode=$_POST['txtprocode'];
  $proqty=$_POST['txtproqty'];

  AddProduct($procode,$proqty);
  echo "<script>window.alert('The product is successfully added to the cart.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Home Page</title>
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
      <header class="home-header">
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
         <div class="header-container">
            <h3 class="heading">Our Best Products</h3>
            <p class="content">
               Medicare offers best products in the world to make you beautiful.
            </p>
            <div class="btn">
               <a href="shop.php">Shop Now</a>
            </div>
         </div>
      </header>
      <div class="home-content">
         <div class="content">
            <h3>About Us</h3>
            <p>
               One of the first beauty retailers in Vietnam is called MEDiCARE. For clients who are young at heart and
               wish to maintain their beauty while following current trends, we give a wide selection of authentic
               beauty items at competitive costs with quality assurance.
            </p>
            <a href="about.php">Read More</a>
         </div>
         <div class="img">
            <img src="img/about-content.jpg" alt="">
         </div>
      </div>
      <!-- Product Display -->
      <div class="product-contain">
         <div class="my-5 campaignDisplay border-bottom border-top border-danger py-3">
            <?php
            echo "<div class='heading p-4 text-uppercase text-center'>Our Products</div>";

            $query2 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
            LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode LIMIT 3";
            $ret = mysqli_query($dbconnect, $query2);

            $count2 = mysqli_num_rows($ret);
            if ($count2 == 0) {
               echo "<p>No Beauty Product Found</p>";
            } else {
               echo "<div class='campContainer'>";
               for ($i = 0; $i < $count2; $i += 4) // row
               {
                  $query3 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
                LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode LIMIT $i,3";

                  $ret1 = mysqli_query($dbconnect, $query3);

                  $count5 = mysqli_num_rows($ret1);



                  for ($j = 0; $j < $count5; $j++) //column
                  {
                     $data = mysqli_fetch_array($ret1);
                     $BeaCode = $data['BeautyProductCode'];
                     $BeaName = $data['BeautyProductName'];
                     $Img1 = $data['BeautyProductImg1'];
                     $Proprice = $data['ProductPrice'];
                     $Img2 = $data['BeautyProductImg2'];
                     $prorate = $data['PromotionRate'];
                     $procode = $data['PromotionCode'];

                     ?>

                     <div class="camp">
                        <div class="campImage">
                           <img src="<?php echo $Img1; ?>">
                        </div>
                        <div class="campcontent">
                           <p>Beauty Product Name: <?php echo $BeaName; ?> </p>
                           <p>Product Price: <?php echo $Proprice; ?> </p>
                           <?php
                           if (isset($procode)) {
                              echo "<span class='text-white bg-danger border border-danger p-2'>Promotion: $prorate %</span>";
                           }
                           ?>
                           <div class="btncampDetail">
                              <form action="" method="POST">
                                 <input type="text" name="txtprocode" value="<?php echo $BeaCode; ?>" hidden>
                                 <input type="text" name="txtproqty" value="1" hidden>
                                 <input class="btn btn-primary" type="submit" name="btnaddcart" value="Add to Cart">
                              </form>
                              <a href="productdetails.php?BeaCode=<?php echo $BeaCode; ?>">View Detail</a>
                           </div>
                        </div>
                     </div>

                     <?php

                  }


               }
               echo "</div>";
            }
            ?>
            <div class="text-center">
               <a href="product.php" class="btn btn-info">More Product</a>
            </div>
            
         </div>
      </div>
      <div class="home-content1">
         <div class="img">
            <img src="img/con-content.jpg" alt="">
         </div>
         <div class="content">
            <h3>Contact Us</h3>
            <p>
               Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque hic dignissimos recusandae! Ullam ut
               architecto, voluptatibus cum quam nisi tempora aspernatur repudiandae accusantium officia voluptas dicta
               autem blanditiis inventore ad!
            </p>
            <a href="contact.php">Contact Now</a>
         </div>
      </div>
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