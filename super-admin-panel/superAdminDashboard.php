<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "aksdesign";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total number of users
$sqlTotalUsers = "SELECT COUNT(*) as total_users FROM user WHERE role = 'user'";
$resultTotalUsers = mysqli_query($conn, $sqlTotalUsers);
$rowTotalUsers = mysqli_fetch_assoc($resultTotalUsers);
$totalUsers = $rowTotalUsers['total_users'];

// Fetch total number of admins
$sqlTotalAdmins = "SELECT COUNT(*) as total_admins FROM user WHERE role = 'admin'";
$resultTotalAdmins = mysqli_query($conn, $sqlTotalAdmins);
$rowTotalAdmins = mysqli_fetch_assoc($resultTotalAdmins);
$totalAdmins = $rowTotalAdmins['total_admins'];

// Fetch total number of reported admins
$sqlReportedAdmins = "SELECT COUNT(*) as total_reported_admins FROM user WHERE adminReport = 1";
$resultReportedAdmins = mysqli_query($conn, $sqlReportedAdmins);
$rowReportedAdmins = mysqli_fetch_assoc($resultReportedAdmins);
$totalReportedAdmins = $rowReportedAdmins['total_reported_admins'];

// Fetch total number of reported users from the user table in the violated_user database
$sqlReportedUsers = "SELECT COUNT(*) as total_reported_users FROM aksviolated_user.user";
$resultReportedUsers = mysqli_query($conn, $sqlReportedUsers);
$rowReportedUsers = mysqli_fetch_assoc($resultReportedUsers);
$totalReportedUsers = $rowReportedUsers['total_reported_users'];

// Fetch total number of orders
$sqlTotalOrders = "SELECT COUNT(*) as total_orders FROM aksdesign.orders";
$resultTotalOrders = mysqli_query($conn, $sqlTotalOrders);
$rowTotalOrders = mysqli_fetch_assoc($resultTotalOrders);
$totalOrders = $rowTotalOrders['total_orders'];

// Fetch total number of done orders
$sqlDoneOrders = "SELECT COUNT(*) as total_done_orders FROM aksdesign.orders WHERE order_update = 'done'";
$resultDoneOrders = mysqli_query($conn, $sqlDoneOrders);
$rowDoneOrders = mysqli_fetch_assoc($resultDoneOrders);
$totalDoneOrders = $rowDoneOrders['total_done_orders'];

include 'superAdminSidebar.php';
?>





<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="favicon icon" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Super Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #BEDCEE;
            overflow-x: hidden;
        }

        #content {
            position: relative;
            width: calc(100% - 280px);
            left: 280px;
            transition: 0.3s;
        }

        #content main {
            font-family: "Quattrocento", sans-serif;
            width: 100%;
            padding: 36px 24px;
            overflow-y: auto;
        }

        #content main .head-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            grid-gap: 16px;
            flex-wrap: wrap;
        }

        #content main .head-title .left h1 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #3A4851;
        }

        #content main .box-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 24px;
            margin-top: 36px;
        }
        #content main .box-info li {
            padding: 24px;
            background: #96BBD0;
            display: flex;
            align-items: center;
            grid-gap: 24px;
            transition: transform 0.3s;
        }
        #content main .box-info li:hover {
            transform: scale(1.05);
            border: 1px solid #5C707C;
        }
        #content main .box-info li i {
            width: 80px;
            height: 80px;
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #content main .box-info li:nth-child(1) i {
            background: #DCF2FF;
            color: #5C707C;
        }
        #content main .box-info li:nth-child(2) i {
            background: #DCF2FF;
            color: #5C707C;
        }
        #content main .box-info li:nth-child(3) i {
            background: #DCF2FF;
            color: #5C707C;
        }
        #content main .box-info li:nth-child(4) i {
            background: #DCF2FF;
            color: #5C707C;
        }
        #content main .box-info li:nth-child(5) i {
            background: #DCF2FF;
            color: #5C707C;
        }
        #content main .box-info li:nth-child(6) i {
            background: #DCF2FF;
            color: #5C707C;
        }
        #content main .box-info li:nth-child(7) i {
            background: #DCF2FF;
            color: #5C707C;
        }
        #content main .box-info li .text h3 {
            font-size: 24px;
            font-weight: 600;
            color: #3A4851;
        }
        #content main .box-info li .text p {
            font-size: 18px;
            font-weight: 600;
            color: #3A4851;
        }
    </style>
</head>
<body>
    <section id="content">
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>☰ Dashboard</h1>
                </div>
            </div>
            
            <ul class="box-info">
                <li>
                    <i class="fa-solid fa-users"></i>
                    <span class="text">
                        <h3><?php echo $totalUsers; ?></h3>
                        <p>Total Users</p>
                    </span>
                </li>
                <li>
                    <i class="fa-solid fa-users-gear"></i>
                    <span class="text">
                        <h3>0</h3>
                        <p>Inactive Users</p>
                    </span>
                </li>
                <li>
                    <i class="fa-solid fa-users-slash"></i>
                    <span class="text">
                        <h3><?php echo $totalReportedUsers; ?></h3>
                        <p>Reported Users</p>
                    </span>
                </li>
                <li>
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="text">
                        <h3><?php echo $totalAdmins; ?></h3>
                        <p>Total Admin</p>
                    </span>
                </li>
                <li>
                    <i class="fa-solid fa-user-xmark"></i>
                    <span class="text">
                        <h3><?php echo $totalReportedAdmins; ?></h3>
                        <p>Reported Admin</p>
                    </span>
                </li>
                <li>
                    <i class="fa-solid fa-cart-plus"></i>
                    <span class="text">
                        <h3><?php echo $totalOrders; ?></h3>
                        <p>Total Orders</p>
                    </span>
                </li>
                <li>
                    <i class="fa-solid fa-square-check"></i>
                    <span class="text">
                        <h3><?php echo $totalDoneOrders; ?></h3>
                        <p>Done Orders</p>
                    </span>
                </li>
            </ul>
        </main>       
    </section>

</body>
</html>