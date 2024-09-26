<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100%;
            background: #42535D;
            z-index: 2000;
            transition: 0.3s ease;
            overflow-x: hidden;
            scrollbar-width: none;
        }

        #sidebar::--webkit-scrollbar {
            display: none;
        }

        #sidebar.hide {
            width: 50px;
        }

        #sidebar .brand {
            font-family: "Quattrocento", sans-serif;
            font-size: 24px;
            font-weight: 700;
            height: 56px;
            display: flex;
            align-items: center;
            margin-top: 20px;
            color: #1A2733;
            position: sticky;
            top: 0;
            left: 0;
            background: #5C707C;
            z-index: 500;
            padding-bottom: 20px;
            padding-top: 20px;
            box-sizing: content-box;
        }

        #sidebar .brand i {
            min-width: 90px;
            display: flex;
            justify-content: center;
        }

        #sidebar .side-menu {
            width: 100%;
            margin-top: 30px;
            margin-bottom: 40px;
        }

        #sidebar .side-menu li {
            height: 45px;
            background: transparent;
            padding: 1.5px;
        }

        #sidebar .side-menu li.active {
            background: #f3e6c7;
            position: relative;
        }

        #sidebar .side-menu li.active::before {
            content: "";
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            top: -40px;
            right: 0;
            box-shadow: 20px 20px 0 #f3e6c7;
            z-index: -1;
        }

        #sidebar .side-menu li.active::after {
            content: "";
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            bottom: -40px;
            right: 0;
            box-shadow: 20px -20px 0 #f3e6c7;
            z-index: -1;
        }

        #sidebar .side-menu li a {
            font-family: "Barlow", sans-serif;
            font-weight: 600;
            width: 100%;
            height: 100%;
            background: #5C707C;
            display: flex;
            align-items: center;
            border: 1px solid #5C707C;
            font-size: 18px;
            color: #fff;
            white-space: nowrap;
            overflow-x: hidden;
        }

        #sidebar .side-menu.top li.active a {
            color: #55443a;
        }

        #sidebar.hide .side-menu li a {
            width: calc(48px - (4px * 2));
            transition: width 0.3s ease;
        }

        #sidebar .side-menu li a.logout {
            color: #fff;
        }

        #sidebar .side-menu li a.logout:hover {
            background-color: #fff;
            color: #5C707C;
            border-color: #5C707C;
        }

        #sidebar .side-menu.top li a:hover {
            color: #5C707C;
            background: #fff;
            border-color: #5C707C;
        }

        #sidebar .side-menu li a i {
            min-width: calc(60px - ((4px + 6px) * 2));
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <section id="sidebar">
        <a href="/aksdesign/super-admin-panel/superAdminDashboard.php" class="brand">
            <i class="fa-solid fa-paint-roller"></i>
            <span class="text">AKS Design</span>
        </a>
        <ul class="side-menu top">
            <li >
                <a href="/aksdesign/super-admin-panel/superAdminDashboard.php">
                    <i class="fa-brands fa-microsoft"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/createBlog.php">
                    <i class="fa-solid fa-file-contract"></i>
                    <span class="text">Create Blog</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/Blog_Manage.php">
                    <i class="fa-solid fa-file-signature"></i>
                    <span class="text">Blog Manage</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/userInfo.php">
                    <i class="fa-solid fa-users"></i>
                    <span class="text">User Information</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/violatedUser.php">
                    <i class="fa-solid fa-users-slash"></i>
                    <span class="text">Violated User</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/createAdmin.php">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="text">Create Admin</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/adminInfo.php">
                    <i class="fa-solid fa-user-tie"></i>                    
                    <span class="text">Admin Information</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/reportedAdmin.php">
                    <i class="fa-solid fa-user-xmark"></i>
                    <span class="text">Reported Admin</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/super-admin-panel/violatedAdmin.php">
                    <i class="fa-solid fa-user-slash"></i>
                    <span class="text">Violated Admin</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
</body>
</html>