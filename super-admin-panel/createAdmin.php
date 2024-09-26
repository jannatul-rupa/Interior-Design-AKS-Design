<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "aksdesign";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully to the aksdesign database.<br>"; // Debug output
}

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$fullname = $email = $password = $confirm_password = "";
$fullname_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fullname"])) {
        $fullname_err = "Full Name is required";
    } else {
        $fullname = sanitize_input($_POST["fullname"]);
    }

    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    }

    // Validating Password
    if (empty($_POST["password"])) {
        $password_err = "Password is required";
    } else {
        $password = sanitize_input($_POST["password"]);
    }

    // Validate Confirm Password
    if (empty($_POST["confirm_password"])) {
        $confirm_password_err = "Please confirm password";
    } else {
        $confirm_password = sanitize_input($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $confirm_password_err = "Password did not match";
        }
    }

    // Check input errors before inserting into database
    if (empty($fullname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        $hashed_password = md5($password);

        $sql = "INSERT INTO user (name, email, password, role, status) VALUES (?, ?, ?, 'admin', 'active')";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sss", $param_fullname, $param_email, $param_password);

        $param_fullname = $fullname;
        $param_email = $email;
        $param_password = $hashed_password;

        if ($stmt->execute()) {
            echo "Record inserted successfully into the user table in aksdesign database.<br>"; // Debug output
            header("location: superAdminDashboard.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
include ("superAdminSidebar.php");
?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Barlow", sans-serif;
            margin: 0px;
            padding: 0px;
            background-color: #BEDCEE;
            overflow: hidden;
        }

        .form-wrap {
            width: 600px;
            background: #96BBD0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
            box-sizing: border-box;
            padding: 70px;
            position: fixed;
            left: 61%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            font-family: "Quattrocento", sans-serif;
            font-size: 24px;
            font-weight: 600;
            text-transform: uppercase;
            color: #42535d;
            text-align: center;
            margin-bottom: 30px;
        }

        input {
            font-family: "Barlow", sans-serif;
            width: 100%;
            background: #BEDCEE;
            border: 1px solid #42535d;
            padding: 10px 20px;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 15px;
            color: #42535D;
            font-weight: 600;
        }

        input[type="submit"] {
            margin-top: 10px;
            background: #42535D;
            border: 1px solid #42535d;
            color: #BEDCEE;
        }

        input[type="submit"]:hover {
            color: #42535d;
            background: #BEDCEE;
        }

        ::placeholder {
            color: #42535D;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="form-wrap">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Create Admin</h1>
            <input type="text" name="fullname" placeholder="Full Name">
            <span class="error">
                <?php echo $fullname_err; ?>
            </span>
            <input type="email" name="email" placeholder="Email Number">
            <span class="error">
                <?php echo $email_err; ?>
            </span>
            <input type="text" name="UID Number" placeholder="UID Number">
            <input type="password" name="password" placeholder="Password">
            <span class="error">
                <?php echo $password_err; ?>
            </span>
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <span class="error">
                <?php echo $confirm_password_err; ?>
            </span>
            <input type="submit" value="Create Now">
        </form>
    </div>
</body>

</html>
</html>