<?php
// include 'storedInfo.php';
// Group 15
// Oregon State University
// CS 361
// Project B
// Fall 2016

//  Need to update the db info here too
$connectDB = new mysqli("oniddb.cws.oregonstate.edu", "bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db") or die("Failed to connect to MySQL");

$un = $_POST['username'];
$pw = $_POST['password'];
$ed = $_POST['educator'];
$fn = $_POST['firstName'];
$ln = $_POST['lastName'];

if(!$stmt = $connectDB->prepare("INSERT INTO Account(UserName, Password, Educator, FirstName, LastName) VALUES (?, ?, ?, ?, ?)")) {
  echo "Prepare failed.";
}
if(!$stmt->bind_param("ssiss", $un, $pw, $ed, $fn, $ln)) {
  echo "Bind Param failed.";
}
if(!$stmt->execute()) {
  echo "Execute failed.";
}

// mysqli_close($connectDB);
$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
$filePath = implode('/', $filePath);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
header("Location: {$redirect}/communities.php", true);
die();

?>
