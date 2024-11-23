<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
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
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
	<link rel="icon" href="../image/favicon.ico" type="image/x-icon">

</head>
<body style="padding-left: 0;">

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="dashboard">
			<div class="heading">
				<h1><img src="../image/separator.png">dashboard<img src="../image/separator.png"></h1>
			</div>
            <div class="box-container">
                <div class="box">
                    <h3>Welcome!</h3>
                    <p><?= htmlspecialchars($fetch_profile['name']); ?></p>
                    <a href="profile.php" class="btn">View Profile</a>
                </div>
                <div class="box">
                    <?php
                    $select_msg = $conn->prepare("SELECT * FROM `message`");
                    $select_msg->execute();
                    $num_of_msg = $select_msg->rowCount();
                    ?>
                    <h3><?= $num_of_msg; ?></h3>
                    <p>All messages</p>
                    <a href="admin_message.php" class="btn">View Messages</a>
                </div>
				<div class="box">
                    <?php
                    $select_services = $conn->prepare("SELECT * FROM `services`");
                    $select_services->execute();
                    $num_of_services = $select_services->rowCount();
                    ?>
                    <h3><?= $num_of_services; ?></h3>
                    <p>View services</p>
                    <a href="view_service.php" class="btn">View Service</a>
                </div>
				<div class="box">
                    <?php
                    $select_active_services = $conn->prepare("SELECT * FROM `services` where status=?");
                    $select_active_services->execute(['active']);
                    $num_of_active_services = $select_active_services->rowCount();
                    ?>
                    <h3><?= $num_of_active_services; ?></h3>
                    <p>View active services</p>
                    <a href="view_active_services.php" class="btn">View active Services</a>
                </div>
				<div class="box">
                    <?php
                    $select_deactive_services = $conn->prepare("SELECT * FROM `services` where status=?");
                    $select_deactive_services->execute(['deactive']);
                    $num_of_deactive_services = $select_deactive_services->rowCount();
                    ?>
                    <h3><?= $num_of_deactive_services; ?></h3>
                    <p>View deactive services</p>
                    <a href="view_deactivated_services.php" class="btn">View deactive Services</a>
                </div>
				<div class="box">
                    <?php
                    $select_employee = $conn->prepare("SELECT * FROM `employee`");
                    $select_employee->execute();
                    $num_of_employee = $select_employee->rowCount();
                    ?>
                    <h3><?= $num_of_employee; ?></h3>
                    <p>View employee</p>
                    <a href="view_employee.php" class="btn">View employee</a>
                </div>
				<div class="box">
                    <?php
                    $select_appointments = $conn->prepare("SELECT * FROM `appointments`");
                    $select_appointments->execute();
                    $num_of_appointments = $select_appointments->rowCount();
                    ?>
                    <h3><?= $num_of_appointments; ?></h3>
                    <p>View appointments</p>
                    <a href="admin_appointments.php" class="btn">View appointments</a>
                </div>
				<div class="box">
                <?php
                     $select_canceled_appointments = $conn->prepare("SELECT * FROM `appointments` WHERE status = ?");
                     $select_canceled_appointments->execute(['canceled']);
                     $num_of_canceled_appointments = $select_canceled_appointments->rowCount();
                      ?>
                     <h3><?= $num_of_canceled_appointments; ?></h3>
                     <p>View canceled appointments</p>
                     <a href="admin_appointments.php" class="btn">View canceled appointments</a>
                </div>
				<div class="box">
                    <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $num_of_users = $select_users->rowCount();
                    ?>
                    <h3><?= $num_of_users; ?></h3>
                    <p>registered users</p>
                    <a href="user_Account.php" class="btn">registered users</a>
                </div>

    
		    </div>
			    
		</section>
		
    </div>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script type="text/javascript" src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>
