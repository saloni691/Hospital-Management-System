<?php
$Name = $_POST['Name'];
$Username = $_POST['Username'];
$Emailid = $_POST['Emailid'];
$Password = $_POST['Password'];
$ConfirmPassword = $_POST['ConfirmPassword'];
$ques = $_POST['ques'];
$Answer = $_POST['Answer'];

if (!empty($Name) || !empty($Username) || !empty($Emailid) || !empty($Password) || !empty($ConfirmPassword) || !empty($ques) || !empty($Answer)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "sathyabama";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT Emailid From babu Where Emailid = ? Limit 1";
     $INSERT = "INSERT Into babu (Name, Username, Emailid, Password, ConfirmPassword, ques, Answer) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Emailid);
     $stmt->execute();
     $stmt->bind_result($Emailid);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssss", $Name, $Username, $Emailid, $Password, $ConfirmPassword, $ques, $Answer);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>