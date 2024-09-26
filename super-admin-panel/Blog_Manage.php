<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksdesign";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $uid = $_POST['uid'];
        $deleteQuery = "DELETE FROM blog WHERE uid = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        $uid = $_POST['uid'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_POST['image'];

        $updateQuery = "UPDATE blog SET title=?, content=?, image=? WHERE uid=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssi", $title, $content, $image, $uid);
        $stmt->execute();
        $stmt->close();
    }
}

$query = "SELECT * FROM blog";
$result = $conn->query($query);



$records_per_page = 10;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

$offset = ($current_page - 1) * $records_per_page;

$sql = "SELECT * FROM blog WHERE uid LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

$total_records_sql = "SELECT COUNT(*) FROM blog WHERE uid";
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
    <title>Blog Manage</title>
    <style>
        body {
            font-family: "Barlow", sans-serif;
            font-weight: normal;
            font-style: normal;
            color: #64544B;
            background-color: #BEDCEE;
        }

        #contents {
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
            width: calc(100% - 20px);
            white-space: nowrap;
            table-layout: fixed;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #gray;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            white-space: nowrap;
            padding: 12px;
            text-align: left;
            border: 1px solid #C9C1BD;
        }

        th {
            font-size: 18px;
            background-color: #64544B;
            color: white;
        }

        tr {
            width: 70%;
        }

        tr:hover {
            background-color: #96BBD0;
        }

        td {
            color: black;
        }

        .btn {
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            display: inline-block;
            padding: 8px 16px;
            cursor: pointer;
            border: 1px solid #42535D;
            color: #fff;
            background-color: #42535D;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #fff;
            color: #42535D;
            border-color: #42535D;
        }

        .btn.delete {
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            display: inline-block;
            padding: 8px 16px;
            cursor: pointer;
            border: 1px solid #99352E;
            color: #fff;
            background-color: #f44336;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
        }

        .btn.delete:hover {
            background-color: #FFD6D3;
            color: #99352E;
            border-color: #99352E;
        }

        .form-control {
            width: 100%;
            padding: 7px;
            border: 1px solid #42535D;
            box-sizing: border-box;
        }

        #editForm {
            font-family: "Barlow", sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #42535D;
            padding-left: 20px;
            margin: 20px;
            display: none;
            margin-top: 20px;
            border: 1px solid #42535D;
            background-color: #96BBD0;
        }

        #editForm h2 {
            font-family: "Quattrocento", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            color: #42535D;
            text-align: center;
            margin-left: 30px;
            margin-bottom: 30px;
            margin-top: 40px;
        }

        input,textarea {
            font-family: "Barlow", sans-serif;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            background: #BEDCEE;
            border: 1px solid #42535d;
            box-sizing: border-box;
            color: #42535D;
        }

        input[type="text"],textarea[name="content"] {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            border: 1px solid #42535d;
        }

        .updatebtn {
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            display: inline-block;
            padding: 8px 16px;
            margin-top: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            border: 1px solid #42535D;
            color: #fff;
            background-color: #42535D;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
        }

        .updatebtn:hover {
            background-color: #fff;
            color: #42535D;
            border-color: #42535D;
        }
    </style>
</head>
<body>
    <div id="bolg-info" class="section">
        <div id="contents">
            <h2>Blog Manage</h2>
            <table id="userTable">
                <tr>
                    <th>UID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['uid']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['content']); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
                                    <input type="hidden" name="delete" value="1">
                                    <button type="submit" class="btn delete">Delete</button>
                                </form>
                                <button class="btn"
                                    onclick="editBlog('<?php echo $row['uid']; ?>', 
                                    '<?php echo htmlspecialchars($row['title']); ?>', 
                                    '<?php echo htmlspecialchars($row['content']); ?>', 
                                    '<?php echo htmlspecialchars($row['image']); ?>')">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; 
                ?>
            </table>

            <!-- Pagination -->
            <div style="margin-top: 20px; padding: 10px;  background-color: ; display: inline-block;">
                <span
                    style="font-size: 16px; font-weight: 700; margin-right: 10px; padding: 8px; border: 2px solid #42535D; color:black">Page Number:</span>
                <?php
                // Display pagination links
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<a href='Blog_Manage.php?page={$page}' style='padding: 8px; margin-right: 5px; text-decoration: none; font-weight: 700; color: #42535D; border: 2px solid #42535D;'>{$page}</a>";
                }
                ?>
            </div>

            <div id="editForm">
                <h2>Edit Blog</h2>
                <form method="post">
                    <input type="hidden" name="uid" id="uid">
                    
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                    
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" class="form-control" required></textarea>
                    
                    <label for="image">Image:</label>
                    <input type="text" name="image" id="image" class="form-control" required>
                    
                    <input type="hidden" name="update" value="1">
                    <button type="submit" class="updatebtn">Update Blog</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function editBlog(uid, title, content, image) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('uid').value = uid;
            document.getElementById('title').value = title;
            document.getElementById('content').value = content;
            document.getElementById('image').value = image;

            // Scroll to the edit form
            window.scrollTo({
                top: document.getElementById('editForm').offsetTop,
                behavior: 'smooth'
            });
        }
    </script>

</body>
</html>



<?php
$conn->close();
?>