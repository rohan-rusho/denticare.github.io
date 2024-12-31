<?php 
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['send_msg'])){

    if($user_id != ''){

        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $subject = $_POST['subject'];
        $subject = filter_var($subject, FILTER_SANITIZE_STRING);

        $message = $_POST['message'];
        $message = filter_var($message, FILTER_SANITIZE_STRING);

        $verify_message = $conn->prepare("SELECT * FROM 'message' WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ? ");
        $verify_message->execute([$user_id, $name, $email, $subject, $message]);

        if($verify_message->rowCount()>0){
            $warning_msg[] = 'message already send';
        }else{
            $insert_message=$conn->prepare("INSERT INTO 'message' (id,user_id, name, email, subject, message) VALUES(?,?,?,?,?,?)");
            $success_msg[] = 'message send';
        }
    }else{
        $warning_msg[]='please login first';
    }
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
	<link rel="icon" href="../ddt/image/favicon.ico" type="image/x-icon">

</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Contact us</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing<br>
               Lorem ipsum, dolor sit amet consectetur adipisicing</p>
               <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Contact us</span>
        </div>
    </div>



<div class="contact">
        <div class="heading">
            <h1>Contact DentiCare</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio, velit.</p>
        </div> 
            <div class="box-container">
                <div class="box">
                    <form action="post" enctype="multipart/form-data">
                        <div class="input-field">
                            <p>Your name <span>*</span></p>
                            <input type="text" name="name" placeholder="Enter your name"  maxlength="50" required class="box">
                        </div>
                        <div class="input-field">
                            <p>Your email <span>*</span></p>
                            <input type="email" name="email" placeholder="Enter your mail"  maxlength="50" required class="box">
                        </div>
                        <div class="input-field">
                            <p>Your Subject <span>*</span></p>
                            <input type="text" name="subject" placeholder="Enter your reason"  maxlength="50" required class="box">
                        </div>
                        <div class="input-field">
                            <p>Your message <span>*</span></p>
                            <textarea name="message" class="box"></textarea>
                        </div>
                        <button type="submit" name="send_msg" class="btn">Send Message</button>
                    </form>
                </div>
                <div class="box">
                    <img src="image/doctor.png" alt="doctorpng">
                </div>
            </div>
 </div>


<div class="services">
    <div class="heading">
            <h1>Our contact details</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio, velit.</p>
        </div> 

    <div class="box-container">
        <div class="box">
                <img src="image/contact-icon (3).png" alt="contact icon">
            <div>
                <h4>emergency call</h4>
                <p>01817052264</p>
                <p>01835556220</p>
            </div>
        </div>
        <div class="box">
                <img src="image/contact-icon (1).png" alt="contact icon">
            <div>
                <h4>adress</h4>
                <p>Mirpur 1, Dhaka</p>
                <p>Bangladesh</p>
            </div>
        </div> 
        <div class="box">
                <img src="image/contact-icon (2).png" alt="contact icon">
            <div>
                <h4>email</h4>
                <p>dentalclinicportal@gmail.com</p>
                <p>facebook.com/dentalclinicportal</p>
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