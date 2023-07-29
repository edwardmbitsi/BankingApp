<?php
// Assuming you have established a database connection
// Replace the database credentials with your own

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_db";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $bio = $_POST["bio"];

    // Start building the SQL query
    $sql = "UPDATE users SET ";

    // Initialize an array to store the values for binding
    $values = array();

    // Check if the username field is filled
    if (!empty($username)) {
        $sql .= "username=?, ";
        $values[] = $username;
    }

    // Check if the email field is filled
    if (!empty($email)) {
        $sql .= "email=?, ";
        $values[] = $email;
    }

    // Check if the bio field is filled
    if (!empty($bio)) {
        $sql .= "bio=?, ";
        $values[] = $bio;
    }

    // Check if an image was uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES["image"]["name"];

        $sql .= "image=?, ";
        $values[] = $image;

        // Upload image file to a directory
        $targetDir = "uploads/"; // Change this to your desired directory
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    // Remove the trailing comma and space from the SQL query
    $sql = rtrim($sql, ", ");

    // Add the WHERE clause to specify the user
    $sql .= " WHERE user_id=1";

    // Prepare and execute the SQL query
    $stmt = $conn->prepare($sql);

    // Bind the values dynamically
    $types = str_repeat("s", count($values));
    $stmt->bind_param($types, ...$values);

    // Check if the query execution was successful
    if ($stmt->execute()) {
        echo "Data has been updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/css/bootstrap.min.css">
    <style>
   body {
	background: #384047;
	font-family: sans-serif;
	font-size: 10px
}
form {
	background: #fff;
	padding: 4em 4em 2em;
	max-width: 400px;
	margin: 20px auto 0;
	box-shadow: 0 0 1em #222;
	border-radius: 5px;
}

p {
	margin: 0 0 3em 0;
	position: relative;
}

label {
	display: block;
	font-size: 1.6em;
	margin: 0 0 .5em;
	color: #333;
}

input {
	display: block;
	box-sizing: border-box;
	width: 100%;
	outline: none
}

input[type="text"],
input[type="email"] {
	background: #f5f5f5;
	border: 1px solid #e5e5e5;
	font-size: 1.6em;
	padding: .8em .5em;
	border-radius: 5px;
}

input[type="text"]:focus,
input[type="email"]:focus {
	background: #fff
}

input[type="text"],
input[type="bio"] {
	background: #f5f5f5;
	border: 1px solid #e5e5e5;
	font-size: 1.6em;
	padding: .8em .5em;
	border-radius: 5px;
}

input[type="text"]:focus,
input[type="bio"]:focus {
	background: #fff
}

input[type="image"],
input[type="image"] {
	background: #f5f5f5;
	border: 1px solid #e5e5e5;
	font-size: 1.6em;
	padding: .8em .5em;
	border-radius: 5px;
}


input[type="text"]:focus,
input[type="password"]:focus {
	background: #fff
}


input[type="submit"] {
	background: #2F558E;
	box-shadow: 0 3px 0 0 #1D3C6A;
	border-radius: 5px;
	border: none;
	color: #fff;
	cursor: pointer;
	display: block;
	font-size: 2em;
	line-height: 1.6em;
	margin: 2em 0 0;
	outline: none;
	padding: .8em 0;
	text-shadow: 0 1px #68B25B;
}
  </style>
</head>

<body>
    <?php include_once "navbar2.php"; ?>

    <form action="#" method="post">
			<p>
				<label for="username">Username</label>
				<input id="username" name="username" type="text">
			</p>
			<p>
				<label for="password">Email</label>
				<input id="email" name="email" type="email">
			</p>
			<p>
				<label for="confirm_password">Bio</label>
				<input id="bio" name="bio" type="bio">
			</p>
            <p>
                <label for="image">Image</label>
                <input id="image" name="image" type="file">
            </p>
			<p>
				<input type="submit" value="SUBMIT" id="submit">
			</p>
		</form>

    <script src="https://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/app.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>
