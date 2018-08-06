<?php
session_start();
error_reporting(E_ERROR);

if (!isset($_SESSION['email'])) {
	session_destroy();
  header("Location: login.php"); // redirect to login page
}
?>

<?php 

if(!isset($_POST['submit']) && !empty($_POST['question'])){
//does this if the button is pressed.
//basic server side validation if client side turns off javascript.
/*    if(!isset($_POST['question'])){
        $errquestion = "A question is required ";
    }
    if(!isset($_POST['option1'])){
        $err1 = "Enter option 1. ";
    }
    if(!isset($_POST['option2'])){
        $err2 = "Enter option 2. ";
    }
    if(!isset($_POST['option3'])){
        $err3 = "Enter option 3. ";
    }
    if(!isset($_POST['option4'])){
        $err4 = "Enter option 4 ";
    }*/

  $question = $_POST['question'];
    
  $option1 = $_POST['option1'];
  $option2 = $_POST['option2'];
  $option3 = $_POST['option3'];
  $option4 = $_POST['option4'];

    require 'databaseVariables.php';

    // Database Connection
    $link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));
    //getting the id for the current user
    $uid = $_SESSION["teacherid"];
    //insert query.
    $query = "INSERT INTO zPoll (pollid,question,teacherid) VALUES (null, '$question',$uid)";
	//run query
	$result = $link->query($query);

    $lastid = mysqli_insert_id($link);

    $newid = $lastid;

    //$success = "question has been submitted successfully.";

    $query1 = "INSERT INTO zOption (optionid,optionname,pollid) VALUES (null,'$option1',$newid)";
    $query2 = "INSERT INTO zOption (optionid,optionname,pollid) VALUES (null,'$option2',$newid)";
	$query3 = "INSERT INTO zOption (optionid,optionname,pollid) VALUES (null,'$option3',$newid)";
	$query4 = "INSERT INTO zOption (optionid,optionname,pollid) VALUES (null,'$option4',$newid)";
	$result = $link->query($query1);
	$result = $link->query($query2);
	$result = $link->query($query3);
	$result = $link->query($query4);
$link->close();

$complete = "Your question and answers have been submitted successfully";

}else 

$complete = "something went wrong. Please enter all four options with your question.";

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
		<div class="col-md-6 col-md-offset-3">
			<div class="makeapoll">
				<b><h1 class="text-center">Create A Poll</h1></b>
				<br>
				<h2 class="form-signing-heading">Enter a question.</h2>
				<!-- testing===================================================================-->
				<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="submit" id="submit">

					<div class="form-group">				
						<input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here" required><?php echo $errquestion ?>
					</div>

					<h2 class="form-signing-heading">Supply possible answers below.</h2>

					<div class="form-group">				
						<input type="text" class="form-control" id="option1" name="option1" placeholder="Enter option 1 here" required><?php echo $err1 ?>
					</div>

					<div class="form-group">				
						<input type="text" class="form-control" id="option2" name="option2" placeholder="Enter option 2 here" required><?php echo $err2 ?>
					</div>

					<div class="form-group">				
						<input type="text" class="form-control" id="option3" name="option3" placeholder="Enter option 3 here" required><?php echo $err3 ?>
					</div>
					<div class="form-group">				
						<input type="text" class="form-control" id="option4" name="option4" placeholder="Enter option 4 here" required><?php echo $err4 ?>
					</div>

					<button type="submit" class="btn btn-lg btn-info btn-block" value="submit">Submit Question and Answers.</button> <br><br>
					<input type="reset" class="btn btn-info " value="Reset">
					<br>
					<?php echo $complete ?>

				</form>

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
