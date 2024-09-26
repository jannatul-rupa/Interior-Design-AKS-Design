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
            background: #55443a;
            z-index: 2000;
            transition: 0.3s ease;
            overflow-x: hidden;
            scrollbar-width: none;
        }

        #sidebar::--webkit-scrollbar {
            display: none;
        }

        #sidebar.hide {
            width: 60px;
        }

        #sidebar .brand {
            font-family: "Quattrocento", sans-serif;
            font-size: 24px;
            font-weight: 700;
            height: 56px;
            display: flex;
            align-items: center;
            margin-top: 30px;
            color: #2B2523;
            position: sticky;
            top: 0;
            left: 0;
            background: #64544B;
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
            margin-top: 40px;
        }

        #sidebar .side-menu li {
            height: 50px;
            background: transparent;
            padding: 1px;
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
            background: #64544B;
            display: flex;
            align-items: center;
            border: 1px solid #55443a;
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
            margin-top: 70px;
            color: #fff;
        }

        #sidebar .side-menu li a.logout:hover {
            background-color: #fff;
            color: #55443a;
            border-color: #55443a;
        }

        #sidebar .side-menu.top li a:hover {
            color: #55443a;
            background: #fff;
            border-color: #55443a;
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
        <a href="/aksdesign/admin-panel/admin_dashboard.php" class="brand">
            <i class="fa-solid fa-paint-roller"></i>
            <span class="text">AKS Design</span>
        </a>
        <ul class="side-menu top">
            <li >
                <a href="/aksdesign/admin-panel/admin_dashboard.php">
                    <i class="fa-brands fa-microsoft"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/admin-panel/orderInfo.php">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span class="text">Order Information</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/admin-panel/order_done.php">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <span class="text">Completed Order</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/admin-panel/adminInfo.php">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="text">Admin Information</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/admin-panel/UserInfo.php">
                    <i class="fa-solid fa-users"></i>
                    <span class="text">User Information</span>
                </a>
            </li>
            <li>
                <a href="/aksdesign/admin-panel/reported_user.php">
                    <i class="fa-solid fa-users-slash"></i>
                    <span class="text">Reported User</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/aksdesign/admin-panel/logout.php" class="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
</body>
</html>