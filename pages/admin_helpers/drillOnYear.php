<?php
	$year = $_POST['year'];
	
	$servername = "localhost";
	$username = "datafreaks";
	$password = "sesame";
	$dbname = "DATAFREAKS_DATAWAREHOUSE";
	
	
	// Create connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $query = $conn->prepare("SELECT SUM(ST.TRANSACTIONAMOUNT) AS Total_Sales_Amount, SUM(ST.TRANSACTIONQUANTITY) AS Total_Items_Sold, Quarter(OD.FULLDATE) AS Financial_Quarter, OD.YEAR AS Financial_Year FROM salestranaction ST, orderdate OD WHERE ST.ORDERDATEID = OD.ORDERDATEID AND OD.YEAR = :year GROUP BY OD.YEAR, Quarter(OD.FULLDATE)");
		$params = array(
		   "year" => $year
		);

    $query->execute($params);
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode($row);
?>