<?php
session_start();
error_reporting(E_ERROR);

if (!isset($_SESSION['email'])) {
	session_destroy();
  header("Location: login.php"); // redirect to login page
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Teacher Home</title>

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
			<a class="navbar-brand" href="teacherhome.php">Gre-Learning
				<!--<img style="height:35px" src="Images/homelogo.png" /> add logo here-->
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling, put links in hashes# -->
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="teacherhome.php"><span class="glyphicon glyphicon-home"></span> Home<span class="sr-only">(current)</span></a></li>

				<li><a href="CreatePoll.php"><span class="glyphicon glyphicon-pencil"></span> Create Poll</a></li>
				<li><a href="ManagePoll.php"><span class="glyphicon glyphicon-list"></span> Manage Polls</a></li>
				<li><a href="ManageUser.php"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>

			</ul>

			<ul class="nav navbar-nav navbar-right">


				<li><a href="Results.php"><span class="glyphicon glyphicon-stats"></span> View Results</a></li>
				<li><a href="ViewMessages.php"><span class="glyphicon glyphicon-comment"></span> View Messages</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>

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
			<div class="btn-toolbar">
				<b><h1 class="text-center">Teacher Homepage</h1></b>
				<br>
					<!-- testing===================================================================-->
					<?php echo 
						"You are logged in as ".$_SESSION['username'].", select an option below to begin. <br/><br/>";
					 ?>
					<a href="CreatePoll.php" class="btn btn-lg btn-primary btn-block" role="button">Create Poll <span class="glyphicon glyphicon-pencil"></span></a>
					<a href="ManagePoll.php" class="btn btn-lg btn-primary btn-block" role="button">Manage Polls <span class="glyphicon glyphicon-list"></span></a>
					<a href="Results.php" class="btn btn-lg btn-primary btn-block" role="button">View Results <span class="glyphicon glyphicon-stats"></span></a>

					<a href="ManageUser.php" class="btn btn-lg btn-info btn-block" role="button">Manage Users <span class="glyphicon glyphicon-user"></span></a>
					<a href="ViewMessages.php" class="btn btn-lg btn-info btn-block" role="button">View Messages <span class="glyphicon glyphicon-comment"></span></a>
					<a href="logout.php" class="btn btn-lg btn-danger btn-block" role="button">Logout <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a> 

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
