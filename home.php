<?php 
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

$select_service = $conn->prepare("SELECT * FROM `services`");
$select_service->execute();
$fetch_service_count = $select_service->rowCount(); 

$select_employee = $conn->prepare("SELECT * FROM `employee`");
$select_employee->execute();
$fetch_employee_count = $select_employee->rowCount(); 

$select_appointment = $conn->prepare("SELECT * FROM `appointments`"); 
$select_appointment->execute();
$fetch_appointment = $select_appointment->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Dental Clinic Website</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
	<link rel="icon" href="../image/favicon.ico" type="image/x-icon">

</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <!-- Home slider start -->
    <div class="slider-container">
        <div class="slide">
            <!-- Slide start -->
            <div class="slideBox">
                <div class="textBox">
                    <span>committed to excellence</span>
                    <h1>personalize and <br> comfortable</h1>
                    <div class="card">
                        <div class="box">
                            <div><img src="image/icon (11).png" alt=""></div>
                            <div>
                                <h2>full protection</h2>
                                <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div><img src="image/icon (12).png" alt=""></div>
                            <div>
                                <h2>Complete service</h2>
                                <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-btn">
                        <a href="service.php" class="btn">view our service</a>
                        <a href="service.php" class="btn">book appointment</a>
                    </div>
                </div>
            </div>
            <!-- Slide end -->

            <!-- Slide start -->
            <div class="slideBox">
                <div class="textBox">
                    <span>committed to excellence</span>
                    <h1>personalize and <br> comfortable</h1>
                    <div class="card">
                        <div class="box">
                            <div><img src="image/icon (4).png" alt=""></div>
                            <div>
                                <h2>full protection</h2>
                                <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
 </div>
                        <div class="box">
                            <div><img src="image/icon (5).png" alt=""></div>
                            <div>
                                <h2>Complete service</h2>
                                <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-btn">
                        <a href="service.php" class="btn">view our service</a>
                        <a href="service.php" class="btn">book appointment</a>
                    </div>
                </div>
            </div>
            <!-- Slide end -->

            <!-- Slide start -->
            <div class="slideBox">
                <div class="textBox">
                    <span>committed to excellence</span>
                    <h1>personalize and <br> comfortable</h1>
                    <div class="card">
                        <div class="box">
                            <div><img src="image/icon (1).png" alt=""></div>
                            <div>
                                <h2>full protection</h2>
                                <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div><img src="image/icon (2).png" alt=""></div>
                            <div>
                                <h2>Complete service</h2>
                                <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-btn">
                        <a href="service.php" class="btn">view our service</a>
                        <a href="service.php" class="btn">book appointment</a>
                    </div>
                </div>
            </div>
            <!-- Slide end -->
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"><i class="bx bx-right-arrow-alt"></i></li>
            <li onclick="prevSlide();" class="prev"><i class="bx bx-left-arrow-alt"></i></li>
        </ul>
    </div>
    <!-- Home slider end -->

    <div class="about-us">
        <div class="box-container">
            <div class="box">
                <div class="container">
                    <div class="card">
                        <img src="image/ab-icon.png">
                        <h2>easy booking</h2>
                        <p>Get an appointment in a few clicks</p>
                    </div>
                    <div class="card">
                        <img src="image/ab-icon0.png">
                        <h2>easy booking</h2>
                        <p>Get an appointment in a few clicks</p>
                    </div>
                    <div class="card">
                        <img src="image/ab-icon1.png">
                        <h2>easy booking</h2>
                        <p>Get an appointment in a few clicks</p>
                    </div>
                    <div class="card">
                        <img src="image/ab-icon2.png">
                        <h2>easy booking</h2>
                        <p>Get an appointment in a few clicks</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <h1>about our clinic</h1>
                <p>Our main long-term goal is always achieving complex result for your dental health.
                    But in the process, we also keep the focus on giving you the best customer services.
                    We're always making our dental office as safe a place as possible!
                </p>
                <div class="box-card">
                    <img src="image/about-us.jpg">
                    <div class="detail"> 
                        <h2>Dr. Richard Smith</h2>
                        <span>Head Doctor, Orthodontist</span>
                        <p>I am a dedicated dental specialist with 20 years of experience trained in diagnosing and treating orthodontic and periodontal issues.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relax-container">
        <div class="detail">
            <h1>Relax..your Dentist Knows Best</h1>
            <div class="box">
                <div class="img-box">
                    <img src="image/icon (8).png">
                </div>
                <div>
                    <h2>dental hygiene never forget!</h2>
                    <p>Duas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia</p>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="image/icon (9).png">
                </div>
                <div>
                    <h2>Don't rush when you brush</h2>
                    <p>Duas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia</p>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="image/icon (10).png">
                </div>
                <div>
                    <h2>visit your dentist once in 6 months</h2>
                    <p>Duas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia</p>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="image/icon (8).png">
                </div>
                <div>
                    <h2>dental hygiene never forget!</h2>
                    <p>Duas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia</p>
                </div>
            </div>
        </div>
    </div>

    <div class="kids">
        <div class="box-contain">
            <div class="box">
                <div class="heading">
                    <h1>kids oral care</h1>
                    <p>Efficiently enable enabled sources and cost effective products. Completely synthesize principle-centered information</p>
                </div>
                <div class="box-card">
                    <div class="card">
                        <img src="image/dental.png">
                        <h2>brushing</h2>
                        <p>Dynamically target high payoff capital for technologies</p>
                    </div>
                    <div class="card">
                        <img src="image/nutrition.png">
                        <h2>nutrition</h2>
                        <p>Dynamically target high payoff capital for technologies</p>
                    </div>
                    <div class="card">
                        <img src="image/ab-icon2.png">
                        <h2>checkup</h2>
                        <p>Dynamically target high payoff capital for technologies</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/kid.png" class="img">
            </div>
        </div>
    </div>

    <div class="service">
        <div class="box-container">
            <div class="box">
                <div><img src="image/contact-icon (4).png"></div>
                <div class="detail">
                    <h1>general Dentistry</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon2.png"></div>
                <div class="detail">
                    <h1>dental filling</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon6.png"></div>
                <div class="detail">
                    <h1>dental implants</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon.png"></div>
                <div class="detail">
                    <h1>dental surgery</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon0.png"></div>
                <div class="detail">
                    <h1>dental alignment</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon5.png"></div>
                <div class="detail">
                    <h1>dental whitening</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon1.png"></div>
                <div class="detail">
                    <h1>teeth braces</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon4.png"></div>
                <div class="detail">
                    <h1>teeth protection</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
            <div class="box">
                <div><img src="image/service-icon3.png"></div>
                <div class="detail">
                    <h1>prothesis</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="care-container">
        <div class="detail">
            <h1>take care of your teeth & gums</h1>
            <p>Researchers have found that people with gum disease are almost twice as likely to suffer from coronary heart disease...</p>
            <p><i class="bx bx-circle"></i>Aenean posuere sem imperdiet</p>
            <p><i class="bx bx-circle"></i>Sed semper lorem sit amet ultrices mollis.</p>
            <p><i class="bx bx-circle"></i>Vivamus vehiculus diam ut velit lacinia</p>
            <p><i class="bx bx-circle"></i>proin condimentum nibh ut orci retrum convallis</p>
            <p><i class="bx bx-circle"></i>Pellentesque sed mi in ipsm tempus pharetra</p>
            <p><i class="bx bx-circle"></i>Aenean posuere sem imperdiet, vivera quam</p>
        </div>
    </div>

    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script type="text/javascript" src="/js/user_script.js"></script>

    <?php include '/components/alert.php'; ?>
</body>
</html>