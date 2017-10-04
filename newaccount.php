<?php
ini_set('display_errors', 'On');
session_start();
// **** Dont think we need this, unless it is for sessions, or something - Corey - include 'storedInfo.php';

// **** Let's come back and update the DB info here when we have it.
// ****  There are 2 possible calls, depending on the db

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "bonneym-db", "R2lzWpqYli7k9Qk8", "bonneym-db");
// $mysqli = new mysqli("oniddb.cws.oregonstate.edu","??-db",$myPassword,"??-db");
// if($mysqli->connect_errno){
// 	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
// }
?>
<!DOCTYPE html>
<!--
Group 15
Oregon State University
CS 361
Project B
Fall 2016
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="I'll Go">
    <meta name="author" content="Group 15">
    <link rel="icon" href="../../favicon.ico">
    <title>I'll Go - Create Account</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
  </head>

  <body>
    <!--NAV BAR CODE-->
    <!--This will need some updates later in the project, for now we can ignore it-->
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
<!--           <a class="navbar-brand" href="index.php"><img src="images/logo.gif" width="75px" height="30px"></a> -->
		<a class="navbar-brand">I'll Go</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div>
            <ul class="nav navbar-nav">
<!--               <li><a href="index.php">I'll Go</a></li> -->
              <li><a href="communities.php">Communities</a></li>
<!--               <li><a href="something.php">Something</a></li>
              <li><a href="somethingelse.php">Something Else </a></li> -->
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
            </ul>
          </div>
        </div>
      </div>
    </nav>
	
	<!--****  THIS IS WHERE WE CORRECT THE FORM ****-->
    <div class="container">
      <form method="post" action="createAccount.php" class="form-signin" id="createAcc">
<!-- 	      action="createAccount.php" -->
        <span id="create_results"></span>
        <h2 class="form-signin-heading">Create New Account</h2>

        <div class="form-group">
          <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required autofocus>
            <span id="firstname_result"></span>
          </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required autofocus>
            <span id="lastname_result"></span>
          </div>

        <div class="form-group">
          <label for="username">User Name:</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="username" required autofocus>
            <span id="username_result"></span>
          </div>
          <div class="form-group">
            <label for="password">Password:  (Must be 6-18 characters)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="password" required>
          </div>
          <div class="form-group">
            <label for="educator">Are you an Educator?:</label>
            <input type="checkbox" name="educator" id="educator" value="1">
          </div>


          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="login" id="submit">Create</button>
        </form>
        <hr>
      </div> <!-- /container -->

      <footer class="footer">
        <div class="container">
          <div class="col-xs-6">
            <p class="text-muted">&copy; I'll Go, Inc.</p>
          </div>
        </div>
      </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- UNIQUE JAVASCRIPT
    =================================================== -->

    <script type="text/javascript">

    /* This Function queries the Account table to verify that the username is available */
    /* It is triggered while the user types in a username, it checks after each character is input */
    $("#username").keyup(function(event) {
       var username = $(this).val();
       $.post('check_username.php', {'username':username, 'type':'create'}, function(data) {
       $("#username_result").html(data); // check_username.php result
       });
    });

    /*  This function submits the account creation via an AJAX request  */
//     $(document).ready(function(){
//       $("#submit").click(function(){
//         var username = $("#inputUsername").val();
//         var password = $("#inputPassword").val();
//         if (document.getElementById("#educator").checked == true) {
//             var educator = $("#educator").val();
//         }
//         else {
//             var educator = 0;
//         }
//         var firstName = $("#inputFirstname").val();
//         var lastName = $("#inputLastname").val();
// //         if (educator < 0 || educator > 1){
            
// //         } //error

//         var postString = 'username='+ username + '&password='+ password + '&educator=' + educator + '&firstName=' + firstName + '&lastName=' + lastName;
//         if(username == '' || password == '' || firstName == '' || lastName == '') {
//           alert("All Fields are Required");
//         }
//         else {
//           $.ajax({
//             type: "POST",
//             url: "createAccount.php",
//             data: postString,
//             cache: false,
//             success: function(result){
//               alert(result);
//               $('#createAcc')[0].reset();
//             }
//           });
//         }
//         return false;
//       });
//     });
    /*
    function toggleDisabled(_checked) {
      document.getElementById('inputFirstname').disabled = _checked ? true : false;
      document.getElementById('inputLastname').disabled = _checked ? true : false;
    }
    */

    </script>

  </body>
</html>
