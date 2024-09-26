<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksdesign";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    $upload_dir = "C:/xampp/htdocs/aksdesign/super-admin-panel/uploads/";
    $target_file = $upload_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $image_name = basename($_FILES["image"]["name"]);

    if ($_FILES["image"]["name"]) {
        
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }
        
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $target_file = $upload_dir . $image_name;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "Please select an image file.";
        exit();
    }

    $sql = "INSERT INTO blog (title, content, image) VALUES ('$title', '$content', '$image_name')";

    if (mysqli_query($conn, $sql)) {
        echo "Blog post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

include('superAdminSidebar.php');
?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <style>
        html {
            overflow-x: hidden;
        }

        body {
            font-family: "Barlow", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #BEDCEE;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-wrap {
            width: 600px;
            padding: 30px 20px;
            background: #96BBD0;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        label {
            display: block;
            margin-bottom: 10px;
        }

        input,textarea {
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

        input[type="text,content"],
        textarea[type="text,content"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #42535d;
        }

        input[type="file"] {
            margin-bottom: 30px;
            color: #42535d;
        }

        input[type="submit"] {
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            padding: 10px;
            background-color: #42535d;
            border: 1px solid #42535d;
            color: #BEDCEE;
        }

        input[type="submit"]:hover {
            color: #42535d;
            background-color: #BEDCEE;
        }

        ::placeholder {
            color: #42535D;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-wrap">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <h1>Create Blog</h1>
                <input type="text" name="title" placeholder="Service Title" required>
                <textarea name="content" placeholder="Description" rows="5" required></textarea>
                <input type="file" name="image" id="image" accept="image/*">
                <input type="submit" value="Create Now">
            </form>
        </div>
    </div>
</body>
</html>



<?php
mysqli_close($conn);
?>