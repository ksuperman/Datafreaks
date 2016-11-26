<?php
$servername = "localhost";
$username = "datafreaks";
$password = "sesame";
$dbname = "DATAFREAKS";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $username = filter_input(INPUT_POST,"username");
      $password = filter_input(INPUT_POST,"password");

   // prepare sql and bind parameters for table account
//    $query_account = $conn->prepare("SELECT ID FROM ACCOUNT WHERE PASSWORD = :password AND USERID = (SELECT USERID FROM USER WHERE USERNAME = :username)");
//   $params_account = array(
//       "password" => $hashedPassword,
//       "username" => $username
//   );
    $query_account = $conn->prepare("SELECT * FROM ACCOUNT WHERE USERID = (SELECT ID FROM USER WHERE USERNAME = :username)");
    $params_account = array(
       "username" => $username
    );

    $query_account->execute($params_account);
    $row = $query_account->fetch(PDO::FETCH_ASSOC);
    $hash_pwd = $row['PASSWORD'];
    echo "PASSWORD in DB is".$hash_pwd;
    $hash = password_verify($password,$hash_pwd);
    echo "Hash is ".$hash;
//   $count = $query_account->rowCount();
//      if($count == 1) {
    if ($hash == 0)
    {
        header("location: login.php?error=Your Login Name or Password is invalid");
      }else {
        header("location: welcome.php?username=".urlencode($_POST['username']));
      }
   }
   $conn = null;
?>


