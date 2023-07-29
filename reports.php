<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM reports");
$stmt->execute();
$result = $stmt->get_result();

$reports = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Loan</title>
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
  color: #717171;
  border-bottom: 1px solid #e0e4e8;
}

.wrapper .main_content .info{
  margin: 20px;
  color: #717171;
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
.container {
      max-width: 4000px;
      margin: 100 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .container p {
      margin-top: 0;
    }

    </style>    
</head>
<body>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<div class="wrapper">
    <div class="sidebar">
        <h2>Reports</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="dashboard.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="statements.php"><i class="fas fa-address-card"></i>View Statements</a></li>
            <li><a href="loan.php"><i class="fas fa-project-diagram"></i>Apply Loan</a></li>
            <li><a href="#"><i class="fas fa-list"></i>Reports</a></li>
            <li><a href="send.php"><i class="fas fa-download"></i>Send Money</a></li>

        </ul> 
       
    </div>
    <div class="main_content">
        <div class="info">
      
        <div class="container">
    <h2 style="text-align: center; font-size: 25px;">Loan Application</h2>
    <h1 style="text-align: center; font-size: 25px;">Reports</h1>
      <br>
      <br>
    <?php if (!empty($reports)): ?>
        <table>
           
            <tbody>
    <?php foreach ($reports as $report): ?>
        <tr style="font-size: 20px; text-align: center;">
            <td><?php echo $report['id']; ?></td>
            <td><?php echo $report['rejection_reason']; ?></td>
            <td><?php echo $report['approval_message']; ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
        </table>
    <?php else: ?>
        <p>No reports found.</p>
    <?php endif; ?>
  </div>
</div>
<script src="script.js"></script>
    </div>
</div>
</body>
</html>