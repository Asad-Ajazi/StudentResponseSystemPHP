<?php
session_start();
error_reporting(E_ERROR);

if (!isset($_SESSION['email'])) {
	session_destroy();
  header("Location: login.php"); // redirect to login page
}

?>








<?php 
require 'databaseVariables.php';

    // Database Connection
$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));

if(isset($_POST['submit'])){

$qry = "INSERT INTO zPrivateMessage (privatemessageid,privatemessage,userid,teacherid) VALUES (null,'".$_POST['comment']."','".$_SESSION['userid']."','".$_POST['teacherlist']."')";
$rs = $link->query($qry);
}else{
	echo "something went wrong";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Send Message</title>

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
			<a class="navbar-brand" href="studenthome.php">Gre-Learning
				<!--<img style="height:35px" src="Images/homelogo.png" /> add logo here-->
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling, put links in hashes# -->
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="studenthome.php"><span class="glyphicon glyphicon-home"></span> Home<span class="sr-only">(current)</span></a></li>

				<li><a href="Vote.php"><span class="glyphicon glyphicon-pencil"></span> Vote</a></li>				
				<li><a href="#"><span class="glyphicon glyphicon-stats"></span> View Results</a></li>
				
			</ul>

			<ul class="nav navbar-nav navbar-right">
				
				<li><a href="SendMessage.php"><span class="glyphicon glyphicon-comment"></span> Send Message</a></li>
				<li><a href="Forum.php"><span class="glyphicon glyphicon-list"></span> Forums</a></li>
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
				<b><h1 class="text-center">Message Teacher.</h1></b>
				<br>
				<!-- testing===================================================================-->
				<?php echo 
				"You are logged in as ".$_SESSION['username'].", you can send an anonymous message to your teacher from here. <br/><br/>";


				?>
				<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="submit" id="submit">

					<h3><label>Please select your teacher from the list below: </label></h3>

					<select id="teacherlist" name="teacherlist" onChange="getOption(this.value)">
						<option value="">Select teacher</option>
						<?php 
						$query = "SELECT * FROM zTeacher";
						$result = $link->query($query);

						while($row = $result->fetch_assoc()) {
						?>
							<option value="<?php echo $row["teacherid"]; ?>"><?php echo $row["username"];  ?> </option>

							<?php 
						}

						?>
					</select>
					<br><br>
					Enter message below. This message will be anonymous: <textarea name="comment" rows="5" cols="40"></textarea><?php echo $errmsg ?>
					<br><br>
					<button type="submit" name="submit" class="btn btn-info" value="submit">Submit Question.</button>



				</form>

				<br>

				






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
