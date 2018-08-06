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

//code for voing in a poll goes here.


	if(!isset($_POST['submit']))
	{

		$uid = $_SESSION['userid'];

		$selectedpoll = $_POST['questionlist'];
		$selectedoption = $_POST['optionlist'];

		    //insert query.
		    $query = "INSERT INTO zAnswer (answerid,userid,pollid,optionid) VALUES (null,'".$_SESSION['userid']."','".$_POST['questionlist']."','".$_POST['optionlist']."')";
			//run query
			$result = $link->query($query);
		
		$complete = "Your answer has been submitted successfully";



		
		
	}else{

		$complete = "something went wrong. Please try again.";


		echo "something went wrong.";
		echo $_SESSION['userid'];

		echo $_POST['questionlist'];
		echo $_POST['optionlist'];
/*		echo $_POST['questionlist'];
		echo "didnt work ";
		echo $selectedpoll;
		echo "testsecond";

		echo $_POST['optionlist'];

		echo 'Hello '.$_SESSION['userid'].'!';*/
	}




?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Vote</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!--my own style sheet -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

</head>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
<script>
	function getOption(val)
	{
		$.ajax({
			type:"POST",
			url:"getOption.php",
			data: 'pollid='+val,
			success: function(data){

				$("#optionlist").html(data);
			}

		});
	}


	function showMsg()
	{
		//.val() instead of text will get id.
		$("#msgP").html($("#questionlist option:selected").text());
		$("#msgO").html($("#optionlist option:selected").text());
		$("#msgPID").html($("#questionlist option:selected").val());
		$("#msgOID").html($("#optionlist option:selected").val());

		return false;
	}

			</script>
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
					<div class="col-md-4 col-md-offset-4">
						<div class="btn-toolbar">
							<b><h1 class="text-center">Vote</h1></b>
							<br>
							<?php echo 
							"Welcome ".$_SESSION['username'].", select a poll and vote. <br/><br/>";
							?>
							<!-- testing===================================================================-->
							<!-- get the name from this ????-->

							<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="submit" id="submit">
								<h3><label>Choose from one of the following polls: </label></h3>
								<select id="questionlist" name="questionlist" onChange="getOption(this.value)">
									<option value="">Select a  Poll to vote in</option>
									<?php 
									$query = "SELECT * FROM zPoll";
									$result = $link->query($query);

									while($row = $result->fetch_assoc()) {
										?>
										<option value="<?php echo $row["pollid"]; ?>"><?php echo $row["question"];  ?> </option>

										<?php 
									}

									?>


								</select>

								<h3><label>After choosing a poll, select from the answers below: </label></h3>
								<select id="optionlist" name="optionlist">
									<option value="">Select Option</option>
								</select> <br><br>

								<button type="submit" class="btn btn-info" value="submit">Submit Answer.</button>
								<br><br><br>
								<button type="submit" value="submit" onClick="return showMsg();">Submit debug</button> <br><br>

								<?php echo $complete ?> 
							</form> <br><br>

							Debugging Purposes (not in final product) <br><br>
							Selected Poll: <span id="msgP">test</span> <br><br>
							Selected Option: <span id="msgO"></span> <br><br>
							pollid: <span id="msgPID"></span> <br><br>
							optionid: <span id="msgOID"></span> <br><br>



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
