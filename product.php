<?php

session_start();
include ('connectmedicare.php');
include ('cartfunction.php');

if (isset($_POST['btnaddcart'])) {
  $procode = $_POST['txtprocode'];
  $proqty = $_POST['txtproqty'];

  AddProduct($procode, $proqty);
  echo "<script>window.alert('The product is successfully added to the cart.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Product</title>
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
    <div class="search-container">
      <form action="product.php" method="POST">
        <div class="wrap">
          <div class="search">
            <input type="text" class="searchTerm" placeholder="Search here" name="txtsearch">
            <button type="submit" class="searchButton" name="btnsearch">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="pro-body">
      <div class="filter-contain p-3 shadow-sm p-3 mb-5 bg-light rounded">
        <div class="heading p-2 text-left border-bottom border-danger mb-4">
          <span class="filter-icon"><i class="fa-solid fa-filter"></i></span>Filter By Price
        </div>
        <div class="filtercontent">
          <form action="product.php" method="POST">
            <div class="filterform">
              <div class="min-box">
                <label for="min-price">Min</label>
                <input class="w-50" type="text" name="txtmin-price" id="min-price" placeholder="1500">
              </div>
              <div class="dash w-50 h-50 text-center">
                ---
              </div>
              <div class="max-box">
                <label for="max-price">Max</label>
                <input class="w-50" type="text" name="txtmax-price" id="max-price" placeholder="5000">
              </div>
            </div>
            <div>
              <input class="btn btn-danger m-3" type="submit" value="Filter" name="btnfilter">
              <button class="btn btn-primary m-3" name="btnshowall">Show All</button>

            </div>
          </form>
        </div>

      </div>
      <!-- Product Display -->
      <div class="product-contain">
        <div class="campaignDisplay">
          <?php

          if (isset($_POST['btnfilter'])) {

            $min = $_POST['txtmin-price'];
            $max = $_POST['txtmax-price'];
            if (!($min >= 1500 && $max <= 5000)) {
              echo "<script>window.alert('Filtering Product Price Should Be Between 1500 and 5000.')</script>";
              echo "<script>window.location='product.php'</script>";
            } else {
              $query = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
              LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode WHERE b.ProductPrice >= '$min' AND b.ProductPrice <= '$max'";
              $result = mysqli_query($dbconnect, $query);
              $count = mysqli_num_rows($result);
              if ($count > 0) {

                echo "<div class='heading p-4 text-uppercase'>Our Products > Product by Price</div>";

                echo "<div class='campContainer'>";

                for ($i = 0; $i < $count; $i += 5) {
                  $query1 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
                  LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode WHERE b.ProductPrice >= '$min' AND b.ProductPrice <= '$max' LIMIT $i,5";
                  $result1 = mysqli_query($dbconnect, $query1);
                  $count1 = mysqli_num_rows($result1);



                  for ($j = 0; $j < $count1; $j++) {
                    $data = mysqli_fetch_array($result1);
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
                        <p>Beauty Product Name: <?php echo $BeaName; ?></p>
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
                          <a class="btn btn-danger" href="productdetails.php?BeaCode=<?php echo $BeaCode; ?>">View Detail</a>
                        </div>
                      </div>
                    </div>
                    <?php
                  }


                }

                echo "</div>";
              } else {
                echo "<h1>No such result <i class='fa-solid fa-face-sad-tear'></i></h1>";
              }
            }

          } elseif (isset($_POST['btnshowall'])) {
            echo "<div class='heading p-4 text-uppercase'>Our Products</div>";

            $query2 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
            LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode";
            $ret = mysqli_query($dbconnect, $query2);

            $count3 = mysqli_num_rows($ret);
            if ($count3 == 0) {
              echo "<p>No Beauty Product Found</p>";
            } else {
              echo "<div class='campContainer'>";
              for ($i = 0; $i < $count3; $i += 4) // row
              {
                $query3 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
                LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode LIMIT $i,4";

                $ret1 = mysqli_query($dbconnect, $query3);

                $count4 = mysqli_num_rows($ret1);



                for ($j = 0; $j < $count4; $j++) //column
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

          } elseif (isset($_POST['btnsearch'])) {
            $search = $_POST['txtsearch'];
            echo "<div class='heading p-4 text-uppercase'>Our Products</div>";

            $query2 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
            LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode WHERE BeautyProductName Like '%$search%'";
            $ret = mysqli_query($dbconnect, $query2);

            $count2 = mysqli_num_rows($ret);
            if ($count2 == 0) {
              echo "<p>No Beauty Product Found</p>";
            } else {
              echo "<div class='campContainer'>";
              for ($i = 0; $i < $count2; $i += 4) // row
              {
                $query3 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
                LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode WHERE BeautyProductName Like '%$search%' LIMIT $i,4";

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
          } else {
            echo "<div class='heading p-4 text-uppercase'>Our Products</div>";

            $query2 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
            LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode";
            $ret = mysqli_query($dbconnect, $query2);

            $count2 = mysqli_num_rows($ret);
            if ($count2 == 0) {
              echo "<p>No Beauty Product Found</p>";
            } else {
              echo "<div class='campContainer'>";
              for ($i = 0; $i < $count2; $i += 4) // row
              {
                $query3 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
                LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode LIMIT $i,4";

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

          }
          ?>

        </div>
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