<?php
	$servername = "localhost";
	$username = "datafreaks";
	$password = "sesame";
	$dbname = "DATAFREAKS_DATAWAREHOUSE";
	
	
	// Create connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $query = $conn->prepare("SELECT O.ORDERADDRESSCOUNTRY AS 'Country',Sum(ST.TRANSACTIONAMOUNT) AS 'Total_Sales_Amount',Sum(ST.TRANSACTIONQUANTITY) AS 'Total_Items_Sold' FROM salestranaction ST, orderdate OD, orders O WHERE ST.ORDERDATEID = OD.ORDERDATEID AND ST.ORDERID = O.ORDERID GROUP BY O.ORDERADDRESSCOUNTRY");

    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode($row);
	
?>