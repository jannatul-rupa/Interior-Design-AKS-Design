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

// Check if the blog ID is provided in the URL
if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];

    // Retrieve the blog details from the database
    $sql = "SELECT * FROM blog WHERE uid = $blog_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $content = $row['content'];
    } else {
        // Redirect to the blog page if blog not found
        $blogPageURL = "blogPage.php";
        header("Location: $blogPageURL");
        exit();
    }
} else {
    // Redirect to the blog page if blog ID is not provided
    $blogPageURL = "blogPage.php";
    header("Location: $blogPageURL");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - AKS</title>
    <link rel="favicon icon" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: "Barlow", sans-serif;
            background: linear-gradient(135deg, #6AD1DF, #F3E6C7);
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            background: linear-gradient(135deg, #6AD1DF, #F3E6C7);
        }

        .navbar {
            position: fixed;
            top: 10px;
            right: 10px;
            left: 10px;
            z-index: 1030;
            background-color: rgba(0, 123, 255, 0.9);
        }

        .navbar .navbar-brand {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s;
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

        .blog-details {
            padding: 40px;
            flex: 1;
            margin-top: 100px;
        }

        .blog-content {
            background-color: #141414;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
        }

        .blog-content h3 {
            padding-top: 20px;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #e9e4e4;
        }

        .blog-content p {
            font-size: 1.2rem;
            color: #fff;
        }

        .imgbox {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .btn-primary {
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
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #fff;
            color: #55443a;
            border-color: #55443a;
        }

        footer {
            color: #fff;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .navbar .nav-link {
            color: #000 !important;
        }
        .blog-content {
            background-color: rgba(20, 20, 20, 0.5);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-transparent">
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

    <div class="container blog-details">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="blog-content">
                    <div class="imgbox">
                        <img src="super-admin-panel/uploads/<?php echo $row['image']; ?>"
                            alt="<?php echo $row['title']; ?>" />
                    </div>
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $content; ?></p>
                </div>
                <a href="blogPage.php" class="btn-primary">Back to Blog</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 AKS DESIGN All rights reserved.</p>
            <p>Sylhet, Bangladesh</p>
        </div>
    </footer>

</body>
</html>