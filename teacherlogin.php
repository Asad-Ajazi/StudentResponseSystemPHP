<?php
session_start();
error_reporting(E_ERROR);

if(!empty($_POST['email']) && !empty($_POST['pass'])) {
	require 'databaseVariables.php';

    // Database Connection
	$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));

		//put post into variables
	$email = $_POST['email'];
	$pass = $_POST['pass'];
  //make pass md5
  $pass=md5($pass);

  //check if email+pass combo exists in database.
	$query = "SELECT teacherid, username, email, role FROM zTeacher WHERE email = '$email' AND password = '$pass'";

	$result = $link->query($query);
	if(!$result)
           die('Invalid query: ' . mysqli_error($link)); 

	if ($result->num_rows == 1) {
           // output data of one row
          $row = $result->fetch_assoc();
          // echo 'Welcome ' . $row["firstName"]. ' '. $row["lastName"];
		   //$_SESSION['user_logged_in'] = $row["firstName"]. ' '. $row["lastName"];     
		   $_SESSION["teacherid"] = $row["teacherid"];
       $_SESSION["username"] = $row["username"];
       $_SESSION["email"] = $row["email"];
       $_SESSION["role"] = $row["role"];

      $link->close();
		//header('Location: TwitterAuth.php');
      if($row["role"] == 'student'){
        header('location: studenthome.php');
      }elseif ($row["role"] == 'teacher') {
        header('location: teacherhome.php');
      }

}
	else {
	   $errmatch = "The email and password you entered do not match, please try again.";
     
	}

 		
	// Closing database connection
	$link->close();
}  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Teacher Login Page</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--my own style sheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>



    <!-- START NAVBAR==================================================================-->
    <nav class="navbar navbar-inverse navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                    aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                <!--change the # to home page-->
                <a class="navbar-brand" href="#">Gre-Learning
              <!--<img style="height:35px" src="Images/homelogo.png" /> add logo here-->
</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling, put links in hashes# -->
<div class="collapse navbar-collapse" id="navbar">
    <ul class="nav navbar-nav">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Home<span class="sr-only">(current)</span></a></li>

        <li><a href="about.php"><span class="glyphicon glyphicon-question-sign"></span> About</a></li>
        <li><a href="contact.php"><span class="glyphicon glyphicon glyphicon-envelope"></span> Contact</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
<!-- end navbar====================================================================-->


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="form-register">
                <b><h1 class="text-center">Teacher Login</h1></b>
                <br>
                

                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="submit" id="submit">

                <!-- testing===================================================================-->
                
                    <div class="form-group">
                    <i class="glyphicon glyphicon-envelope"></i>
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    </div>




                    <div class="form-group">
                        <i class="glyphicon glyphicon-lock"></i>
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                    </div>
                        <?php echo $errmatch ?>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>

                   
                    
                </form>

                <br/>
                If you are not registed 
                <a href="register.php">please click here to register.</a>

                <!-- END OF testing===============================================================-->


            </div>
        </div>
    </div>
</div>


<!--START OF THE FOOTER -->
<footer class="footer">
    <div class="container">
        <p class="text-muted">Footer: Gre-Learning. Created by Asad Ajazi</p>
    </div>
</footer>
<!--END OF THE FOOTER -->




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
