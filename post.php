<?php
session_start();
error_reporting(E_ERROR);

if (!isset($_SESSION['email'])) {
	session_destroy();
  header("Location: login.php"); // redirect to login page
}
echo $_GET['del'];
echo $_SESSION['threadid'];

$_SESSION["threadid"]=$_GET['del'];

echo $_SESSION['threadid'];

$sid = $_SESSION['threadid'];
$id = '5';


$int = (int)$sid;

echo $int;


echo $sid;

echo "the int: ";

echo $int;

?>

<?php 
require 'databaseVariables.php';
$pmid = ($_GET['del']);

    // Database Connection
$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));
//$date = date("Y-m-d H:i:s");
if(!isset($_POST['submit']) && !empty($_POST['title'])){
	//get values passed from thread click.
	
	
	
//$qry = "INSERT INTO zThread (threadid,subject,threadtime,userid) VALUES (null,'".$_POST['title']."',$date,'".$_SESSION['userid']."')";
	//$qry = "INSERT INTO zThread (threadid,subject,threadtime,userid) VALUES (null,'".$_POST['title']."', NOW(),'".$_SESSION['userid']."')";
	//$qry = "INSERT INTO zPost (postid,postbody,postdate,userid,threadid) VALUES (null,'".$_POST['title']."', NOW(),'".$_SESSION['userid']."','".$_SESSION['threadid']."')";
	$qry = "INSERT INTO zPost (postid,postbody,postdate,userid,threadid) VALUES (null,'".$_POST['title']."', NOW(),'".$_SESSION['userid']."',$int)";

$rs = $link->query($qry);

//$link->close();
}else{
	echo "<br>";
	echo $pmid;
	echo "kk";
	$x=$_GET['del'];
	echo $_GET['del'];
	//echo $date;
	echo "hhh";
	echo $x;
	echo "test";
	echo $int;
	echo $_SESSION["threadid"];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Post a Reply</title>

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
		<div class="col-md-10 col-md-offset-2">
			<div class="form-register">
				<b><h1 class="text-center">Post a Reply</h1></b>
				<br>
				<!-- testing===================================================================-->
				<?php echo 
				"You are logged in as ".$_SESSION['username'].". <br/>Here you can reply to topics posted by your peers. <br><br/>";
				?>

				<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="submit" id="submit">


					<div class="form-group">

						<label for="title"><h3>Reply to the thread below:</h3></label>
						<textarea class="form-control" rows="5" id="title" name="title"></textarea>
						<!--<input type="text" class="form-control" id="title" name="title" placeholder="Enter thread title here." required><?php //echo $erruname ?> -->
					</div>
						<button type="submit" class="btn btn-info" value="submit">Post Reply</button><br><br>


				</form>


					<table class="table table-bordered">
					<thead>
						<tr>
							<th>User: </th>
							<th>Post: </th>
							<th>Creation Date: </th>
						</tr>
					</thead>

					<?php 
 
					require 'databaseVariables.php';

    // Database Connection
					$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));
    //select query.
					//$query = "SELECT threadid, subject, threadtime, userid, zUser.username FROM zThread ORDER BY threadid DESC ";
					//$query ="SELECT zThread.threadid, zThread.subject, zThread.threadtime, zThread.userid, zUser.username FROM zThread INNER JOIN zUser ON zThread.userid=zUser.userid";
					//$query = "SELECT threadid, subject, threadtime, zThread.userid, zUser.username FROM zThread INNER JOIN zUser ON zThread.userid=zUser.userid";
					$query = "SELECT postid, postbody, postdate, zPost.userid, zUser.username, zPost.threadid FROM zPost INNER JOIN zUser ON zPost.userid=zUser.userid JOIN zThread ON zPost.threadid=zThread.threadid WHERE zPost.threadid='".$_SESSION['threadid']."'";

					$result = $link->query($query);
					if(!$result)
						die('Invalid query: ' . mysqli_error($link));

					while ($row = mysqli_fetch_array($result)) { ?>

					<tr>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['postbody']; ?></td>
						<td><?php echo $row['postdate']; ?></td>
						
						


					</tr>



					<?php  }?>
				</table>








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
