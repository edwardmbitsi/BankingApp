<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random account number
if (!function_exists('generateAccountNumber')) {
    function generateAccountNumber() {
        $prefix = "ACCT";
        $randomDigits = mt_rand(100000, 999999);
        return $prefix . $randomDigits;
    }
}

// Assuming the form is submitted and the $_POST array contains the form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Generate random account number and account balance
    $account_number = generateAccountNumber();
    $balance = 800; // You can set an initial balance if desired

    // Prepare the SQL statement
    $sql = "INSERT INTO users (username, email, password, account_number, balance) VALUES ('$username', '$email', '$password', '$account_number', '$balance')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect to the login page
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign up Page</title>
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
	margin: 100px auto 0;
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
input[type="password"] {
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

.left,
.right {
	border-radius: 5px;
	display: block;
	font-size: 1.3em;
	text-align: center;
	position: absolute;
	background: #2F558E;
	padding: 7px 10px;
	color: #fff;
}

.left {
	left: -60%;
	top: 18px;
	width: 200px;
}

.right {
	left: 105%;
	top: 25px;
	width: 160px;
}

.left:after,
.right:after {
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	top: 50%;
	pointer-events: none;
	border-color: rgba(136, 183, 213, 0);
	border-width: 8px;
	margin-top: -8px;
}

.right:after {
	right: 100%;
	border-right-color: #2F558E;
}

.left:after {
	left: 100%;
	border-left-color: #2F558E;
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
.password-input {
  position: relative;
}

/* Style the password input */
input[type="password"] {
  background: #f5f5f5;
  border: 1px solid #e5e5e5;
  font-size: 1.6em;
  padding: .8em .5em;
  border-radius: 5px;
}

/* Style the visually appealing "Show Password" toggle */
.toggle-password {
  display: none;
}

/* Style the "Show Password" label with a custom icon */
.toggle-label {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  width: 24px;
  height: 24px;
  background-color: #f5f5f5;
  border: 2px solid #ccc;
  border-radius: 50%;
  cursor: pointer;
}

/* Add a custom icon inside the label */
.toggle-label::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: #2F558E;
  opacity: 0; /* Initially hidden */
  transition: opacity 0.3s ease;
}

/* Show the custom icon when the checkbox is checked */
.toggle-password:checked + .toggle-label::before {
  opacity: 1;
}

/* Add a transition effect to the password visibility change */
input[type="password"] {
  transition: background-color 0.3s ease;
}

input[type="password"]:focus,
input[type="password"]:hover {
  background-color: #fff;
}
  </style>
</head>

<body>
    <?php include_once "navbar.php"; ?>

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
      <label for="password">Password</label>
      <div class="password-input">
        <input id="password" name="password" type="password">
        <!-- Add a visually appealing "Show Password" toggle -->
        <input type="checkbox" id="showPassword" class="toggle-password">
        <label for="showPassword" class="toggle-label"></label>
      </div>
    </p>
			<p>
				<input type="submit" value="SUBMIT" id="submit">
			</p>
		</form>

    <script src="https://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/app.js" type="text/javascript" charset="utf-8"></script>
	<script>
    // JavaScript to toggle password visibility
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('change', function() {
      passwordInput.type = this.checked ? 'text' : 'password';
    });
  </script>
</body>

</html>
