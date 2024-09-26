<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /aksdesign/index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksdesign";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$records_per_page = 10;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

$offset = ($current_page - 1) * $records_per_page;

$sql = "SELECT * FROM orders WHERE order_update = 'done' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

$total_records_sql = "SELECT COUNT(*) FROM orders WHERE order_update = 'done'";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];

$total_pages = ceil($total_records / $records_per_page);

include('Sidebar.php');
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed OrderS</title>
    <style>
        body {
            font-family: "Barlow", sans-serif;
            font-weight: normal;
            font-style: normal;
            color: #42535d;
            background-color: #fcf8ef;
        }

        #content {
            margin-left: 280px;
            padding: 20px;
        }

        h2 {
            font-family: "Quattrocento", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            color: #42535d;
            text-align: center;
            margin-left: 30px;
            margin-bottom: 30px;
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #gray;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            font-size: 18px;
            background-color: #42535d;
            color: white;
        }

        tr:hover {
            background-color: #f3e6c7;
        }

        td {
            color: black;
        }

        .details-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .details-button:hover {
            background-color: #45a049;
        }

        .action-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-button:hover {
            background-color: #45a049;
        }

        .done-button {
            background-color: #3c91e6;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .done-button:hover {
            background-color: #356dab;
        }
    </style>
</head>
<body>
    <div id="order-info" class="section">
        <div id="content">
            <h2>Completed Orders</h2>
            <?php if (isset($success_message)): ?>
                <div class="success-message">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <table id="orderTable">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Package Name</th>
                    <th>Details</th>
                </tr>
                <?php
                // Loop through the query results and display rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td>{$row['contact_number']}</td>";
                    echo "<td>{$row['package_name']}</td>";
                    echo "<td>{$row['details']}</td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <!-- Pagination Checked -->
            <div style="margin-top: 20px; padding: 10px; background-color: ; display: inline-block;">
                <span style="font-size: 16px; font-weight: 700; margin-right: 10px; padding: 8px; border: 2px solid #55443a;">Page Number:</span>
                <?php
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<a href='order_done.php?page={$page}' style='padding: 8px; margin-right: 5px; text-decoration: none; font-weight: 700; color: #55443a; border: 2px solid #55443a;'>{$page}</a>";
                }
                ?>
            </div>
        </div>
    </div>
    
</body>
</html>



<?php
mysqli_close($conn);
?>
