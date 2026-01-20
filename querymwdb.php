<?php

include('connectmedicare.php');

// $create="CREATE TABLE Order_BeautyProducttb
//    (
//    		OrderBeautyProductCode VARCHAR(30) not null Primary Key,
// 			BeautyProductCode VARCHAR(30),
// 			OrderCode VARCHAR(30),
// 			OrderProductQty int,
// 			OrderProductPrice DECIMAL(10, 2),
// 			TotalAmount DECIMAL(10, 2),
// 			PromotionPrice DECIMAL(10, 2),
// 			NetPrice DECIMAL(10, 2),
// 	 		Foreign Key (BeautyProductCode) REFERENCES BeautyProducttb(BeautyProductCode),
// 	 		Foreign Key (OrderCode) REFERENCES Ordertb (OrderCode)
//   )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Order Beauty Product table is set up successfully";
// }
// else
// {
// 	echo "Order Beauty Product table set up fail";
// }

// $create="CREATE TABLE Ordertb
//    (
//    	OrderCode VARCHAR(30) not null primary key,
//  	 	OrderDate date,
//  		CustomerID VARCHAR(30),
// 		PaymentTypeCode VARCHAR(30),
// 		OrderCustomerName VARCHAR(30),
// 		OrderEmail VARCHAR(30),
// 		OrderPhone VARCHAR(30),
// 		OrderAddress VARCHAR(100),
// 		OrderCity VARCHAR(30),
// 		OrderTownship VARCHAR(30),
// 		TotalQuantity int,
// 		TotalPrice DECIMAL(10, 2),
//     TotalAmount DECIMAL(10, 2),
//     TotalPromotionPrice DECIMAL(10, 2),
//     TotalNetPrice DECIMAL(10, 2),
// 		OrderStatus VARCHAR(30),
// 		DeliveryID VARCHAR(30),
//  		Foreign Key (CustomerID) REFERENCES Customertb(CustomerID),
//  		Foreign Key (PaymentTypeCode) REFERENCES PaymentTypetb(PaymentTypeCode),
//  		Foreign Key (DeliveryID) REFERENCES Deliverytb(DeliveryID)
//   )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Order table is set up successfully";
// }
// else
// {
// 	echo "Order table set up fail";
// }

// $create="CREATE TABLE Promotion_BeautyProducttb
//    (
//    	BeautyProductCode VARCHAR(30) not null,
//  	 	PromotionCode VARCHAR(30) not null,
//  		PromotionRate int,
// 		PromotionStartDate date,
//  		PromotionEndDate date,
//  		PromotionDuration VARCHAR(50),
//  		Foreign Key (BeautyProductCode) REFERENCES BeautyProducttb(BeautyProductCode),
//  		Foreign Key (PromotionCode) REFERENCES Promotiontb (PromotionCode),
//  		Primary Key (BeautyProductCode, PromotionCode)
//   )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Promotion Beauty Product table is set up successfully";
// }
// else
// {
// 	echo "Promotion Beauty Product table set up fail";
// }

// $create="CREATE TABLE Supplier_BeautyProducttb
//   (
//   		SuppliedCode VARCHAR(30) not null,
//   		BeautyProductCode VARCHAR(30),
// 	 	SupplierID VARCHAR(30),
// 		SuppliedDate date,
// 		SuppliedProductQuantity int,
// 		SuppliedUnitPrice int,
// 		TotalPrice int,
// 		Foreign Key (BeautyProductCode) REFERENCES BeautyProducttb(BeautyProductCode),
// 		Foreign Key (SupplierID) REFERENCES Suppliertb (SupplierID),
// 		Primary Key (SuppliedCode)

//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Supplier_BeautyProduct table is set up successfully";
// }
// else
// {
// 	echo "Supplier_BeautyProduct table is set up fail";
// }


// $create="CREATE TABLE BeautyProducttb
//   (
//   	BeautyProductCode VARCHAR(30) not null primary key,
// 		BrandCode VARCHAR(30),
// 	 	ProductTypeCode VARCHAR(30),
// 		BeautyProductName VARCHAR(50),
// 	 	BenefitsofProduct VARCHAR(100),
// 		UsageInstruction VARCHAR(100),
// 	 	Storagelnstruction VARCHAR(100),
// 	 	CountryofOrigin VARCHAR(30),
// 		ProductPrice int,
// 	 	ProductQuantity int,
// 	 	ExpiredDate date,
// 	 	ManufacturedDate date,
// 		BeautyProductImg1 varchar(255),
// 		BeautyProductImg2 Varchar(255),
// 		Foreign Key(BrandCode) References Brandtb(BrandCode),
// 		Foreign Key(ProductTypeCode) References ProductTypetb(ProductTypeCode)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Beauty Product table is set up successfully";
// }
// else
// {
// 	echo "Beauty Product table is set up fail";
// }


// $create="CREATE TABLE Promotiontb
//   (
// 	PromotionCode varchar(30) not null primary key,
//   PromotionName varchar(30),
// 	PromotionMonth varchar(30),
// 	PromotionDescription varchar(255)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Promotion table set up successfully";
// }
// else
// {
// 	echo "Promotion table set up fail";
// }


// $create="CREATE TABLE Deliverytb
//   (
// 	DeliveryID varchar(30) not null primary key,
// 	DeliveryName varchar(30),
// 	DeliveryPhone varchar(30),
// 	DeliveryEmail varchar(30),
// 	DeliveryOfficeAddress varchar(50)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Delivery table set up successfully";
// }
// else
// {
// 	echo "Delivery table set up fail";
// }

// $create="CREATE TABLE ProductTypetb
//   (
// 	ProductTypeCode varchar(30) not null primary key,
//   ProductTypeName varchar(30),
// 	Description varchar(100)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Product Type table set up successfully";
// }
// else
// {
// 	echo "Product Type table set up fail";
// }

// $create="CREATE TABLE Brandtb
//   (
// 	BrandCode varchar(30) not null primary key,
//   BrandName varchar(30),
// 	Description varchar(100)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Brand table set up successfully";
// }
// else
// {
// 	echo "Brand table set up fail";
// }

// $create="CREATE TABLE Suppliertb
//   (
// 	SupplierID varchar(30) not null primary key,
// 	SupplierName varchar(30),
// 	SupplierPhoneNo varchar(30),
// 	SupplierEmail varchar(30),
// 	SupplierAddress varchar(50)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Supplier table set up successfully";
// }
// else
// {
// 	echo "Supplier table set up fail";
// }

// $create="CREATE TABLE Customertb
//   (
// 	CustomerID varchar(30) not null primary key,
// 	CustomerName varchar(30),
// 	CustomerPhoneNo varchar(30),
// 	CustomerUsername varchar(30),
// 	CustomerEmail varchar(30),
// 	CustomerPassword varchar(30),
// 	CustomerAddress varchar(50)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Customer table set up successfully";
// }
// else
// {
// 	echo "Customer table set up fail";
// }

// $create="CREATE TABLE Admintb
//   (
// 	AdminID varchar(30) not null primary key,
//   AdminFirstName varchar(30),
// 	AdminSurName varchar(30),
// 	AdminUsername varchar(30),
// 	AdminEmail varchar(30),
// 	AdminPassword varchar(30),
// 	AdminPhoneNo varchar(30),
// 	AdminAddress varchar(30)
//  )";

// $result=mysqli_query($dbconnect,$create);

// if ($result)
// {
// 	echo "Admin table set up successfully";
// }
// else
// {
// 	echo "Admin table set up fail";
// }
?>