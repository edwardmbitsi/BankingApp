<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bank_db';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT username, email, image, bio FROM users WHERE user_id = 1"; // Replace 1 with the appropriate user ID
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
    $image = $row['image'];
    $bio = $row['bio'];
} else {
    echo "Error retrieving user information: " . mysqli_error($conn);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $newImage = $_FILES['image']['name'];
    $newBio = $_POST['bio'];

    $updateQuery = "UPDATE users SET username = '$newUsername', email = '$newEmail', image = '$newImage', bio = '$newBio' WHERE user_id = 1"; // Replace 1 with the appropriate user ID

    if (mysqli_query($conn, $updateQuery)) {
       
        header('Location: profile.php');
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
@import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
  font-family: 'Josefin Sans', sans-serif;
}

body{
   background-color: #f3f5f9;
}

.wrapper{
  display: flex;
  position: relative;
}

.wrapper .sidebar{
  width: 200px;
  height: 100%;
  background: #3d85c6;
  padding: 30px 0px;
  position: fixed;
}

.wrapper .sidebar h2{
  color: #fff;
  text-transform: uppercase;
  text-align: center;
  margin-bottom: 30px;
}

.wrapper .sidebar ul li{
  padding: 15px;
  border-bottom: 1px solid #bdb8d7;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  border-top: 1px solid rgba(255,255,255,0.05);
}    

.wrapper .sidebar ul li a{
  color: #bdb8d7;
  display: block;
}

.wrapper .sidebar ul li a .fas{
  width: 25px;
}

.wrapper .sidebar ul li:hover{
  background-color: #594f8d;
}
    
.wrapper .sidebar ul li:hover a{
  color: #fff;
}


.wrapper .main_content{
  width: 100%;
  margin-left: 200px;
}

.wrapper .main_content .header{
  padding: 20px;
  background: #fff;
  color: #3d85c6;
  border-bottom: 1px solid #e0e4e8;
}

.wrapper .main_content .info{
  margin: 20px;
  color: #3d85c6;
  line-height: 25px;
}

.wrapper .main_content .info div{
  margin-bottom: 20px;
}


.card {
  width: 25rem;
  background-color: #fff;
  border-radius: 24px;
}

.card .container {
  width: 80%;
  margin: 0 auto;
  padding: 1rem 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.container img {
  width: 160px;
  height: 160px;
  border-radius: 50%;
  border: 10px solid #ecf0fc;
}

.container h2 {
  font-size: 32px;
  font-weight: 700;
  margin: 1rem 0 0.5rem 0;
}

.container small {
  color: #120c35;
  font-size: 18px;
  font-weight: 300;
  margin-bottom: 2rem;
}

.container .bar {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.bar .btn {
  width: 6rem;
  cursor: pointer;
  background-color: #fff;
  padding: 10px 0;
  border-radius: 16px;
  border: 1px solid #c2cdef;
  color: #120c35;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.btn i {
  font-size: 20px;
  margin-bottom: 0.5rem;
}



@media screen and (max-width: 425px) {
  .card {
    width: 25rem;
  }

  .container img {
    width: 100px;
    height: 100px;
  }

  .container h2 {
    font-size: 20px;
  }

  .container small {
    font-size: 14px;
  }

  .bar .btn {
    width: 3.7rem;
    font-size: 10px;
  }

}

    </style>    
</head>
<body>

<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<div class="wrapper">
    <div class="sidebar">
        <h2>Profile</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="#"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="statements.php"><i class="fas fa-address-card"></i>View Statements</a></li>
            <li><a href="loan.php"><i class="fas fa-project-diagram"></i>Apply Loan</a></li>
            <li><a href="reports.php"><i class="fas fa-list"></i>Reports</a></li>
            <li><a href="send.php"><i class="fas fa-download"></i>Send Money</a></li>
        </ul> 
       
    </div>
    <div class="main_content">
        <div class="header">Welcome <?php echo $username; ?>!! Have a nice day.</div>  
        <div class="info" style="position: relative;">
      
      <div class="card" style="position: absolute;
  top: 50%;
  left: 30%;
  transform: (-50%, -50%);">
  <div class="container">
  <img src="https://th.bing.com/th/id/OIP.yzfQ0EvhzPGa8YxVK0wPjAHaHa?pid=ImgDet&rs=1" alt="Profile Image">    
  <p>Username: <?php echo $username; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Bio: <?php echo $bio; ?></p>
    <div class="bar">
      
    <div class="center" style="margin-left: 110px; height: 5px; width: 5%;">
  <a href="update-profile.php" id="editProfileBtn" class="btn">
    <i class="fas fa-pen"></i>
    <span>Edit profile</span>
  </a>
</div>    
    </div>
  </div>
</div>
</div>

<script src="script.js">
</script>
    </div>
</div>
</body>
</html>