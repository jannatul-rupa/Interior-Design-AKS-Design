<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksdesign";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM blog";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Check if there was an error executing the query
if (!$result) {
    die("Error executing the query: " . mysqli_error($conn));
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <link rel="favicon icon" href="images/favicon.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Barlow", Arial, sans-serif;
            position: relative;
            background: linear-gradient(135deg, #F3E6C7, #6AD1DF);
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            background: linear-gradient(135deg, #F3E6C7, #6AD1DF);
        }

        .navbar {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #fff;
            padding: 1rem;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-size: 1.2rem;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff;
            transform: scale(1.1);
        }

        .container-blog {
            margin-top: 100px;
            height: calc(100vh - 100px);
            overflow-y: auto;
        }

        .card {
            position: relative;
            width: 350px;
            height: auto;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.5);
            transition: 0.3s;
            padding: 20px;
            background: #FCF8EF;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        .card:hover {
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.5);
            height: auto;
        }

        .imgbox {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .navbar .nav-link {
            color: #000 !important;
        }

        img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .content {
            padding: 10px;
            text-align: left;
            overflow: hidden;
            max-height: 60px;
            transition: max-height 0.3s;
        }

        .card:hover .content {
            max-height: 200px;
        }

        .content h2 {
            color: #55443a;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .content p {
            color: #5C707C;
            font-size: 1rem;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: auto;
            -webkit-box-orient: vertical;
        }

        .btn-read-more {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            border: 1px solid #55443a;
            padding: 0 30px;
            font-size: 16px;
            line-height: 48px;
            color: #fff;
            z-index: 5;
            background-color: #55443a;
            font-family: "Barlow", sans-serif;
            text-transform: uppercase;
        }

        .card:hover .btn-read-more {
            background-color: #fff;
            color: #55443a;
            border-color: #55443a;
            text-decoration: none;
        }

        .container-blog::-webkit-scrollbar {
            margin-left: -20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-transparent">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="landingpage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="landingPage.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="landingPage.php#packages">Packages</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link login-btn" href="landingpage.php"><i class="fas fa-user-circle"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-blog">
        <div class="container">
            <div class="row">
                <?php
                include 'config.php';
                $sql = "SELECT * FROM blog";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="imgbox">
                                    <img src="super-admin-panel/uploads/<?php echo $row['image']; ?>"
                                        alt="<?php echo $row['title']; ?>" />
                                </div>
                                <div class="content">
                                    <h2>
                                        <?php echo $row['title']; ?>
                                    </h2>
                                    <p>
                                        <?php echo $row['content']; ?>
                                    </p>
                                </div>
                                <a <?php echo 'href="blogDetails.php?id=' . $row['uid'] . '"'; ?>
                                    class="btn-read-more">Read More</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No Blog available";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>



<?php
// Close the database connection
mysqli_close($conn);
?>