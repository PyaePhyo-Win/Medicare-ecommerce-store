<?php

session_start();
include('connectmedicare.php');

if (!isset($_SESSION['AID'])) 
{
	echo "<script>window.alert('You Cannot Update Data. Login Again!')</script>";
	echo "<script>window.location='AdminLogin.php'</script>";
}

$AUN=$_SESSION['AUNAME'];

if (isset($_GET['orcode'])) 
{
	$orcode=$_GET['orcode'];

     $orquery="SELECT * FROM Ordertb WHERE OrderCode='$orcode'";
     $result=mysqli_query($dbconnect,$orquery);
     $fetcharray=mysqli_fetch_array($result);

     $orcode=$fetcharray['OrderCode'];
     $status=$fetcharray['OrderStatus'];
     
}

if (isset($_POST['btnconfirm'])) 
{
	
  $txtorcode=$_POST['txtorcode'];
  $cbodeli=$_POST['cbodeli'];

	$confirm="UPDATE Ordertb
			SET 
			OrderStatus='Confirm', DeliveryID='$cbodeli'
			WHERE OrderCode='$txtorcode'";

	$result=mysqli_query($dbconnect,$confirm);

	if ($result) 
	{
		echo "<script>window.alert('Order is Successfully Confirmed.')</script>";
        echo "<script>window.location='CustomerListing.php'</script>";
    }
    else
    {
   		echo"<script>window.alert('Something Went Wrong in Order Confirmation')</script>";
   		echo "<script>window.location='OrderConfirmAssign.php'</script>";

    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order Confirm and Assign</title>
	<link rel="stylesheet" type="text/css" href="AdminStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/97dff553a5.js" crossorigin="anonymous"></script>
</head>
<body class="updatebody">
	<div class="Updateheader">
		<a href="CustomerListing.php"><i class="fa-solid fa-circle-left"></i></a>
		<h2>Medicare Dashboard</h2>
		<div class="header-right">
        <i class="fa-solid fa-user"></i> <?php echo $AUN ; ?> 
        </div>
	</div>

    <div class="SupContainer">
			
			<div class="addsupplier">

				<h1 class="title-form">Assign & Confirm Order</h1>

					<form action="" method="POST">

						<div class="supform"> 

							<div class="supinfo">
							
                            <label>Choose Delivery</label><br>
			                    <select name="cbodeli" required>
			                        <option>Select Delivery</option>
							        <?php

							        echo $deliselect="SELECT * FROM Deliverytb";
							        $deliquery=mysqli_query($dbconnect,$deliselect);
							        $delicount=mysqli_num_rows($deliquery);
							        for ($i=0; $i < $delicount; $i++) 
							        { 
							            $fetch=mysqli_fetch_array($deliquery);
							            $deliid=$fetch['DeliveryID'];
                                        $deliname=$fetch['DeliveryName'];

							            echo "<option value='$deliid'>$deliname</option>";
							        }
							        
							        ?>
						    	</select><br>


								<input type="hidden" name="txtorcode" value="<?php echo $orcode; ?>">
							
							</div>

						</div>
					
						<?php 
							if ($status==="Pending") 
							{
								echo "
            							<button class='btn btn-info text-white text-center' type='submit' name='btnconfirm'>CONFIRM</button>
        							";
							}
							else
							{
								echo "
            					<button class='btn btn-danger' name='btnconfirm' disabled>CONFIRM</button>
        							";
							}
		                ?>
					</form>
			</div>

		</div>
    
</body>
</html>