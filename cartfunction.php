<?php
// session_start();

    function AddProduct($procode,$proqty)
    { 
        include('connectmedicare.php');
        $select="SELECT * FROM BeautyProducttb
        where BeautyProductCode='$procode'";
        $query=mysqli_query($dbconnect,$select);
        $count=mysqli_num_rows($query);
        if($count>0)
        {
            $data=mysqli_fetch_array($query);
            $proname=$data['BeautyProductName'];
            $proimg1=$data['BeautyProductImg1'];
            $price=$data['ProductPrice'];
        }

        if(isset($_SESSION['Cart_Function'])) 
        {
            $Index=IndexOf($procode);
            if($Index == -1) 
            {
                $size=count($_SESSION['Cart_Function']);
                $_SESSION['Cart_Function'][$size]['BeautyProductCode']=$procode;
                $_SESSION['Cart_Function'][$size]['Price']=$price;
                $_SESSION['Cart_Function'][$size]['Quantity']=$proqty;
                $_SESSION['Cart_Function'][$size]['BeautyProductName']=$proname;
                $_SESSION['Cart_Function'][$size]['BeautyProductImg1']=$proimg1;
                $_SESSION['Cart_Function'][$size]['PromotionPrice']=0;
            }
            else
            {
                $_SESSION['Cart_Function'][$Index]['Quantity']+=$proqty;
            }
        }
        else
        {
            $_SESSION['Cart_Function']=array(); //Create Session Array
            $_SESSION['Cart_Function'][0]['BeautyProductCode']=$procode;
            $_SESSION['Cart_Function'][0]['Price']=$price;
            $_SESSION['Cart_Function'][0]['Quantity']=$proqty;
            $_SESSION['Cart_Function'][0]['BeautyProductName']=$proname;
            $_SESSION['Cart_Function'][0]['BeautyProductImg1']=$proimg1;
            $_SESSION['Cart_Function'][0]['PromotionPrice']=0;
    
        }
    }
    function updateProduct($beaprocode, $proqty) {
        $index = indexOf($beaprocode);
        if ($index != -1) {
            $_SESSION['Cart_Function'][$index]['Quantity'] = $proqty;
        }
    }
    
    function RemoveProduct($BeaProcode)
    {
        $Index=IndexOf($BeaProcode);

        unset($_SESSION['Cart_Function'][$Index]);

        $_SESSION['Cart_Function']=array_values($_SESSION['Cart_Function']);

        echo "<script>window.location='cart.php'</script>";
    }
    function CalculateTotalAmount()
    {
        if(isset($_SESSION['Cart_Function'])) 
        {
            $TotalAmount=0;

            $size=count($_SESSION['Cart_Function']);

            for ($i=0; $i < $size; $i++) 
            { 
                $PurQty=$_SESSION['Cart_Function'][$i]['Quantity'];
                $PurPrice=$_SESSION['Cart_Function'][$i]['Price'];
                $TotalAmount += ($PurQty * $PurPrice);

                
            }

            return $TotalAmount;
        }
        else
        {
            $TotalAmount=0;

            return $TotalAmount;
        }
    }


    function CalculateTotalQuantity()
    {
        if(isset($_SESSION['Cart_Function'])) 
        {
            $TotalQuantity=0;

            $size=count($_SESSION['Cart_Function']);

            for ($i=0; $i < $size; $i++) 
            { 
                $PurQuantity=$_SESSION['Cart_Function'][$i]['Quantity'];                
                $TotalQuantity += $PurQuantity;

                
            }

            return $TotalQuantity;
        }
        else
        {
            $TotalQuantity=0;

            return $TotalQuantity;
        }
    }
    function CalculateTotalPromotionPrice()
    {
        include("connectmedicare.php");
        if(isset($_SESSION['Cart_Function'])) 
        {
            $TotalPromotionPrice=0;

            $size=count($_SESSION['Cart_Function']);

            for ($i=0; $i < $size; $i++) 
            { 
                $Price=$_SESSION['Cart_Function'][$i]['Price'];
                $PurQuantity=$_SESSION['Cart_Function'][$i]['Quantity'];
                $BeautyProductCode=$_SESSION['Cart_Function'][$i]['BeautyProductCode'];
                $query1 = "SELECT b.*,p.PromotionName,p.PromotionCode,pb.PromotionRate FROM BeautyProducttb AS b 
                LEFT OUTER JOIN Promotion_BeautyProducttb AS pb ON b.BeautyProductCode=pb.BeautyProductCode LEFT OUTER JOIN Promotiontb AS p ON p.PromotionCode=pb.PromotionCode WHERE b.BeautyProductCode='$BeautyProductCode'";
                $result1 = mysqli_query($dbconnect, $query1);
                $data = mysqli_fetch_array($result1);
                $prorate = $data['PromotionRate'];
                $BeautyProductName = $data['BeautyProductName'];
                if (isset($prorate)){
                    $PromotionPrice= ($prorate / 100) * $Price;
                    $_SESSION['Cart_Function'][$i]['PromotionPrice'] = $PromotionPrice * $PurQuantity;
                }
                else{
                    $_SESSION['Cart_Function'][$i]['PromotionPrice']=0;
                }
               
    
            }
            for ($i= 0; $i < $size; $i++){
                $TotalPromotionPrice+=$_SESSION['Cart_Function'][$i]['PromotionPrice'];
            }

            return $TotalPromotionPrice;
        }
        else
        {
            $TotalPromotionPrice=0;

            return $TotalPromotionPrice;
        }
    }
    function IndexOf($productcode)
    {
        if(!isset($_SESSION['Cart_Function'])) 
        {
            return -1;
        }
        
            $size=count($_SESSION['Cart_Function']);
            if ($size < 1) 
            {
                return -1;
            }
            else
            {
                for ($i=0; $i < $size; $i++) 
                { 
                    if($productcode == $_SESSION['Cart_Function'][$i]['BeautyProductCode']) 
                    {
                        return $i;
                    }
                }
                return -1;
            }
    }
?>