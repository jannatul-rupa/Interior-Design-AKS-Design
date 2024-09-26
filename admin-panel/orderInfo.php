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

$sql = "SELECT * FROM orders WHERE order_update IS NULL OR order_update = '' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

$total_records_sql = "SELECT COUNT(*) FROM orders WHERE order_update IS NULL OR order_update = ''";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];

$total_pages = ceil($total_records / $records_per_page);



include('Sidebar.php');



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $update_sql = "UPDATE orders SET order_update = 'done' WHERE id = $order_id";
    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['success_message'] = "Order updated successfully!";
    } else {
        $_SESSION['error_message'] = "Error: " . $conn->error;
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Information</title>
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
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            text-align: center;
            border: 1px solid #55443a;
            padding: 0 12px;
            font-size: 14px;
            line-height: 32px;
            color: #fff;
            background-color: #55443a;
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
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            text-align: center;
            border: 1px solid #55443a;
            padding: 0 12px;
            font-size: 14px;
            line-height: 32px;
            color: #fff;
            background-color: #55443a;
        }

        .done-button:hover {
            background-color: #fff;
            color: #55443a;
            border-color: #55443a;
        }
    </style>
</head>
<body>
    <div id="order-info" class="section">
        <div id="content">
            <h2>Order Information</h2>
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
                    <th>Actions</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['address']}</td>";
                        echo "<td>{$row['contact_number']}</td>";
                        echo "<td>{$row['package_name']}</td>";
                        echo "<td>{$row['details']}</td>";
                        echo "<td>
                                <form method='post' action='orderInfo.php'>
                                    <input type='hidden' name='order_id' value='{$row['id']}'>
                                    <button type='submit' class='done-button'>Done</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align: center;'>No orders to work on.</td></tr>";
                }
                ?>
            </table>

            <!-- Pagination checked -->
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
