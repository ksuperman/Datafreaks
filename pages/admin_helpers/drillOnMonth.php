<?php
	$month = $_POST['month'];
	$year = $_POST['year'];
	$quarter = $_POST['quarter'];
	
	$servername = "localhost";
	$username = "datafreaks";
	$password = "sesame";
	$dbname = "DATAFREAKS_DATAWAREHOUSE";
	
	
	// Create connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $query = $conn->prepare("SELECT Sum(ST.TRANSACTIONAMOUNT) AS 'Total_Sales_Amount', Sum(ST.TRANSACTIONQUANTITY) AS 'Total_Items_Sold',(Floor((Dayofmonth(FULLDATE) - 1) / 7) + 1 ) AS 'Week',OD.MONTH AS 'Financial_Month', Quarter(OD.FULLDATE) AS 'Financial_Quarter', OD.YEAR AS 'Financial_Year' FROM salestranaction ST, orderdate OD WHERE ST.ORDERDATEID = OD.ORDERDATEID AND OD.YEAR = :year AND Quarter(OD.FULLDATE) = :quarter AND OD.MONTH = :month GROUP BY OD.YEAR, Quarter(OD.FULLDATE),OD.MONTH, WEEK");
		$params = array(
		   "month" => $month,
		   "year" => $year,
		   "quarter" => $quarter
		);

    $query->execute($params);
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode($row);
?>