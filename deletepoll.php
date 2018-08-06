<?php 

				require 'databaseVariables.php';

    // Database Connection
				$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error($link));



				//delete records.
				if(isset($_GET['del'])) {
					$pid = ($_GET['del']);
						//$query = "DELETE FROM zUser WHERE userid=$uid";
						//$result = $link->query($query);
						mysqli_query($link, "DELETE FROM zPoll WHERE pollid=$pid");
						header('location: ManagePoll.php');


				}


 ?>