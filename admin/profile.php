<?php 
// Include the database connection
include '../components/connect.php';

// Check if the admin ID cookie is set
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    // Redirect to login if the admin ID cookie is not set
    header('location:login.php');
    exit; // Ensure script execution stops after the redirect
}



try {
    // Fetch total services
    $select_service = $conn->prepare("SELECT COUNT(*) FROM `services`");
    $select_service->execute();
    $total_services = $select_service->fetchColumn(); // Efficient count retrieval

    // Fetch total employees
    $select_employee = $conn->prepare("SELECT COUNT(*) FROM `employee`");
    $select_employee->execute();
    $total_employee = $select_employee->fetchColumn();

    // Fetch total appointments
    $select_appointment = $conn->prepare("SELECT COUNT(*) FROM `appointments`");
    $select_appointment->execute();
    $total_appointments = $select_appointment->fetchColumn();
} catch (PDOException $e) {
    // Log and handle database errors
    error_log("Database error: " . $e->getMessage());
    echo "An error occurred while retrieving data. Please try again later.";
    exit; // Stop execution if database query fails
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
        
        <section class="profile-container">
			<div class="heading">
				<h1><img src="../image/separator.png">profile details<img src="../image/separator.png"></h1>
			</div>
            <div class="details">
        <div class="admin">
        <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" alt="Profile Picture">
              <h3><?= $fetch_profile['name']; ?></h3>
              <span>admin</span>
              <a href="profile.php" class="btn">profile</a>   
                
               

            
</div>


    <div class="flex">
        <div class="box">
            <span><?=$total_services; ?></span>
            <p>Total Services</p>
            <a href="view_service.php" class="btn">View Services</a>
        </div>
        <div class="box">
            <span><?= $total_employee; ?></span>
            <p>Total employee</p>
            <a href="view_employee.php" class="btn">total employee</a>
        </div>

    
        <div class="box">
            <span><?= $total_appointments; ?></span>
            <p>Total Appointments</p>
            <a href="admin_appointments.php" class="btn">View Appointments</a>
        </div>
    </div>
</section>
			    
		</section>
		
    </div>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script type="text/javascript" src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>
