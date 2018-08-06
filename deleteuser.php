<?php 

				require 'databaseVariables.php';

    // Database Connection
				$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));



				//delete records.
				if(isset($_GET['del'])) {
					$uid = ($_GET['del']);
						//$query = "DELETE FROM zUser WHERE userid=$uid";
						//$result = $link->query($query);
						mysqli_query($link, "DELETE FROM zUser WHERE userid=$uid");
						header('location: ManageUser.php');


				}


 ?>