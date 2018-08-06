<?php

error_reporting(E_ERROR);
?>
<?php

if(!isset($_POST['submit']) && !empty($_POST['email'])){
//does this if the button is pressed.
//basic server side validation if client side turns off javascript.
    if(!isset($_POST['uname'])){
        $erruname = "First Name is required. ";
    }


    if(!isset($_POST['email'])){
        $erremail = "Email is required. ";
    }
    if(!isset($_POST['email2'])){
        $erremail2 = "Confirm email is required. ";
    }
    if(!isset($_POST['pass'])){
        $errpass = "Password is required. ";
    }
    if(!isset($_POST['pass2'])){
        $errpass2 = "Password confirmation is required. ";
    }





  $uname = $_POST['uname'];
    
  $email = $_POST['email'];
  $email2 = $_POST['email2'];
  $pass = $_POST['pass'];
  $pass2 = $_POST['pass2'];

  if($email==$email2 && $pass==$pass2){

    $pass=md5($pass);//using md5 for encryption in prototype.
    require 'databaseVariables.php';

    // Database Connection
    $link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));

    //check if email is already used.
    $query = "SELECT email FROM zUser WHERE email = '$email'";

    $result = $link->query($query);
    if(!$result)
           die('Invalid query: ' . mysqli_error($link)); 

    if ($result->num_rows == 1) {
           // output data of one row
          $row = $result->fetch_assoc();
           
            $errmatch = 'The Email address ' . $row["email"]. ' is already in use.';
       //$link->close();

        }
        if($result->num_rows == null){
    //enter user details into database with this query.
    $query = "INSERT INTO zUser (userid,username,password,email,role) VALUES (null,'$uname','$pass','$email','student')";
    //use the line below when adding a teacher. temporary solution for this demo.
    //$query = "INSERT INTO zUser (userid,username,password,email,role) VALUES (null,'$uname','$pass','$email','teacher')";

    $result = $link->query($query);
$link->close();

    $registered = "Registration successfull, Please return to the login page to continue";

}
  }else{
    //error if either password or email fields do not match.
    
    $errmatch = "Email or passwords are not the same";
  }





}else{

$begin = "Enter information into all fields below to register";
//wont print out

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Register Page</title>

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
              <!-- add logo here-->
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
                <b><h1 class="text-center">Registration</h1></b>
                <br>
                

                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="submit" id="submit">

                <!-- testing===================================================================-->
                


                    <div class="form-group">
                    <?php echo $begin . "<br/>"?>
                        <i class="glyphicon glyphicon-user"></i>
                        <label for="uname">Username:</label>
                        <input type="text" class="form-control" id="uname" name="uname" placeholder="Username" required><?php echo $erruname ?>
                    </div>



                    <div class="form-group">
                    <i class="glyphicon glyphicon-envelope"></i>
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email" required><?php echo $erremail ?>
                    </div>

                    <div class="form-group">
                    <i class="glyphicon glyphicon-envelope"></i>
                        <label for="email2">Confirm Email:</label>
                        <input type="email" class="form-control" id="email2" name="email2" placeholder="Confirm email" required><?php echo $erremail2 ?>
                    </div>


                    <div class="form-group">
                        <i class="glyphicon glyphicon-lock"></i>
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="password" required><?php echo $errpass ?>
                    </div>

                    <div class="form-group">
                        <i class="glyphicon glyphicon-lock"></i>
                        <label for="password">Confirm Password:</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm password" required><?php echo $errpass2 ?>
                    </div>

                    <button type="submit" class="btn btn-info" value="submit">Submit</button>
                    <?php echo $errmatch ?> <?php echo $registered ?>
                </form>

                <br/>
                Once you have registered
                <a href="login.php">please click here to return to the login page.</a>
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