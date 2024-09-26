<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksviolated_user";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetched reported user data for users with role 'user'
$sql = "SELECT * FROM user WHERE role = 'user'";
$result = $conn->query($sql);

// Number of records to show per page
$records_per_page = 10;

// Get the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

// Calculate the offset for the query based on the current page
$offset = ($current_page - 1) * $records_per_page;

// Fetched user data with pagination
$sql = "SELECT * FROM user WHERE role = 'user' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

// Count total number of records
$total_records_sql = "SELECT COUNT(*) FROM user WHERE role = 'user'";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

include('superAdminSidebar.php');
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reported User Information</title>
    <style>
        html {
            overflow-x: hidden;
        }

        body {
            font-family: "Barlow", sans-serif;
            font-weight: normal;
            font-style: normal;
            color: #64544B;
            background-color: #BEDCEE;
        }

        #user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
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

        #reportedUserTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #gray;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #reportedUserTable th,
        #reportedUserTable td {
            padding: 12px;
            text-align: left;
            border: 1px solid #C9C1BD;
        }

        #reportedUserTable th {
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

        .category-button {
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            text-align: center;
            border: 1px solid #42535D;
            padding: 7px;
            font-size: 14px;
            color: #fff;
            background-color: #42535D;
        }

        .category-button:hover {
            background-color: #fff;
            color: #42535D;
            border-color: #42535D;
        }

        .popup {
            display: none;
            position: fixed;
            top: 30%;
            left: 50%;
            padding: 20px;
            background-color: #BEDCEE;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            border: 20px solid #42535D;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 100;
        }

        .popup h3 {
            font-family: "Quattrocento", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            color: #64544B;
            text-align: center;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
            margin-top: 30px;
        }

        .popup p {
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            color: #64544B;
            text-align: center;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div id="user-info" class="section">
        <div id="content">
            <h2>Reported User Information</h2>
            <table id="reportedUserTable">
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reported</th>
                    <th>Signup Time</th>
                    <th>Status</th>
                    <th>Categories</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['uid']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['reportedBy']}</td>";
                        echo "<td>{$row['signup_time']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td><button class='category-button' onclick='showReason(\"{$row['uid']}\")'>{$row['Categories']}</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No reported users found</td></tr>";
                }
                ?>
            </table>

            <!-- Pagination -->
                <div style="margin-top: 20px; padding: 10px;  background-color: ; display: inline-block;">
                <span
                    style="font-size: 16px; font-weight: 700; margin-right: 10px; padding: 8px; border: 2px solid #42535D; color:black">Page Number:</span>
                <?php
                // Display pagination links
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<a href='violatedUser.php?page={$page}' style='padding: 8px; margin-right: 5px; text-decoration: none; font-weight: 700; color: #42535D; border: 2px solid #42535D;'>{$page}</a>";
                }
                ?>
            </div>

        </div>
    </div>

    <div id="reasonPopup" class="popup">
        <span onclick="closePopup()" style="cursor: pointer; float: right;">&times;</span>
        <h3>Reason For Deactivating</h3>
        <p id="reasonText"></p>
    </div>

    <div id="popupOverlay" class="popup-overlay" onclick="closePopup()"></div>

    <script>
        function showReason(userId) {
            // Fetch the reason from the database using AJAX
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var reason = this.responseText;
                    document.getElementById("reasonText").innerHTML = reason;
                    openPopup();
                }
            };
            xmlhttp.open("GET", "getReason.php?userId=" + userId, true);
            xmlhttp.send();
        }

        function openPopup() {
            document.getElementById("reasonPopup").style.display = "block";
            document.getElementById("popupOverlay").style.display = "block";
        }

        function closePopup() {
            document.getElementById("reasonPopup").style.display = "none";
            document.getElementById("popupOverlay").style.display = "none";
        }
    </script>

</body>
</html>