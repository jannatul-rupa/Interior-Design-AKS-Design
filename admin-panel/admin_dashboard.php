<?php
session_start();
    
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /aksdesign/index.php");
    exit();
}

// Created connection
$conn = mysqli_connect("localhost", "root", "", "aksdesign");

// Checked connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetched user data
$user_sql = "SELECT COUNT(*) AS total_users FROM user WHERE role = 'user'";
$user_result = $conn->query($user_sql);
if ($user_result) {
    $user_count = $user_result->fetch_assoc()['total_users'];
} else {
    $user_count = 0;
}

// Fetched total orders
$order_sql = "SELECT COUNT(*) AS total_orders FROM orders";
$order_result = $conn->query($order_sql);
if ($order_result) {
    $order_count = $order_result->fetch_assoc()['total_orders'];
} else {
    $order_count = 0;
}
    
// Fetched done orders
$done_order_sql = "SELECT COUNT(*) AS done_orders FROM orders WHERE order_update = 'done'";
$done_order_result = $conn->query($done_order_sql);
if ($done_order_result) {
    $done_order_count = $done_order_result->fetch_assoc()['done_orders'];
} else {
    $done_order_count = 0;
}

// Closing the connection
$conn->close();

include('Sidebar.php');
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="favicon icon" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        .box-info {
            display: flex;
            justify-content: space-between; 
            margin-top: 20px;
            padding: 0;
            list-style: none;
        }

        .box-info li i {
            font-size: 40px;
            color: #777;
            margin-bottom: 10px;
        }

        .box-info li .text h3 {
            margin: 10px 0;
            font-size: 24px;
            color: #333;
        }

        .box-info li .text p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        body {
            background: #fcf8ef;
            overflow-x: hidden;
        }

        #content {
            position: relative;
            width: calc(100% - 280px);
            left: 280px;
            transition: 0.3s ease;
        }

        #content main {
            font-family: "Quattrocento", sans-serif;
            width: 100%;
            padding: 36px 24px;
            max-height: calc(100vh - 56px);
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
            background: #E3CAA8;
            /* border-radius: 20px; */
            display: flex;
            align-items: center;
            grid-gap: 24px;
            transition: transform 0.3s;
        }

        #content main .box-info li:hover {
            transform: scale(1.05);
            border: 1px solid #2B2523;
        }

        #content main .box-info li i {
            width: 80px;
            height: 80px;
            /* border-radius: 10px; */
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #content main .box-info li:nth-child(1) i {
            background: #fcf8ef;
            color: #64544B;
        }

        #content main .box-info li:nth-child(2) i {
            background: #fcf8ef;
            color: #64544B;
        }

        #content main .box-info li:nth-child(3) i {
            background: #fcf8ef;
            color: #64544B;
        }
        
        #content main .box-info li:nth-child(4) i {
            background: #fcf8ef;
            color: #64544B;
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
                    <ul class="breadcrumb"></ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <i class="fa-solid fa-users"></i>
                    <span class="text">
                        <h3><?php echo $user_count; ?></h3>
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
                    <i class="fa-solid fa-cart-plus"></i>
                    <span class="text">
                        <h3><?php echo $order_count; ?></h3>
                        <p>Total Orders</p>
                    </span>
                </li>
                <li>
                    <i class="fa-solid fa-square-check"></i>
                    <span class="text">
                        <h3><?php echo $done_order_count; ?></h3>
                        <p>Done Orders</p>
                    </span>
                </li>
            </ul>
        </main>       
    </section>

</body>
</html>