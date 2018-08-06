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
	<title>Manage Users</title>

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
		<div class="col-md-6 col-md-offset-3">
			<div class="btn-toolbar">
				<b><h1 class="text-center">Manage Polls</h1></b>
				<br>
				<!-- testing===================================================================-->




				<?php echo 
				"You are logged in as ".$_SESSION['username'].", you can delete a poll from here. <br/><br/>";
				?>

				<table class="table table-bordered">
				<thead>
				<tr>
					<th>ID:</th>
					<th>Username:</th>
					<th>Delete:</th>
				</tr>
				</thead>

				<?php 

				require 'databaseVariables.php';

    // Database Connection
				$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));
    //select query.
				$query = "SELECT pollid, question FROM zPoll";
				$result = $link->query($query);
				if(!$result)
					die('Invalid query: ' . mysqli_error($link));

				while ($row = mysqli_fetch_array($result)) { ?>

				<tr>
					<td><?php echo $row['pollid']; ?></td>
					<td><?php echo $row['question']; ?></td>
					
					<td>
						<a class="btn btn-danger" href="deletepoll.php?del=<?php echo $row['pollid']; ?>">Delete</a>
					</td>

				</tr>



				<?php  }?>
</table>

<!-- 				while($row = $result->fetch_assoc()) {

					echo "hi user id is ".$row["userid"]."username is".$row["username"]." email is".$row["email"]."<br>"; -->







				

				

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
