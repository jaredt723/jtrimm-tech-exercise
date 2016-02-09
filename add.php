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
			$password = ""; //Omitted for security.
			$dbname = "myDB";

			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error){ die("Connection failed: " . $conn->connect_error); }

			$lname = $_POST["LastName"];
			$fname = $_POST["FirstName"];
			$email = $_POST["Email"];
			$phone = $_POST["Phone"];

			$sql = "INSERT INTO Contacts (LastName, FirstName, Email, Phone) VALUES ('$lname', '$fname', '$email', '$phone')";

			if ($conn->query($sql) === TRUE){
				echo "New record created successfully. Please check the contact list or add a new contact.";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
			?>                 
                </div>
        </body>
</html>
