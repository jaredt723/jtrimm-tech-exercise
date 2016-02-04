<!DOCTYPE html>
<html lang="en">
        <head>
                <title>Jared's Contact List</title>
                <meta charset="utf-8"/>
                <link rel="stylesheet" type="text/css" href="style.css">
                <div class="sidebar">
                        <br>
                        <a href="add.html" class="sidelinks">Add a Contact</a> <br><br>
                        <a href="view.php" class="sidelinks">View Contact List</a> <br><br>
                </div>
                <div class="header">
                        <h1>Jared's Contact List</h1>
                </div>
        </head>

        <body>
                <div class="main">
			<br>
       			<?php
			$servername = "localhost";
			$username = "jtrimm";
			$password = ""; //removed for security
			$dbname = "myDB";

			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error){ die("Connection failed: " . $conn->connect_error); }

			$sql = "SELECT * FROM Contacts";
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				echo '<table class="styled"><tr style="background-color:#1a8aff"><td>Last Name</td><td>First Name</td><td>E-mail Address</td><td>Phone Number</td></tr>';
				while($row = $result->fetch_assoc()){
					echo "<tr style=\"background-color:#cce5ff\"><td>" . $row["LastName"] . "</td><td>" . $row["FirstName"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Phone"]. "</td></tr>";
				}
			} else {
				echo "0 results";
			}

			$conn->close();
			?>                 
                </div>
        </body>
</html>
