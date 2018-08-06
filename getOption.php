<html>

<?php 
include 'databaseVariables.php';

    // Database Connection
$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));

$query = "SELECT * from zOption WHERE pollid='".$_POST["pollid"]."'";

$result = $link->query($query);


?>
<option>Select Option</option>
<?php 
while($row = $result->fetch_assoc()) {
	?>

		<option value="<?php echo $row["optionid"]; ?>"> <?php echo $row["optionname"]; ?> </option>


	<?php

}
?>

</html>