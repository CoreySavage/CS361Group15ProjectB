<?php
ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");


    
if($mysqli->connect_error){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt = $mysqli->prepare("INSERT INTO Community(Name, State, Country, SkillNeeded, UserComments) VALUES (?,?,?,?,?)"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
//print_r($_POST); 

if(!($stmt->bind_param("sssss",$_POST['Name'],$_POST['State'],$_POST['Country'],$_POST['Skill'],$_POST['Comment']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
   echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}

$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
$filePath = implode('/', $filePath);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
header("Location: {$redirect}/communities.php", true);
die();
    
?>
