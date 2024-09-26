<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksdesign";

// Connect to the otp_verification database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch reported admins from otp_verification database
$sql = "SELECT uid, name, email, role, signup_time, status, adminReport, reportedBy FROM user WHERE role = 'admin' AND adminReport IS NOT NULL AND adminReport <> ''";
$result = mysqli_query($conn, $sql);

// Handle form submission
if (isset($_POST['take_action'])) {
    $uid = $_POST['uid'];

    // Retrieve admin information from otp_verification database
    $sql_select_admin = "SELECT * FROM user WHERE uid = $uid";
    $result_admin = mysqli_query($conn, $sql_select_admin);

    if (mysqli_num_rows($result_admin) == 1) {
        $admin_data = mysqli_fetch_assoc($result_admin);

        // Connect to the violated_user database
        $violated_conn = mysqli_connect("localhost", "root", "", "aksviolated_user");

        // Insert admin information into violated_user database
        $insert_sql = "INSERT INTO user (uid, name, email, role, Categories, ReasonForDeactivating, reportedBy, signup_time, status) 
                        VALUES ('{$admin_data['uid']}', '{$admin_data['name']}', '{$admin_data['email']}', '{$admin_data['role']}', '', '{$admin_data['adminReport']}', '{$admin_data['reportedBy']}', '{$admin_data['signup_time']}', '{$admin_data['status']}')";

        if (mysqli_query($violated_conn, $insert_sql)) {
            // Delete admin record from otp_verification database
            $delete_sql = "DELETE FROM user WHERE uid = $uid";
            if (mysqli_query($conn, $delete_sql)) {
                echo "<script>alert('Action taken successfully!');</script>";
            } else {
                echo "<script>alert('Failed to delete admin record from aksdesign database.');</script>";
            }
        } else {
            echo "<script>alert('Failed to insert admin information into aksviolated_user database.');</script>";
        }

        // Close violated_user database connection
        mysqli_close($violated_conn);
    } else {
        echo "<script>alert('Admin not found in database.');</script>";
    }
}

$records_per_page = 10;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

$offset = ($current_page - 1) * $records_per_page;

$sql = "SELECT * FROM user WHERE role = 'admin' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

$total_records_sql = "SELECT COUNT(*) FROM user WHERE role = 'admin'";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];

$total_pages = ceil($total_records / $records_per_page);

include('superAdminSidebar.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Reported Admin Information</title>
    <style>
        body {
            font-family: "Barlow", sans-serif;
            margin: 0;
            padding: 0;
            color: #64544B;
            background-color: #BEDCEE;
        }

        #content {
            margin-left: 280px;
            padding: 20px;
        }

        h2 {
            font-family: "Quattrocento", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            color: #64544B;
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
            border: 1px solid #C9C1BD;
        }

        th {
            font-size: 18px;
            background-color: #64544B;
            color: white;
        }

        tr:hover {
            background-color: #96BBD0;
        }

        td {
            color: black;
        }

        .action-button {
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            text-align: center;
            border: 1px solid #42535D;
            padding: 0 12px;
            font-size: 14px;
            line-height: 32px;
            color: #fff;
            background-color: #42535D;
        }

        .action-button:hover {
            background-color: #fff;
            color: #42535D;
            border-color: #42535D;
        }
    </style>
</head>
<body>
    <div id="content">
        <h2>Reported Admin Information</h2>
        <table>
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Report By</th>
                    <th>Admin Report</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['uid']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['reportedBy']}</td>"; 
                        echo "<td>{$row['adminReport']}</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='uid' value='{$row['uid']}'>";
                        echo "<button type='submit' name='take_action' class='action-button'>Take Action</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No reported admins found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div style="margin-top: 20px; padding: 10px;  background-color: ; display: inline-block;">
            <span
                style="font-size: 16px; font-weight: 700; margin-right: 10px; padding: 8px; border: 2px solid #55443a;">Page Number:</span>
            <?php
                
            for ($page = 1; $page <= $total_pages; $page++) {
                echo "<a href='reportedAdmin.php?page={$page}' style='padding: 8px; margin-right: 5px; text-decoration: none; font-weight: 700; color: #55443a; border: 2px solid #55443a;'>{$page}</a>";
            }
            ?>
        </div>

    </div>
</body>
</html>

<?php

mysqli_close($conn);
?>
