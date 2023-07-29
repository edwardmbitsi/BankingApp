<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve values from the "transactions" table
$sql = "SELECT id, account_number, amount, description, transaction_date FROM transactions";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Money</title>
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

table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
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
 
.wrapper .sidebar .social_media{
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
}

.wrapper .sidebar .social_media a{
  display: block;
  width: 40px;
  background: #594f8d;
  height: 40px;
  line-height: 45px;
  text-align: center;
  margin: 0 5px;
  color: #bdb8d7;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
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
      max-width: 1000px;
      margin: 100 auto;
      padding: 10px;
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

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .form-group input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
      background-color: #45a049;
    }
    </style>    
</head>
<body>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<div class="wrapper">
    <div class="sidebar">
        <h2>Statements</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="dashboard.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i>View Statements</a></li>
            <li><a href="loan.php"><i class="fas fa-project-diagram"></i>Apply Loan</a></li>
            <li><a href="reports.php"><i class="fas fa-list"></i>Reports</a></li>
            <li><a href="send.php"><i class="fas fa-download"></i>Send Money</a></li>

        </ul> 
       
    </div>
    <div class="main_content">
        <div class="info">
      
        <div class="container">
        <h2>Transactions</h2>
    <?php if ($result->num_rows > 0): ?>
        <table id="transaction-table">
            <tr>
                <th>ID</th>
                <th>Account Number</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Transaction Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["account_number"]; ?></td>
                    <td><?php echo $row["amount"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><?php echo $row["transaction_date"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <br>
        <button onclick="downloadCSV()">Download</button>
    <?php else: ?>
        <p>No transactions found.</p>
    <?php endif; ?>
            </div>
</div>
<script src="script.js"></script>
    </div>
</div>
<script src="script.js">
         function downloadCSV() {
            var table = document.getElementById("transaction-table");
            var rows = table.getElementsByTagName("tr");
            var csvContent = "data:text/csv;charset=utf-8,";

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var row = [];

                for (var j = 0; j < cells.length; j++) {
                    row.push(cells[j].innerText);
                }

                csvContent += row.join(",") + "\n";
            }

            var encodedURI = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedURI);
            link.setAttribute("download", "transactions.csv");
            document.body.appendChild(link);

            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>