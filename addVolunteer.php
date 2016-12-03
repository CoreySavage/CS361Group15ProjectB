<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");

if($mysqli->connect_error){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$cid = $_POST['CommunityID'];
$user = isset($_POST['AccountName']) ? $_POST['AccountName'] : '';
$pass = isset($_POST['psw']) ? $_POST['psw'] : '';

if(!($stmt = $mysqli->prepare("INSERT INTO `Account_Community`(`AccountID`, `CommunityID`, `Skill`, `StartDate`, `EndDate`) VALUES ((SELECT `AccountID` FROM `Account` WHERE `UserName` = $user AND `Password` = $pass),?,?,?,?)"))){
    	echo "cid: " . $cid . "user: " . $user . "pass: " . $pass . "skill: " . $_POST['CommunitySkill'] . "start: " .  $_POST['startDate'] . "end: " . $_POST['endDate'];
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("isss", $cid, $_POST['CommunitySkill'], $_POST['startDate'], $_POST['endDate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
   echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
else {
	echo "Added volunteer to community.";    
}

$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
$filePath = implode('/', $filePath);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
header("Location: {$redirect}/community.php?id=" . $cid, true);
die();
    
?>
