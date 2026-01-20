<?php
session_start();
include ("conectmedicare.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact</title>
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
    <header class="contact-header">
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
      <div class="con-header-container">
        <h3 class="heading">Contact Us</h3>
        <p class="content">
          Make Contact and Communicate With Us
        </p>
      </div>
    </header>
    <div class="home-content">
      <div class="img">
        <img src="img/con-content.jpg" alt="">
      </div>
      <div class="content">
        <h3>Contact Us</h3>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque hic dignissimos recusandae! Ullam ut
          architecto, voluptatibus cum quam nisi tempora aspernatur repudiandae accusantium officia voluptas dicta autem
          blanditiis inventore ad!
        </p>
      </div>
    </div>

    <div class="contact-form my-5">

      <h3 class="text-center my-3">Contact Form</h3>

      <div class="container">
        <form action="/action_page.php">
          <label for="fname">First Name</label>
          <input type="text" id="fname" name="firstname" placeholder="Your name..">

          <label for="lname">Last Name</label>
          <input type="text" id="lname" name="lastname" placeholder="Your last name..">

          <label for="subject">Subject</label>
          <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

          <input type="submit" value="Submit">
        </form>
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