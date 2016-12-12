<!DOCTYPE html>
<!--suppress ALL -->
<html >
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Online Shopping Cart</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/additional-methods.js" type="application/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="application/javascript"></script>
	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="vendor/metisMenu/metisMenu.css" rel="stylesheet">
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="vendor/morrisjs/morris.css" rel="stylesheet">
	<link href="vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
	<!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="admin_helpers/morris-data.js"></script>
	<!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">
    <?php
        include("./partials/header_links.php");
    ?>
	<?php
		include "../utilities/global_variables.php";
	?>
	<?php
        include("../utilities/dbConnectDW.php");
    ?>
</head>
<body>

    <style>
        a{
            text-decoration: underline;
        }
        a:visited{
            color: #0502a2;
        }
    </style>

	<div class="well well-lg" style="background-color:black";>
	<font color="white"><h4><b><center>Online Shopping Portal - Admin Dashboard</center></b></h4></font>
	<font color="white"><h6><center>Project by Team Datafreaks</center></h6></font>
	</div>
    
	<div id="wrapper">
	<div id="app-container">
        <div class="alert alert-warning alert-dismissible hidden" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
	<div id="content">
		<ul id="tabs" class="nav nav-tabs nav-justified" data-tabs="tabs">
			<li class="active"><a href="#maxSales" data-toggle="tab">Sales in all years</a></li>
			<li><a href="#SalesDrillDown" data-toggle="tab">Sales Drilled Down in Time</a></li>
			<li><a href="#RollUpSales" data-toggle="tab">Sales Rolled up by location</a></li>
		</ul>
		<div id="my-tab-content" class="tab-content">
			<div class="tab-pane active" id="maxSales">
			<br/> <br/>
                <!-- /.panel-heading -->
				<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
				<div class="panel panel-primary">
				<div class="panel-heading">Sales in all Product Categories</div>
                <div class="panel-body">
				<?php
				$query = "SELECT TOTAL_SALES, CATEGORY FROM sales_in_all_product_categories";
				$result = $conn->query($query);
				$jsonArrayBar = array();
				if ($result->num_rows > 0) 
				{
						  //Converting the results into an associative array
						  while($row = $result->fetch_assoc()) {
							$jsonArrayItem = array();
							$jsonArrayItem['category'] = $row['CATEGORY'];
							$jsonArrayItem['sales'] = $row['TOTAL_SALES'];
							//append the above created object into the main array.
							array_push($jsonArrayBar, $jsonArrayItem);
						  }
				}
				?>
				<div id="morris-bar-chart"></div>
				<script type = "text/javascript">
					morrisBar(<?php echo json_encode($jsonArrayBar)?>);
				</script>
				</div>
                </div>
			    </div>   
				<div class="col-md-5">
				<div class="panel panel-primary">
				<div class="panel-heading">Sales with different Modes of Payment</div>
				<div class="panel-body">
                <?php
				$query = "SELECT TOTAL_SALES, MODE_OF_PAYMENT FROM sales_in_all_modeofpayment";
				$result = $conn->query($query);
				$jsonArrayDonut = array();
				if ($result->num_rows > 0)
				{
						  //Converting the results into an associative array
						  while($row = $result->fetch_assoc()) {
							$jsonArrayItem = array();
							$jsonArrayItem['label'] = $row['MODE_OF_PAYMENT'];
							$jsonArrayItem['value'] = $row['TOTAL_SALES'];
							//append the above created object into the main array.
							array_push($jsonArrayDonut, $jsonArrayItem);
						  }
				}
				?>
				<div id="morris-donut-chart"></div>
				<script type = "text/javascript">
					morrisDonut(<?php echo json_encode($jsonArrayDonut)?>);
				</script>
				</div>
				</div> 
				</div>	
		<div class="col-md-1">
		</div>
		</div>
			<br/> <br/>
                <!-- /.panel-heading -->
				<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
				<div class="panel panel-primary">
				<div class="panel-heading">Loss In sales with abandoned carts</div>
				<div class="panel-body">
				<?php
				$query = "SELECT TOTAL_LOSS, CATEGORY FROM loss_in_sales";
				$result = $conn->query($query);
				$jsonArrayBar2 = array();
				if ($result->num_rows > 0)
				{
						  //Converting the results into an associative array
						  while($row = $result->fetch_assoc()) {
							$jsonArrayItem = array();
							$jsonArrayItem['loss'] = $row['TOTAL_LOSS'];
							$jsonArrayItem['category'] = $row['CATEGORY'];
							//append the above created object into the main array.
							array_push($jsonArrayBar2, $jsonArrayItem);
						  }
				}
				?>
				<div id="morris-bar-chart2"></div>
				<script type = "text/javascript">
					morrisBar2(<?php echo json_encode($jsonArrayBar2)?>);
				</script>
				</div>
                </div>
			    </div> 
				<div class="col-md-5">
				<div class="panel panel-primary">
				<div class="panel-heading">Sales Trend of 3 most popular products</div>
				<div class="panel-body">
				<?php
				$query = "SELECT TOTAL_AMOUNT, PRODUCT,YEAR FROM sales_trend_in_years";
				$result = $conn->query($query);
				$jsonArrayArea = array();
				if ($result->num_rows > 0) 
				{
						  //Converting the results into an associative array
						  $count = 0;
						  while($row = $result->fetch_assoc()) {	
							$jsonArrayItem['year'] = $row['YEAR'];		
							if($row['PRODUCT']=='BakedGoods')
								$jsonArrayItem['BakedGoods'] = $row['TOTAL_AMOUNT'];
							else if($row['PRODUCT']=='Lenovo ThinkPad')
								$jsonArrayItem['Lenovo ThinkPad'] = $row['TOTAL_AMOUNT'];
							else if($row['PRODUCT']=='THE UNDERGROUND')
								$jsonArrayItem['THE UNDERGROUND'] = $row['TOTAL_AMOUNT'];
							$count = $count+1;
							if($count == 3)
							{	
							//append the above created object into the main array.
							array_push($jsonArrayArea, $jsonArrayItem);
							$count = 0;
							}
						  }
				}
				?>
				<div id="morris-area-chart"></div>
				<script type = "text/javascript">
					morrisArea(<?php echo json_encode($jsonArrayArea)?>);
				</script>
				</div>
				</div> 
				</div>				
				<div class="col-md-1">
				</div>
				</div>
	</div>
	<!-------------------tab 2 ends -------------------------------->
	<div class="tab-pane" id="SalesDrillDown">
			<br/> <br/>
                <!-- /.panel-heading -->
				<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-10">
				<div class="panel panel-primary">
                        <div class="panel-heading">
                            All Sales for all years
                        </div>
                        <div class="panel-body">
						<?php
				$query = "SELECT Sum(ST.TRANSACTIONAMOUNT) AS Total_Sales_Amount, Sum(ST.TRANSACTIONQUANTITY) AS Total_Items_Sold, OD.YEAR AS Financial_Year FROM SALESTRANACTION ST,ORDERDATE OD WHERE ST.ORDERDATEID = OD.ORDERDATEID GROUP BY OD.YEAR";
				$result = $conn->query($query);
				$jsonArrayTable = array();
				if($result) 
				{
						echo("<table width='100%' class='table table-striped table-bordered table-hover'>");
						echo ("<thead><tr><th>Total Sales Amount</th><th>Total Items Sold</th><th>Year</th></tr></thead><tbody>");
						while($row = $result->fetch_assoc())
						{
									echo("<tr>");
                                    echo "<td>".$row["Total_Sales_Amount"]."</td>";
									echo "<td>".$row["Total_Items_Sold"]."</td>";
									echo "<td><a href='#' onclick='drillOnYear(".$row["Financial_Year"].")'>".$row["Financial_Year"]."</a></td>";
									echo ("</tr>");
						}
                            echo ("</table>");
				}
				?>
				</div>
                </div>
			    </div> 				
				<div class="col-md-1">
				</div>
				</div>
				<div id = "onYear"></div>
				<div id = "onQuarter"></div>
				<div id = "onMonth"></div>
				<div id = "onWeek"></div>
				<script type="text/javascript">
				function drillOnYear(year)
				{
					console.log("inside func"+year);
					 $.ajax({
					type: "POST",
					url: "admin_helpers/drillOnYear.php",
					data: {year},
					success: function(result){
					console.log("back to main page"+result);
					displayYearTable(result);
					} 
					});
				};	
				function displayYearTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>Sales By Quarter-Drilled down On Year</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Total Sales Amount</th><th>Total Items Sold</th><th>Financial Quarter</th><th>Financial Year</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++)
						{
								tableElement+="<tr><td>";
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td><td><a href='#' onclick='drillOnQuarter(";
								tableElement+=object[i]['Financial_Quarter'];
								tableElement+=",";
								tableElement+=object[i]['Financial_Year'];
								tableElement+=")'>";
								tableElement+=object[i]['Financial_Quarter'];
								tableElement+="</a></td><td>";
								tableElement+=object[i]['Financial_Year'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onYear').innerHTML = tableElement;
					};
					
					function drillOnQuarter(quarter,year)
					{
					console.log("inside func quarter"+quarter+"year"+year);
					 $.ajax({
					type: "POST",
					url: "admin_helpers/drillOnQuarter.php",
					data: {quarter,year},
					success: function(result){
					console.log("back to main page"+result);
					displayQuarterTable(result);
						} 
						});
					};
					
					function displayQuarterTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>Sales By Month-Drilled down on Quarter</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Total Sales Amount</th><th>Total Items Sold</th><th>Financial Month</th><th>Financial Quarter</th><th>Financial Year</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++)
						{
								tableElement+="<tr><td>";
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td><td><a href='#' onclick='drillOnMonth(";
								tableElement+=object[i]['Financial_Month'];
								tableElement+=",";
								tableElement+=object[i]['Financial_Year'];
								tableElement+=",";
								tableElement+=object[i]['Financial_Quarter'];
								tableElement+=")'>";
								tableElement+=object[i]['Financial_Month'];
								tableElement+="</a></td><td>";
								tableElement+=object[i]['Financial_Quarter'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Financial_Year'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onQuarter').innerHTML = tableElement;
					};
	
					function drillOnMonth(month,year,quarter)
					{
					console.log("inside func month"+month+"year"+year+"quarter"+quarter);
					 $.ajax({
					type: "POST",
					url: "admin_helpers/drillOnMonth.php",
					data: {month,year,quarter},
					success: function(result){
					console.log("back to main page"+result);
					displayMonthTable(result);
						} 
						});
					};
					
					function displayMonthTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>Sales By Week-Drilled down on month</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Total Sales Amount</th><th>Total Items Sold</th><th>Week</th><th>Financial Month</th><th>Financial Quarter</th><th>Financial Year</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++)
						{
								tableElement+="<tr><td>";
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td><td><a href='#' onclick='drillOnWeek(";
								tableElement+=object[i]['Week'];
								tableElement+=",";
								tableElement+=object[i]['Financial_Month'];
								tableElement+=",";
								tableElement+=object[i]['Financial_Quarter'];
								tableElement+=",";
								tableElement+=object[i]['Financial_Year'];
								tableElement+=")'>";
								tableElement+=object[i]['Week'];
								tableElement+="</a></td><td>";
								tableElement+=object[i]['Financial_Month'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Financial_Quarter'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Financial_Year'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onMonth').innerHTML = tableElement;
					};
					
					function drillOnWeek(week,month,quarter,year)
					{
					console.log("inside func week"+week+"month"+month+"quarter"+quarter+"year"+year);
					 $.ajax({
					type: "POST",
					url: "admin_helpers/drillOnWeek.php",
					data: {week,month,quarter,year},
					success: function(result){
					console.log("back to main page"+result);
					displayWeekTable(result);
						} 
						});
					};
					
					function displayWeekTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>Sales By Date-drilled down on Week</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Total Sales Amount</th><th>Total Items Sold</th><th>Date</th><th>Week of the Month</th><th>Financial Month</th><th>Financial Quarter</th><th>Financial Year</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++)
						{
								tableElement+="<tr><td>";
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Date'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Week_Of_the_Month'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Financial_Month'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Financial_Quarter'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Financial_Year'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onWeek').innerHTML = tableElement;
					};
					
				</script>
	</div>
	<!----------------------------------------tab3 ends ----------------------------------->
	<div class="tab-pane" id="RollUpSales">
			<br/> <br/>
                <!-- /.panel-heading -->
				<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-10">
				<div class="panel panel-primary">
				<div class="panel-heading">All Orders placed within Country United States State California City Princeton Street Jackson Street Zip code 95970</div>
                <div class="panel-body">
				 <?php
                    $query = "SELECT O.ORDERADDRESSCOUNTRY AS 'Country',O.ORDERADDRESSPINCODE AS 'Postal_Zip_Code',O.ORDERADDRESSSTATE AS 'State',O.ORDERADDRESSCITY AS 'City',O.ORDERADDRESSSTREET AS 'Street_Address',Sum(ST.TRANSACTIONAMOUNT) AS 'Total_Sales_Amount',Sum(ST.TRANSACTIONQUANTITY) AS 'Total_Items_Sold' FROM SALESTRANACTION ST,ORDERDATE OD, ORDERS O WHERE ST.ORDERDATEID = OD.ORDERDATEID AND ST.ORDERID = O.ORDERID AND O.ORDERADDRESSSTREET = 'Jackson Street' AND O.ORDERADDRESSCITY = 'PRINCETON' AND O.ORDERADDRESSSTATE = 'California' AND O.ORDERADDRESSPINCODE = 95970 AND O.ORDERADDRESSCOUNTRY = 'United States'  GROUP BY O.ORDERADDRESSCOUNTRY, O.ORDERADDRESSPINCODE, O.ORDERADDRESSSTATE, O.ORDERADDRESSCITY, O.ORDERADDRESSSTREET";
				$result = $conn->query($query);
				$jsonArrayTable = array();
				if($result) 
				{
						echo("<table width='100%' class='table table-striped table-bordered table-hover'>");
						echo ("<thead><tr><th>Country</th><th>Postal Zip Code</th><th>State</th><th>City</th><th>Street Address</th><th>Total Sales Amount</th><th>Total Items Sold</th></tr></thead><tbody>");
						while($row = $result->fetch_assoc())
						{
									echo("<tr>");
                                    echo "<td>".$row["Country"]."</td>";
									echo "<td>".$row["Postal_Zip_Code"]."</td>";
									echo "<td>".$row["State"]."</td>";
									echo "<td>".$row["City"]."</td>";
									echo "<td><a href='#' onClick='rollOnCity(\"".$row['City']."\",\"".$row['State']."\",\"".$row['Country']."\")'>".$row["Street_Address"]."</a></td>";
									echo "<td>".$row["Total_Sales_Amount"]."</td>";
									echo "<td>".$row["Total_Items_Sold"]."</td>";
									echo ("</tr>");
						}
                            echo ("</table>");
				}
				?>
				</div>
                </div>
			    </div>   	
		<div class="col-md-1">
		</div>
		</div>
				<div id = "onCity"></div>
				<div id = "onState"></div>
				<div id = "onCountry"></div>
				<div id = "onWorld"></div>
				<script type="text/javascript">
				function rollOnCity(city,state,country)
				{
					console.log("inside func"+city+"state"+state+"country"+country);
					 $.ajax({
					type: "POST",
					url: "admin_helpers/rollOnCity.php",
					data: {city,state,country},
					success: function(result){
					console.log("back to main page"+result);
					displayCityTable(result);
					} 
					});
				};	
				
				function displayCityTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>All orders placed within a city-Rolled up on Street</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Country</th><th>State</th><th>City</th><th>Street Address</th><th>Total Sales Amount</th><th>Total Items Sold</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++)
						{
								tableElement+="<tr><td>";
								tableElement+=object[i]['Country'];
								tableElement+="</td><td>";
								tableElement+=object[i]['State'];
								tableElement+="</td><td><a href='#' onclick='rollOnState(\"";
								tableElement+=object[i]['State'];
								tableElement+="\",\"";
								tableElement+=object[i]['Country'];
								tableElement+="\")'>";
								tableElement+=object[i]['City'];
								tableElement+="</a></td><td>";
								tableElement+=object[i]['Street_Address'];
								tableElement+="</a></td><td>";
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onCity').innerHTML = tableElement;
					};
				
					function rollOnState(state,country)
					{
						console.log("inside func state"+state+"country"+country);
						 $.ajax({
						type: "POST",
						url: "admin_helpers/rollOnState.php",
						data: {state,country},
						success: function(result){
						console.log("back to main page"+result);
						displayStateTable(result);
						} 
						});
					};
					function displayStateTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>All orders placed within a state - Rolled up on City</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Country</th><th>State</th><th>City</th><th>Total Sales Amount</th><th>Total Items Sold</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++)
						{
								tableElement+="<tr><td>";
								tableElement+=object[i]['Country'];
								tableElement+="</td><td><a href='#' onclick='rollOnCountry(\"";
								tableElement+=object[i]['Country'];
								tableElement+="\")'>";
								tableElement+=object[i]['State'];
								tableElement+="</a></td><td>";
								tableElement+=object[i]['City'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onState').innerHTML = tableElement;
					};
					
					function rollOnCountry(country)
					{
						console.log("inside func country"+country);
						 $.ajax({
						type: "POST",
						url: "admin_helpers/rollOnCountry.php",
						data: {country},
						success: function(result){
						console.log("back to main page"+result);
						displayCountryTable(result);
						} 
						});
					};

					function displayCountryTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>All orders placed within a Country-Rolled up on State</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Country</th><th>State</th><th>Total Sales Amount</th><th>Total Items Sold</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++) 
						{
								tableElement+="<tr><td><a href='#' onclick='rollOnWorld()'>";
								tableElement+=object[i]['Country'];
								tableElement+="</a></td><td>"
								tableElement+=object[i]['State'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onCountry').innerHTML = tableElement;
					};
					
					function rollOnWorld()
					{
						console.log("inside func world");
						 $.ajax({
						type: "POST",
						url: "admin_helpers/rollOnWorld.php",
						data: {},
						success: function(result){
						console.log("back to main page"+result);
						displayWorldTable(result);
						} 
						});
					};
					
					function displayWorldTable(result)
					{
						var object = JSON.parse(result);
						var tableElement = "<div class='row'><div class='col-md-1'></div><div class='col-md-10'><div class='panel panel-primary'><div class='panel-heading'>All Orders placed world wide-Rolled up on Country</div><div class='panel-body'><table width='100%' class='table table-striped table-bordered table-hover'><thead><tr><th>Country</th><th>Total Sales Amount</th><th>Total Items Sold</th></tr></thead><tbody>";
						for(var i=0;i<object.length;i++) 
						{
								tableElement+="<tr><td>";
								tableElement+=object[i]['Country'];
								tableElement+="</td><td>"
								tableElement+=object[i]['Total_Sales_Amount'];
								tableElement+="</td><td>";
								tableElement+=object[i]['Total_Items_Sold'];
								tableElement+="</td></tr>";
									
						}
						tableElement+="</table></div></div></div><div class='col-md-1'></div></div>";
						console.log(tableElement);
						document.getElementById('onWorld').innerHTML = tableElement;
					};
				
				</script>	
	</div>
	<!--------------------------------------------tab4 ends------------------------------------------------->
	</div>
	</div>
	</div>
	</div>
</body>
</html>
