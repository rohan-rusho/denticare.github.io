<?php 
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

$warning_msg = [];
$success_msg = [];

if (isset($_POST['send_msg'])) {
    if ($user_id != '') {
        $id = uniqid(); // Generate a unique ID for the message

        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        // Verify if the same message already exists
        $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?");
        $verify_message->execute([$user_id, $name, $email, $subject, $message]);

        if ($verify_message->rowCount() > 0) {
            $warning_msg[] = 'Message already sent';
        } else {
            // Insert the message into the database
            $insert_message = $conn->prepare("INSERT INTO `message` (id, user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
            $success_msg[] = 'Message sent successfully';
        }
    } else {
        $warning_msg[] = 'Please login first';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Contact Us</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="../ddt/image/favicon.ico" type="image/x-icon">
</head>
<body>

    <?php include 'components/user_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Contact us</h1>
            <p>Have a question or need help? We're here for you!<br>
               Customer Support: help@denticare.com,<br>
               Sales Inquiries: sales@denticare.com <br>
               Business Hours: Sunday to Friday, 10:00 AM - 6:00 PM</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Contact us</span>
        </div>
    </div>

    <div class="contact">
        <div class="heading">
            <h1>Contact DentiCare</h1>
            <p>Have a question or need help? We're here for you!</p>
        </div> 
        <div class="box-container">
            <div class="box">
                <form method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <p>Your name <span>*</span></p>
                        <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Your email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Your Subject <span>*</span></p>
                        <input type="text" name="subject" placeholder="Enter your subject" maxlength="50" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Your message <span>*</span></p>
                        <textarea name="message" placeholder="Enter your message" maxlength="500" required class="box"></textarea>
                    </div>
                    <button type="submit" name="send_msg" class="btn">Send Message</button>
                </form>
            </div>
            <div class="box">
                <img src="image/doctor.png" alt="Doctor">
            </div>
        </div>
    </div>

    <div class="services">
        <div class="heading">
            <h1>Our Contact Details</h1>
            <p>Feel Free to contact us, these are our contact details!</p>
        </div> 
        <div class="box-container">
            <div class="box">
                <img src="image/contact-icon (3).png" alt="Contact Icon">
                <div>
                    <h4>Emergency Call</h4>
                    <p>01817052264</p>
                    <p>01835556220</p>
                </div>
            </div>
            <div class="box">
                <img src="image/contact-icon (1).png" alt="Contact Icon">
                <div>
                    <h4>Address</h4>
                    <p>Mirpur 1, Dhaka</p>
                    <p>Bangladesh</p>
                </div>
            </div> 
            <div class="box">
                <img src="image/contact-icon (2).png" alt="Contact Icon">
                <div>
                    <h4>Email</h4>
                    <p>dentalclinicportal@gmail.com</p>
                    <p>facebook.com/eita.rohan</p>
                </div>
            </div>         
        </div>
    </div>

    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="/js/user_script.js"></script>

    <?php include '../ddt/components/alert.php'; ?>
</body>
</html>
