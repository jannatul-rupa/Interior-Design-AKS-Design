<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /Project-4800/index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksdesign";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null; //checking user id

$user_details = []; // array

if (!empty($user_id)) {
    $sql = "SELECT * FROM user WHERE uid = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_details = mysqli_fetch_assoc($result);
    } else {
        die("Error fetching user details: " . mysqli_error($conn));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_report'])) {
    $submit_action = $_POST['submit_report'];

    if ($submit_action === 'report_user') {
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);

        if (!empty($category) && !empty($reason)) {
            
            $violated_conn = mysqli_connect($servername, $username, $password, "aksviolated_user");

            if (!$violated_conn) {
                die("Connection to aksviolated_user failed: " . mysqli_connect_error());
            }
         
            $insert_sql = "INSERT INTO user (name, email, role, Categories, ReasonForDeactivating, status, reportedBy) 
            VALUES ('{$user_details['name']}', '{$user_details['email']}', '{$user_details['role']}', '$category', '$reason', 'Deactivated', '{$_SESSION['id']}')";

            if (mysqli_query($violated_conn, $insert_sql)) {
                               
                $delete_sql = "DELETE FROM user WHERE uid = $user_id";

                if (mysqli_query($conn, $delete_sql)) {
                    echo '<script>alert("User reported and moved to aksviolated_user database successfully.");</script>';
                    header("Location: UserInfo.php");
                    exit();
                } else {
                    echo '<script>alert("Error deleting user from the original database: ");</script>';
                }
            } else {
                echo "Error moving user to aksviolated_user database: " . mysqli_error($violated_conn);
            }

            mysqli_close($violated_conn);
        } else {
            echo "Please select a category and enter a reason.";
        }
    } elseif ($submit_action === 'deactivate_user') {
        // Handle deactivation logic
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);
        // echo "User deactivated successfully. Reason: $reason";
    }
}

include('Sidebar.php');
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 130px;
            padding: 0;
            font-family: "Barlow", sans-serif;
            font-weight: normal;
            font-style: normal;
            color: #42535d;
            background-color: #fcf8ef;
        }

        #content {
            font-size: 20px;
            font-weight: 420;
            position: absolute;
            padding: 20px;
            width: 50%;
            line-height: 2;
            background-color: #faf1dd;
            border: 1px solid #55443a;
            text-align: left;
            cursor: default;
            left: 35%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        strong {
            font-weight: bold;
        }

        #reportButton {
            font-family: "Barlow", sans-serif;
            padding-top: 20px;
            font-weight: 600;
            text-align: center;
            border: 1px solid #55443a;
            padding: 0 12px;
            font-size: 14px;
            line-height: 32px;
            color: #fff;
            background-color: #55443a;
        }       

        #reportFieldContainer {
            display: none;
            margin-top: 15px;
        }

        #reportField {
            font-family: "Barlow", sans-serif;
            width: 100%;
            padding: 10px;
            font-weight: 600;
            font-size: 16px;
            box-sizing: border-box;
        }

        #doneButton {
            font-family: "Barlow", sans-serif;
            padding-top: 20px;
            font-weight: 600;
            text-align: center;
            border: 1px solid #55443a;
            padding: 0 12px;
            font-size: 14px;
            line-height: 32px;
            color: #fff;
            background-color: #55443a;
        }
    </style>
</head>
<body>
    <div id="content">
        <?php
        if (!empty($user_details)) {
            echo "<p><strong>User ID:</strong> {$user_details['uid']}</p>";
            echo "<p><strong>Name:</strong> {$user_details['name']}</p>";
            echo "<p><strong>Email:</strong> {$user_details['email']}</p>";
            echo "<p><strong>Status:</strong> {$user_details['status']}</p>";

            echo '<button id="reportButton">Report</button>';

            echo '<form method="post" action="user_details.php" id="reportForm">';
            echo '<div id="reportFieldContainer">';
            echo '<select name="category" id="categoryField" style="margin-top: 20px;">';
            echo '<option value="Fake Accounts">Fake Accounts</option>';
            echo '<option value="Underage Accounts">Underage Accounts</option>';
            echo '<option value="Harassment or Bullying">Harassment or Bullying</option>';
            echo '<option value="Inappropriate Content">Inappropriate Content</option>';
            echo '<option value="Scams and Spam">Scams and Spam</option>';
            echo '<option value="I Want To Help">I Want To Help</option>';
            echo '<option value="Something Else">Something Else</option>';
            echo '</select>';
            echo '<textarea name="reason" id="reportField" placeholder="Enter your report" required></textarea>';
            echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
            echo '<button type="submit" name="submit_report" value="report_user" id="doneButton">Submit Report</button>';
            echo '</div>';
            echo '</form>';
        } else {
            echo "<p>No user details found. </p>";
        }
        ?>
    </div>

    <script>
        document.getElementById("reportButton").addEventListener("click", function () {
            var reportFieldContainer = document.getElementById("reportFieldContainer");
            reportFieldContainer.style.display = "block";
        });
    </script>

</body>
</html>