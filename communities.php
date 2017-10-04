<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");
// Displays errors
if($mysqli->connect_errno) {
  echo "Connection Error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="I'll Go">
    <meta name="author" content="Group 15">
    <link rel="icon" href="../../favicon.ico">
    <title>Opportunities</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--Do we have a JPG logo? href="index.php"-->
          <a class="navbar-brand">I'll Go</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div>
            <ul class="nav navbar-nav">
<!--               <li>I'll Go</li> -->
              <li class="active"><a href="communities.php">Communities</a></li>
              <!--<li><a href="something.php">Something</a></li>
              <li><a href="somethingelse.php">Something Else </a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
            	<!--This is where we can to update Login/Logout features, profile page link, etc.-->
              <?php
            //   if(isset($_SESSION['sessionActive'])) {
            //     echo "<li><a href='profile.php'><font color='#FDB829'>$_SESSION[firstname] $_SESSION[lastname]</font></a></li>";
            //     echo "<li><a href='logoutAction.php?action=end'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
            //   }
            //   else {
            //     echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
            //     echo "<li class='active'><a href='newaccount.php'><span class='glyphicon glyphicon-user'></span> Create Account</a></li>";
            //   }
              ?>
              <li class='active'><a href='newaccount.php'><span class='glyphicon glyphicon-user'></span> Create Account</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
      <div class="container">
        <div class="row">
          <div class="header">
      <h1>Opportunities</h1>
    </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Skill Needed</th>
            <th>Comments</th>
          </tr>
        </thead>
<?php
if(!($statement = $mysqli->prepare("SELECT `CommunityID`, `Name`, `State`, `Country`, `SkillNeeded`,`UserComments` FROM `Community` "))) {
  echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->execute())) {
  echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->bind_result($communityID, $name, $state, $country, $skill, $comment))) {
    echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($statement->fetch()) {
  echo "\n<tr>\n<td><a href='community.php?id=" . $communityID . "'>" . $name . "</td>\n<td>" . $state . "</td>\n<td>" . $country . "</td>\n<td>" . $skill . "</td>\n<td>" . $comment . "</td>\n</tr>";
}
$statement->close();
 ?>
      </table>
        </div>
      </div>
<div class="container">
  <div class="row">
  <form method="post" action="AddOpportunity.php">
  
    <fieldset>
       <legend>Add Opportunity</legend>
        <p>City: <input type="text" name="Name"/></p>
        <p>State: <input type="text" name="State"/></p>
        <p>Country: <input type="text" name="Country"/></p>
        <p>Skill Needed: <input type="text" name="Skill"/></p>
        <p>Comments: <input type="text" name="Comment"/></p>  
        <p><input type="submit"/></p>
    </fieldset>  
  </form>
</div>  
  </div>




     <script src="js/bootstrap.min.js"></script>
  </body>
</html>
