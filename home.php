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
// include 'slider_content.php'; 
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Fetch user profile details
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    $user_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
}
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
	<link rel="icon" href="../ddt/image/favicon.ico" type="image/x-icon">

</head>
<body>

    <?php include 'components/user_header.php'; ?>

<!-- Home slider start -->
<div class="slider-container">
    <div class="slide">
        <!-- Slide start -->
        <div class="slideBox active"> <!-- First slide gets the 'active' class by default -->
    <div class="textBox">
        <span>committed to excellence</span>
        <h1>personalize and <br> comfortable</h1>
        <div class="card">
            <div class="box">
                <div><img src="image/icon (11).png" alt="Full Protection"></div>
                <div>
                    <h2>Full Protection</h2>
                    <p>Our certified professionals are dedicated to <br> offering expert solutions for your needs.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div><img src="image/icon (5).png" alt="Tailored Solutions"></div>
            <div>
                <h2>Tailored Solutions</h2>
                <p>We provide custom services designed to fit your <br> specific requirements, ensuring the perfect outcome every time.</p>
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
        <h1>customized for <br> your comfort</h1>
        <div class="card">
            <div class="box">
                <div><img src="image/icon (12).png" alt="Quality assurance"></div>
                <div>
                    <h2>Quality assurance</h2>
                    <p>We guarantee high-quality results with every service<br>  we provide, meeting the highest industry standards.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div><img src="image/icon (6).png" alt="Comprehensive support"></div>
            <div>
                <h2>Comprehensive support</h2>
                <p>Our services offer full support, from start to finish, <br> ensuring that every step is taken care of with expertise.</p>
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
        <h1>personalized for <br> your needs</h1>
        <div class="card">
            <div class="box">
                <div><img src="image/icon (10).png" alt="Expert team"></div>
                <div>
                    <h2>Expert team</h2>
                    <p>Our team of experienced professionals is here to guide<br>  you with specialized solutions and advice.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div><img src="image/icon (7).png" alt="Complete care"></div>
            <div>
                <h2>Complete care</h2>
                <p>We take full responsibility for your service, ensuring complete care<br>  and attention to every detail throughout the process.</p>
            </div>
        </div>
        <div class="flex-btn">
            <a href="service.php" class="btn">view our service</a>
            <a href="service.php" class="btn">book appointment</a>
        </div>
    </div>
</div>
<!-- Slide end -->

        <!-- Slide end -->
    </div>

    <!-- Controls for manual navigation -->
    <ul class="controls">
        <li onclick="nextSlide();" class="next"><i class="bx bx-right-arrow-alt"></i></li>
        <li onclick="prevSlide();" class="prev"><i class="bx bx-left-arrow-alt"></i></li>
    </ul>
</div>
<!-- Home slider end -->

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slideBox');
    const totalSlides = slides.length;

    // Function to show the next slide
    function nextSlide() {
        // Remove active class from the current slide
        slides[currentSlide].classList.remove('active');
        // Move to the next slide
        currentSlide = (currentSlide + 1) % totalSlides;
        // Add active class to the new slide
        slides[currentSlide].classList.add('active');
    }

    // Function to show the previous slide
    function prevSlide() {
        // Remove active class from the current slide
        slides[currentSlide].classList.remove('active');
        // Move to the previous slide
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        // Add active class to the new slide
        slides[currentSlide].classList.add('active');
    }

    // Start the timer to automatically change slides
    window.onload = function() {
        setInterval(nextSlide, 3000); // Change slides every 3 seconds
    };

    // Optional: Add event listeners for manual navigation buttons
    document.querySelector('.next').addEventListener('click', nextSlide);
    document.querySelector('.prev').addEventListener('click', prevSlide);
</script>




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
                    <h2>Choose Schedule</h2>
                    <p>Get an appointment in a few clicks</p>
                </div>
                
                <div class="card">
                    <img src="image/ab-icon2.png">
                    <h2>Get Appointment</h2>
                    <p>Get an appointment in a few clicks</p>
                </div>
            </div>
        </div>
        <div class="box">
            <h1>About Our Clinic</h1>
            <p>Our clinic’s primary objective is to ensure long-term success for your dental health. We are dedicated to providing exceptional service while maintaining a focus on safety and comfort. Our experienced team is here to guide you towards achieving optimal dental health with personalized care.</p>
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
        <h1>Relax.. Your Dentist Knows Best</h1>
        <div class="box">
            <div class="img-box">
                <img src="image/icon (8).png">
            </div>
            <div>
                <h2>Dental Hygiene – Never Forget!</h2>
                <p>Proper dental hygiene is key to preventing long-term oral health issues. Brush twice daily and floss regularly.</p>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="image/icon (9).png">
            </div>
            <div>
                <h2>Don't Rush When You Brush</h2>
                <p>Take your time while brushing, ensuring every tooth is clean and free from plaque.</p>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="image/icon (10).png">
            </div>
            <div>
                <h2>Visit Your Dentist Once in 6 Months</h2>
                <p>Routine checkups are essential for maintaining your oral health and identifying potential problems early.</p>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="image/icon (8).png">
            </div>
            <div>
                <h2>Dental Hygiene – Never Forget!</h2>
                <p>Proper dental hygiene is key to preventing long-term oral health issues. Brush twice daily and floss regularly.</p>
            </div>
        </div>
    </div>
</div>

<!--  -->

<div class="service">
    <div class="box-container">
        <div class="box">
            <div><img src="image/contact-icon (4).png"></div>
            <div class="detail">
                <h1>General Dentistry</h1>
                <p>Comprehensive care to keep your teeth and gums healthy, including exams, cleanings, and preventive treatments.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon2.png"></div>
            <div class="detail">
                <h1>Dental Filling</h1>
                <p>Restorative solutions for cavities and decay, ensuring your teeth remain functional and beautiful.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon6.png"></div>
            <div class="detail">
                <h1>Dental Implants</h1>
                <p>A permanent solution to replace missing teeth, offering a natural appearance and improved function.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon.png"></div>
            <div class="detail">
                <h1>Dental Surgery</h1>
                <p>Specialized treatments for more complex dental issues, including extractions and corrective surgeries.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon0.png"></div>
            <div class="detail">
                <h1>Dental Alignment</h1>
                <p>Braces and other alignment solutions to correct misalignments and achieve a perfect smile.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon5.png"></div>
            <div class="detail">
                <h1>Dental Whitening</h1>
                <p>Professional whitening treatments to brighten your smile and remove stains.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon1.png"></div>
            <div class="detail">
                <h1>Teeth Braces</h1>
                <p>Straighten your teeth effectively with a customized orthodontic treatment plan.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon4.png"></div>
            <div class="detail">
                <h1>Teeth Protection</h1>
                <p>Preventive care to protect your teeth from damage, including sealants and mouthguards.</p>
            </div>
        </div>
        <div class="box">
            <div><img src="image/service-icon3.png"></div>
            <div class="detail">
                <h1>Prosthetics</h1>
                <p>Restorative options for missing or damaged teeth, such as crowns, bridges, and dentures.</p>
            </div>
        </div>
    </div>
</div>




    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script type="text/javascript" src="/js/user_script.js"></script>

    <?php include '../ddt/components/alert.php'; ?>
</body>
</html>