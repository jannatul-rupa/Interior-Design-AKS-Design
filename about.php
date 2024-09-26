
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
    <!-- Home Section Start -->
    <section>
        <div>
            <img src="images/about/about-3.jpg">
            <h3 class="about-title mt-90 ml-70 mr-70">WHY CHOOSE US</h3>
            <p class="mt-30 ml-70 mr-70">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p> 
            <p class="mt-10 ml-70 mr-70">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>                                            
        </div>
    </section>

    <!-- Home Section End -->
       




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

</body>
</html>