<?php 
include 'components/connect.php';

$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : '';

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
	<link rel="icon" href="../ddt/image/favicon.ico" type="image/x-icon">
</head>
<body>

    <?php include 'components/user_header.php'; ?>

    <!-- Banner Section -->
    <div class="banner">
        <div class="detail">
            <h1>About Us</h1>
            <p>Welcome to DentiCare, your trusted partner in dental care. We are committed to providing top-notch oral health services to help you maintain a beautiful smile and optimal health.</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>About Us</span>
        </div>
    </div>

    <!-- About Section -->
    <div class="about">
        <div class="box-container">
            <div class="box">
                <span>About DentiCare</span>
                <h2>Where Expertise Meets Compassion in Your Journey</h2>
                <p>At DentiCare, we blend modern technology with compassionate care to offer you personalized dental treatments. Whether you're looking for routine checkups or advanced procedures, our team is provide the highest level of care and comfort.</p>
                <p>Our experienced professionals are here to help you with a wide range of dental services, all aimed at keeping your teeth healthy and your smile bright. We believe that preventive care is the key to maintaining a lifetime of oral health.</p>
            </div>
            <div class="box">
                <img src="image/about.avif" alt="About Image">
            </div>
        </div>
    </div>

    <!-- Dental & Oral Health Summit Section -->
    <div class="event">
        <div class="heading">
            <h1>The <span>Dental & Oral Health</span> Summit</h1>
            <p>Exploring Innovative Ideas in Dentistry</p>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/about.png" alt="Summit Image">
            </div>
            <div class="box">
                <h2>Current Research in Dental Health</h2>
                <p>The dental field is evolving rapidly, with new breakthroughs in oral health research emerging each year. From advancements in regenerative therapies to improved diagnostic tools, we are committed to integrating the latest findings to provide the best care for our patients.</p>
            </div>
        </div>
    </div>

    <!-- Oral Hygiene Section -->
    <div class="box-container">
        <div class="box">
            <h2>The Role of Mouthwash in Oral Hygiene</h2>
            <p>Good oral hygiene goes beyond just brushing and flossing. Mouthwash plays a crucial role in maintaining a clean mouth, preventing plaque buildup, and fighting bad breath. At DentiCare, we educate our patients on the benefits of proper mouthwash use to complement their daily oral care routine.</p>
        </div>
        <div class="box">
            <img src="image/about0.png" alt="Oral Hygiene Image">
        </div>
    </div>

    <!-- Dental Implants Section -->
    <div class="role">
        <div class="box-container">
            <div class="box">
                <h1>The Importance of Dental Implants</h1>
                <p>Dental implants are a revolutionary solution for replacing missing teeth. They provide a long-lasting, natural-looking replacement that restores functionality and aesthetic appeal. At DentiCare, we use state-of-the-art techniques to ensure that your dental implant procedure is as seamless and effective as possible.</p>
            </div>
            <div class="box">
                <img src="image/about1.jpg" alt="Dental Implants Image">
            </div>
        </div>
    </div>

    <!-- Dental Services in Numbers Section -->
    <div class="skill-container">
        <div class="heading">
            <span>Our Dental Services</span>
            <h1>In Numbers</h1>
            <p>At DentiCare, we pride ourselves on delivering exceptional care with measurable results. Our focus is always on providing the highest quality of service to ensure patient satisfaction and successful outcomes.</p>
        </div>
        <div class="container">
            <div class="progress-bar">
                <div class="progress">
                    <span class="title timer" date-form="0" date-to="99" date-speed="1800">
                        <img src="image/counter (1).png" alt="Counter Icon">
                    </span>
                    <div class="overlay"></div>
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <h1>99%</h1>
                <h4>Client Satisfaction</h4>
            </div>

            <div class="progress-bar">
                <div class="progress">
                    <span class="title timer" date-form="0" date-to="70" date-speed="1500">
                        <img src="image/icon (7).png" alt="Progress Icon">
                    </span>
                    <div class="overlay"></div>
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <h1>97%</h1>
                <h4>Intervention Success</h4>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonial-container">
        <div class="heading">
            <span>Clients with</span>
            <h1>Reason to Smile</h1>
        </div>
        <div class="container">
            <div class="testimonial-item active">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam0.webp" alt="Client 1">
                <h1>John Smith</h1>
                <p>"The care I received at DentiCare was exceptional. The staff was friendly, and the treatment was top-notch. I’m more confident with my smile than ever before!"</p>
            </div>
            <div class="testimonial-item">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam.webp" alt="Client 2">
                <h1>Ayman Doe</h1>
                <p>"I highly recommend DentiCare for anyone looking for professional and compassionate dental care. The team took the time to answer all my questions and made me feel at ease."</p>
            </div>

            <div class="testimonial-item">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam1.webp" alt="Client 3">
                <h1>Selena Ansari</h1>
                <p>"DentiCare’s dental implants changed my life. I now have the confidence to smile without hesitation. The procedure was quick, painless, and the results were amazing!"</p>
            </div>
            <div class="testimonial-item">
                <i class="bx bxs-quote-right" id="quote"></i>
                <img src="image/ourteam2.webp" alt="Client 4">
                <h1>Alweena Smith</h1>
                <p>"The staff at DentiCare are incredibly professional. I’ve been a patient for years, and their consistent care and attention to detail always impress me."</p>
            </div>
            <div class="left-arrow" onclick="rightSlide()"><i class="bx bx-left-arrow-alt"></i></div>
            <div class="right-arrow" onclick="leftSlide()"><i class="bx bx-right-arrow-alt"></i></div>
        </div>
    </div>

    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script type="text/javascript" src="/js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>
</body>
</html>
