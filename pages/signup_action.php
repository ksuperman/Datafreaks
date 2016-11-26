<?php

$servername = "localhost";
$username = "datafreaks";
$password = "sesame";
$dbname = "DATAFREAKS";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//fetching all the variables
$firstname = filter_input(INPUT_POST, "firstname");
$middlename = filter_input(INPUT_POST, "middlename");
$lastname = filter_input(INPUT_POST,"lastname");
$username = filter_input(INPUT_POST,"username");
$dob = filter_input(INPUT_POST,"dob");
$unitno = filter_input(INPUT_POST,"unitno");
$streetname = filter_input(INPUT_POST,"streetname");
$city = filter_input(INPUT_POST,"city");
$state =filter_input(INPUT_POST,"state");
$country = filter_input(INPUT_POST,"country");
$zipcode = filter_input(INPUT_POST,"zipcode");
$email = filter_input(INPUT_POST,"email");
$password = filter_input(INPUT_POST,"password");
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


// prepare sql and bind parameters for table user
$query_user = $conn->prepare("INSERT INTO USER (FIRSTNAME, MIDDLENAME, LASTNAME, USERNAME, DOB)
    VALUES (:firstname, :middlename, :lastname, :username, :dob)");
$params_user = array(
    "firstname" => $firstname,
    "middlename" => $middlename,
    "lastname" => $lastname,
    "username" => $username,
    "dob" => $dob
);
$data = $query_user->execute($params_user);
$insert_userid = $conn->lastInsertId();

// prepare sql and bind parameters for table address
$query_address = $conn->prepare("INSERT INTO ADDRESS (UNITNUMBER, STREETNAME, CITY, STATE, COUNTRY, ZIPCODE)
    VALUES (:unitno, :streetname, :city, :state, :country, :zipcode)");
$params_address = array(
    "unitno" => $unitno,
    "streetname" => $streetname,
    "city" => $city,
    "state" => $state,
    "country" => $country,
    "zipcode" => $zipcode
);
$data = $query_address->execute($params_address);
$insert_addressid = $conn->lastInsertId();


// prepare sql and bind parameters for table account
$query_account = $conn->prepare("INSERT INTO ACCOUNT (EMAIL, USERID, PASSWORD, ADDRESSID, REWARDS)
    VALUES (:email, :userid, :password, :addressid, 25)");
$params_account = array(
    "email" => $email,
    "userid" => $insert_userid,
    "password" => $hashedPassword,
    "addressid" => $insert_addressid
);
$data = $query_account->execute($params_account);
$insert_accountid = $conn->lastInsertId();

// prepare sql and bind parameters for table address_account
$query_add_acc = $conn->prepare("INSERT INTO ADDRESS_ACCOUNT (ACCOUNTID, ADDRESSID)
    VALUES (:accountid, :addressid)");
$params_add_acc = array(
    "accountid" => $insert_accountid,
    "addressid" => $insert_addressid
);
$data = $query_add_acc->execute($params_add_acc);
$insert_add_acc = $conn->lastInsertId();

if ($insert_add_acc != null) {
    header("location: index.php?error=".urlencode("Account created successfully"));
} else {
    header("location: index.php?error=".urlencode($conn->error));
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>