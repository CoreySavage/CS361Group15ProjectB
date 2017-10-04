<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");
// Displays errors
if($mysqli->connect_errno) {
  echo "Connection Error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/* Stores Community ID number*/
$idNum = isset($_GET['id']) ? $_GET['id'] : '';
?>
<!DOCTYPE html>
<html>
<!-- Copied from newaccount.php to keep consistent style *** Michael W. check to see if information is correct *** -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="I'll Go">
    <meta name="author" content="Group 15">
    <link rel="icon" href="../../favicon.ico">
    <!-- Could add php here to make the title the community name if we desire -->
    <title>I'll Go</title>
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
          <!--Do we have a JPG logo?-->
          <!--href="index.php"-->
          <a class="navbar-brand">I'll Go</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div>
            <ul class="nav navbar-nav">
<!--               <li>I'll Go</li> -->
              <li><a href="communities.php">Communities</a></li>
              <!--
              <li><a href="something.php">Something</a></li>
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
    <!--  END NAV START BODY -->
    <br><br>
    <div class="container">
        <div class="row">
          <div class="col-md-6">
<?php
/* Retrieves Community location for Header*/
if(!($statement = $mysqli->prepare("SELECT `Name`, `State`, `Country` FROM `Community` WHERE `CommunityID`= $idNum "))) {
  echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->execute())) {
  echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->bind_result($name, $state, $country))) {
    echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
/* Spacing will likely be off without some styling */
while ($statement->fetch()) {
  echo "<h2>" . $name . "</h2>\n<div class='charInfo'><span>" . $state . "</span><p>" . $country . "</p></div>";
}
$statement->close();
?>
        </div>

<!-- Maybe put donate button up here and we can style it to be next to the name, state, country -->
    <div class="col-md-6">
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
   </div>
  </div>
<!--            Donate button above                -->
  <hr>
    <div class="container">
        <h4>Needs</h4>
            <table border="1">
                <thead>
                <tr>
                    <th>Need</th>
                    <th>Comments</th>
                </tr>
                </thead>
<?php
/* Retrieves Community needs to display*/
if(!($statement = $mysqli->prepare("SELECT `SkillNeeded`,`UserComments` FROM `Community` WHERE `CommunityID`= $idNum "))) {
  echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->execute())) {
  echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->bind_result($skill, $comment))) {
    echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($statement->fetch()) {
    echo "\n<tr>\n<td>" . $skill . "</td>\n<td>" . $comment . "</td>\n</tr>";
}
$statement->close();
?>
            </table>
    </div>
    <hr>
    <div class="container">
    <h4>Existing Volunteers</h4>
   <div class="existing_Volunteers">
      <table border="1">
        <thead>
          <tr>
            <th>Name</th>
            <th>Skill</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
        </thead>
<?php
/* Retrieves existing Volunteers to display*/
if(!($statement = $mysqli->prepare("SELECT `Account`.`FirstName`, `Account`.`LastName`, `Account_Community`.`Skill`, `StartDate`, `EndDate` FROM `Account` INNER JOIN `Account_Community` ON `Account`.`AccountID` = `Account_Community`.`AccountID` INNER JOIN `Community` ON `Account_Community`.`CommunityID` = `Community`.`CommunityID` WHERE `Account_Community`.`CommunityID`= $idNum"))) {
  echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->execute())) {
  echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($statement->bind_result($firstName, $lastName, $skill, $startDate, $endDate))) {
    echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($statement->fetch()) {
    echo "\n<tr>\n<td>" . $firstName . " " . $lastName . "</td>\n<td>" . $skill . "</td>\n<td>" . $startDate . "</td>\n<td>" . $endDate . "</td>\n</tr>";
}
 $statement->close();
?>
      </table>
    </div>
    <hr>
<!--         Sign up to volunteer time and training to a community            -->

    <div class="container">
      <div class="row">
        <div class="col-md-6">
    <form action="addVolunteer.php" method="post">
      <fieldset>
        <legend>Volunteer to Community</legend>
          <div class='form-group'>
          Account Name: <input type="text" name="AccountName" id="AccountName">
        </div>
        <div class='form-group'>
          Password: <input type="password" name="psw" id="psw">
        </div>
        <div class='form-group'>
          Skill:
        <select name="CommunitySkill" id ="CommunitySkill">
          <?php
          /* Populates Skill drop down*/
          if(!($statement = $mysqli->prepare("SELECT `SkillNeeded` FROM `Community` WHERE `CommunityID`= $idNum "))) {
            echo "Prepare failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!($statement->execute())) {
            echo "Execute failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!($statement->bind_result($skill))) {
            echo "Bind failed " . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while ($statement->fetch()) {
            echo '<option value="' . $skill . '">' . $skill . '</option>';
          }
          $statement->close();
           ?>
        </select>
        </div>
        <div class='form-group'>
         Start Date:
        <input type="date" name="startDate" id="startDate">
        </div>
        <div class='form-group'>
         End Date:
        <input type="date" name="endDate" id="endDate">
        </div>
        <p>
          <input type="hidden" name="CommunityID" id ="CommunityID" value="<?php echo $idNum; ?>">
          <input type="submit" name="submitVolunteer">
        </p>
      </fieldset>
    </form>
      </div>
    </div>
   </div>
    

<!--               Volunteer to community above               -->

        <footer class="footer">
        <div class="container">
          <div class="col-xs-6">
            <p class="text-muted">&copy; I'll Go, Inc.</p>
          </div>
        </div>
      </footer>
  </body>
</html>
