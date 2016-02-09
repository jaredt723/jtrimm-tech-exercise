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

			$sAttr = $_POST["SAttribute"];
			$sTerm = $_POST["SearchTerm"];
			$rAttr = $_POST["RAttribute"];
			$rTerm = $_POST["RemoveTerm"];

			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error){ die("Connection failed: " . $conn->connect_error); }
		
			if($sAttr && $sTerm != ""){
				$sql = "SELECT * FROM Contacts WHERE $sAttr LIKE '%$sTerm%'";
			} else if($rAttr && $rTerm != ""){
				$sql = "DELETE FROM Contacts WHERE $rAttr LIKE '%$rTerm%'";
				$conn->query($sql);
				$sql = "SELECT * FROM Contacts";
			}else {
				$sql = "SELECT * FROM Contacts";
			}
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
			<h3>Search Contacts</h3>
			<form action="view.php" method="post">
			<strong class="info">Search</strong> &nbsp; <select name="SAttribute" class="textbox">
				<option value="FirstName">First Name</option>
				<option value="LastName">Last Name</option>
				<option value="Email">Email</option>
				<option value="Phone">Phone Number</option>
			</select>
			&nbsp; <strong class="info">for</strong> &nbsp;
			<input class="textbox" name="SearchTerm" type="text" /> &nbsp;
			<input class="styled-button-sub" name="SearchSub" type="submit" value="Search" />
			</form><br><br>

			<hr>		
	
			<h3>Remove Contacts</h3>
			<form action="view.php" method="post">
			<strong class="info">Remove Contact(s) where</strong> &nbsp; <select name="RAttribute" class="textbox">
                                <option value="FirstName">First Name</option>
                                <option value="LastName">Last Name</option>
                                <option value="Email">Email</option>
                                <option value="Phone">Phone Number</option>
                        </select>
			&nbsp; <strong class="info">contains</strong> &nbsp;
			<input class="textbox" name="RemoveTerm" type="text" /> &nbsp;
			<input class="styled-button-sub" name="RemoveSub" type="submit" value="Remove" />
			</form><br><br>
			
			<hr>
		</div>
        </body>
</html>
