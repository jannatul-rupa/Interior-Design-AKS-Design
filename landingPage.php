<?php

session_start();
$isLoggedIn = false;
$username = "";


if (isset($_SESSION['id'])) {
    $isLoggedIn = true;
    if (isset($_SESSION['name'])) {
        $username = $_SESSION['name'];
    }
}


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}


$servername = "localhost";
$db_username = "root";
$password = "";
$database = "aksdesign";


// Create connection
$conn = new mysqli($servername, $db_username, $password, $database);




function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name_err = $address_err = $contact_number_err = $details_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and sanitize form inputs
    $name = !empty($_POST["Name"]) ? sanitize_input($_POST["Name"]) : $name_err = "Name is required";
    $address = !empty($_POST["Address"]) ? sanitize_input($_POST["Address"]) : $address_err = "Address is required";
    $contact_number = !empty($_POST["contact_number"]) ? sanitize_input($_POST["contact_number"]) : $contact_number_err = "Contact number is required";
    $package_name = !empty($_POST["package_name"]) ? sanitize_input($_POST["package_name"]) : "Unknown Package";
    $details = !empty($_POST["Details"]) ? sanitize_input($_POST["Details"]) : $details_err = "Details are required";

    // Check for any input errors
    if (empty($name_err) && empty($address_err) && empty($contact_number_err) && empty($details_err)) {
        $sql = "INSERT INTO orders (name, address, contact_number, package_name, details) VALUES ('$name', '$address', '$contact_number', '$package_name', '$details')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        if (!empty($name_err)) {
            echo "<script>alert('Error: $name_err');</script>";
        }
        if (!empty($address_err)) {
            echo "<script>alert('Error: $address_err');</script>";
        }
        if (!empty($contact_number_err)) {
            echo "<script>alert('Error: $contact_number_err');</script>";
        }
        if (!empty($details_err)) {
            echo "<script>alert('Error: $details_err');</script>";
        }
    }

    // Close connection
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AKS Design</title>
    <link rel="favicon icon" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/landingPageStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header Section Start -->
    <section id="home" class="home-area">
        <div class="navigation-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                                <img src="images/logo.png" alt="Logo">
                            </a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto pl-125">
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#service">Service</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#project">Projects</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#packages">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#team">Our Team</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="navbar-btn d-flex align-items-center">
                                <?php if ($isLoggedIn): ?>
                                    <span class="navbar-text mr-2"
                                        style="background-color: rgba(255, 255, 255, 0.1); padding: 5px; border-radius: 5px; margin-right: 10px; color: white;"><?php echo htmlspecialchars($username); ?></span>
                                    <!-- If logged in, display logout button -->
                                    <form method="post" class="d-flex">
                                        <button type="submit" name="logout" class="main-btn">Logout</button>
                                    </form>
                                <?php else: ?>
                                    <!-- If not logged in, displaying Login/Registration button -->
                                    <form class="d-flex">
                                        <button class="main-btn" type="button"
                                            onclick="redirectToIndex()">Registration</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-banner d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-9 col-sm-10">
                        <div class="banner-content">
                            <h4>Your Faithful</h4>
                            <h1>Let's Make Your <b>Interior</b> More Beautiful!</h1>
                            <p class="banner-contact">AKS Design</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-image bg_cover" style="background-image: url(images/header/header-image-1.jpg"></div>
        </div>
    </section>

    <!-- Header Section End -->





    <!-- About Section Start -->

    <section id="about" class="about-area pt-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-image">
                        <div class="single-image float-left">
                            <img src="images/about/about-1.jpg">
                        </div>
                        <div class="single-image image-tow float-right">
                            <img src="images/about/about-2.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content mt-50">
                        <h5 class="about-welcome">About Us</h5>
                        <h3 class="about-title mt-10">Why choose us</h3>
                        <p class="mt-25">There are many variations of passages of Lorem Ipsum available, but the
                            majority have suffered alteration in some form, by injected humour, or randomised words
                            which don't look even slightly believable.
                            <br> <br>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                            anything embarrassing hidden in the middle of text.
                        </p>
                        <a class="main-btn mt-25" href="about.php">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section End -->





    <!-- Services Section Start -->

    <section id="service" class="services-area pt-125 pb-130 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h5 class="sub-title mb-15">Our Services</h5>
                        <h2 class="title">We Help you make Modern Interior</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30">
                        <div class="services-icon">
                            <i class="fa-brands fa-microsoft"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">Interior Design</h4>
                            <p class="mt-20">Mauris aliquam, turpis sed mattis placerat, justo risus pellentesque quam, id finibus risus arcu eget neque.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30">
                        <div class="services-icon">
                            <i class="fa-brands fa-microsoft"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">Design Consultancy</h4>
                            <p class="mt-20">It is a long established fact that a reader will be distracted by the readable content of a page when look.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30">
                        <div class="services-icon">
                            <i class="fa-brands fa-microsoft"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">Residential Design</h4>
                            <p class="mt-20">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30">
                        <div class="services-icon">
                            <i class="fa-brands fa-microsoft"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">Commercial Design</h4>
                            <p class="mt-20">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam commodi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30">
                        <div class="services-icon">
                            <i class="fa-brands fa-microsoft"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">Hospitality Design</h4>
                            <p class="mt-20">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30">
                        <div class="services-icon">
                            <i class="fa-brands fa-microsoft"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">Co-working Space Design</h4>
                            <p class="mt-20">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section End -->





    <!-- Blog Section Start -->

    <section id="project" class="project-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-50">
                        <h5 class="sub-title mb-15">Featured Works Blog</h5>
                        <h2 class="title">By Our Successful Designers</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row project-active">
                <div class="col-lg-4">
                    <div class="single-project">
                        <div class="project-image">
                            <img src="images/project/project-1.jpg">
                        </div>
                        <div class="project-content">
                            <a class="project-title" href="blogPage.php">Outdoor Decoration</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-project">
                        <div class="project-image">
                            <img src="images/project/project-2.jpg">
                        </div>
                        <div class="project-content">
                            <a class="project-title" href="blogPage.php">Home Decoration</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-project">
                        <div class="project-image">
                            <img src="images/project/project-3.jpg">
                        </div>
                        <div class="project-content">
                            <a class="project-title" href="blogPage.php">Office Decoration</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section End -->





    <!-- Package Section Start -->

    <section id="packages" class="project-area pt-125 pb-130 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-50">
                        <h5 class="sub-title mb-15">Pricing</h5>
                        <h2 class="title">Choose a package for your dream place</h2>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="portfolio-card">
                                <h2>Home Decoration</h2>
                                <p>The finishing touches to refresh your space, handpicked by experts.</p>
                                <p class="price">6,700/Room</p>
                                <ul>
                                    <li>1–2 weeks design time with 30 days project support,</li>
                                    <li>Spatial and lighting plans & Tiny homes/van fit-outs.</li>
                                </ul>
                                <button onclick="openForm('Home Decoration'); return false;">Select</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="portfolio-card">
                                <h2>Outdoor Decoration</h2>
                                <p>Expert sourcing of furnishings that fit and function within your outdoor.</p>
                                <p class="price">8,500/Space</p>
                                <ul>
                                    <li>7-10 days design time with 60 days post project support.</li>
                                    <li>Bespoke commercial projects by professionals.</li>
                                </ul>
                                <button onclick="openForm('Outdoor Decoration'); return false;">Select</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="portfolio-card">
                                <h2>Office Decoration</h2>
                                <p>Expert sourcing of furnishings that fit and function within your office.</p>
                                <p class="price">9,999/Room</p>
                                <ul>
                                    <li>2–4 weeks design time with 60 days post project support.</li>
                                    <li>Floor plan (spatial planning) & Setup guide.</li>
                                </ul>
                                <button onclick="openForm('Office Decoration'); return false;">Select</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section Start -->

    <section id="contact" class="contact-area pt-40 pb-130 gray-bg"
        style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="contact-form bg-color p-4">
                        <h5 class="sub-title mb-15">Order Form</h5>
                        <form id="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                            method="post" data-toggle="validator">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="Name" placeholder="Your Name"
                                            data-error="Name is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="contact_number" id="contact_number"
                                            placeholder="Your Phone" data-error="Phone is required."
                                            required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-form form-group">
                                        <input type="text" name="Address" placeholder="Your Address"
                                            data-error="Address is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-form form-group">
                                        <input type="text" id="Package-Name" name="package_name" readonly>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-form form-group">
                                        <textarea placeholder="Details" name="Details"
                                            data-error="Please, leave us a message." required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="single-form form-group text-center">
                                        <button type="submit" class="main-btn">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button class="main-btn" onclick="closeForm()" style="margin-top: 20px;">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function openForm(packageName) {
            document.getElementById('Package-Name').value = packageName;
            document.getElementById('contact').style.display = 'block';
        }

        function closeForm() {
            document.getElementById('contact').style.display = 'none';
        }
    </script>


    <style>
        .gray-bg-overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .contact-form {
            background-color: #ECD4B4;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            padding: 20px;
            margin: 20px;
            max-height: 80vh;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .vh-100 {
            height: 100vh;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .contact-form h1,
        .contact-form h2,
        .contact-form h3,
        .contact-form h4,
        .contact-form h5,
        .contact-form h6 {
            margin-bottom: 20px;
        }

        .contact-form input,
        .contact-form textarea,
        .contact-form button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .contact-form button {
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

        .contact-form button:hover {
            background-color: #fff;
            color: #55443a;
            border-color: #55443a;
        }

        .sub-title {
            text-align: center;
            font-size: 1.5em;
            color: #55443a;
            margin-bottom: 20px;
        }
    </style>

    <!-- Form Section End -->

    <!-- Package Section End -->





    <!-- Team Section Start -->

    <section id="team" class="team-area pt-125 pb-130 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h5 class="sub-title mb-15">Meet The Team</h5>
                        <h2 class="title">Our Expert Designers</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30">
                        <div class="team-image">
                            <img src="images/team/team-1.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a href="#">MD Ashraful Islam</a></h4>
                            <span class="sub-title">CEO & Founder</span>
                            <ul class="social mt-25">
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-messenger"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30 wow fadeInUp" data-wow-duration="1.5s"
                        data-wow-delay="0.8s">
                        <div class="team-image">
                            <img src="images/team/team-2.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a href="#">Aminul Haque</a></h4>
                            <span class="sub-title">COO & Chief Designer</span>
                            <ul class="social mt-25">
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-messenger"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30 wow fadeInUp" data-wow-duration="1.5s"
                        data-wow-delay="1.2s">
                        <div class="team-image">
                            <img src="images/team/team-3.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a href="#">Rizve Hasan Kakon</a></h4>
                            <span class="sub-title">Chief Designer</span>
                            <ul class="social mt-25">
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-messenger"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30 wow fadeInUp" data-wow-duration="1.5s"
                        data-wow-delay="1.6s">
                        <div class="team-image">
                            <img src="images/team/team-4.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a href="#">Md Abu Taher</a></h4>
                            <span class="sub-title">Consultant</span>
                            <ul class="social mt-25">
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-messenger"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section End -->





    <!-- Contact Us Section Start -->

    <section id="contact" class="contact-area pt-40 pb-130 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h5 class="sub-title mb-15">Contact Us</h5>
                        <h2 class="title">Get In Touch</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form-unique123">
                        <form id="contact-form" onsubmit="sendMail(event)">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-single-form-unique123 contact-form-group-unique123">
                                        <input type="text" id="name" name="name" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-single-form-unique123 contact-form-group-unique123">
                                        <input type="email" id="email" name="email" placeholder="Your Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-single-form-unique123 contact-form-group-unique123">
                                        <input type="text" id="subject" name="subject" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-single-form-unique123 contact-form-group-unique123">
                                        <input type="text" id="phone" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-single-form-unique123 contact-form-group-unique123">
                                        <textarea id="message" placeholder="Your Message" name="message"></textarea>
                                    </div>
                                </div>
                                <p class="contact-form-message-unique123"></p>
                                <div class="col-md-12">
                                    <div class="contact-single-form-unique123 contact-form-group-unique123 text-center">
                                        <button type="submit" class="main-btn">Send Mail</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function sendMail(event) {
            event.preventDefault();


            var name = encodeURIComponent(document.getElementById('name').value || 'No name provided');
            var email = encodeURIComponent(document.getElementById('email').value || 'No email provided');
            var subject = encodeURIComponent(document.getElementById('subject').value || 'No subject provided');
            var phone = encodeURIComponent(document.getElementById('phone').value || 'No phone provided');
            var message = encodeURIComponent(document.getElementById('message').value || 'No message provided');

            // Construct Gmail link
            var gmailLink = `https://mail.google.com/mail/?view=cm&fs=1&to=${email}&su=${subject}&body=Name:%20${name}%0D%0APhone:%20${phone}%0D%0AMessage:%20${message}`;


            window.open(gmailLink, '_blank');
        }
    </script>

    <!-- Contact Us Section End -->





    <!-- FAQ Section Start -->

    <section id="faq" class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">Why Us?</button>
            <div class="faq-answer">
                <p>We offer the best services at the most competitive prices, ensuring customer satisfaction.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">Where is the Office?</button>
            <div class="faq-answer">
                <p>Our office is located at 12/3 Ambarkhana, Sylhet Sadar, Bangladesh</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">How to do booking?</button>
            <div class="faq-answer">
                <p>You can book our services through our website Packages section and after that our admin will contact
                    with you</p>
            </div>
        </div>
    </section>

    <script>
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        }
    </script>

    <!-- FAQ Section End -->





    <!-- Footer Section Start -->

    <footer id="footer" class="footer-area">
        <div class="footer-widget pt-80 pb-130">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-8">
                        <div class="footer-logo mt-50">
                            <a href="#">
                                <img src="images/logo.png">
                            </a>
                            <ul class="footer-info">
                                <li>
                                    <div class="single-info">
                                        <div class="info-icon">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>Phone: +880 0000 000 000</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-info">
                                        <div class="info-icon">
                                            <i class="lni-envelope"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>Email: aks@mail.com</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-info">
                                        <div class="info-icon">
                                            <i class="lni-envelope"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>Location: Bangladesh</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-link mt-45">
                            <div class="f-title">
                                <h4 class="title">Essential</h4>
                            </div>
                            <ul class="mt-15">
                                <li><a href="#about">About</a></li>
                                <li><a href="#project">Project Blogs</a></li>
                                <li><a href="#packages">Packages</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-link mt-45">
                            <div class="f-title">
                                <h4 class="title">Services</h4>
                            </div>
                            <ul class="mt-15">
                                <li><a href="#project">Product Design</a></li>
                                <li><a href="#team">Research Team</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-link mt-45">
                            <div class="f-title">
                                <h4 class="title">Contact Us</h4>
                            </div>
                            <ul class="footer-social mt-20">
                                <li><a href="https://www.facebook.com/ashraful215"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://x.com/ashraful_215"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/md-ashraful-islam-talukdar-59370a1a9/"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="https://www.instagram.com/ashraful_215"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright text-center">
                            <p> Copyright, AKS Design 2024. All rights reserved. <a href="https://github.com/ashraful-215">Please Click Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer Section End -->





    <script>
        // JavaScript content
        function redirectToIndex() {
            window.location.href = "index.php";
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
    <script src="js/landingPageScript.js"></script>

</body>
</html>