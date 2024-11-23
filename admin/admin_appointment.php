<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit();
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `appointments` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $delete_appointment = $conn->prepare("DELETE FROM `appointments` WHERE id = ?");
        $delete_appointment->execute([$delete_id]);

        $success_msg[] = 'Appointment ID deleted successfully';
    } else {
        $warning_msg[] = 'Appointment ID already deleted or does not exist';
    }
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
        
        <section class="appointment-container">
            <div class="heading">
                <h1><img src="../image/separator.png"> Total Booked Appointments <img src="../image/separator.png"></h1>
            </div>
            <div class="box-container">
                <?php
                $select_appointment = $conn->prepare("SELECT * FROM `appointments`");
                $select_appointment->execute();

                if ($select_appointment->rowCount() > 0) {
                    while ($fetch_appointment = $select_appointment->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <div class="status" style="color: <?php echo ($fetch_appointment['status'] == 'in progress') ? 'limegreen' : 'red'; ?>">
                        <?= $fetch_appointment['status']; ?>
                    </div>
                    <div class="detail">
                        <p>User Name: <span><?= $fetch_appointment['name']; ?></span></p>
                        <p>User ID: <span><?= $fetch_appointment['user_id']; ?></span></p>
                        <p>Placed On: <span><?= $fetch_appointment['date']; ?></span></p>
                        <p>Number: <span><?= $fetch_appointment['number']; ?></span></p>
                        <p>Email: <span><?= $fetch_appointment['email']; ?></span></p>
                        <p>Time: <span><?= $fetch_appointment['time']; ?></span></p>
                        <p>Total Price: <span><?= $fetch_appointment['total_price']; ?></span></p>
                        <p>Appointment Status: <span><?= $fetch_appointment['status']; ?></span></p>

                        <?php
                        // Fetch Employee Data
                        $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ? LIMIT 1");
                        $select_employee->execute([$fetch_appointment['employee_id']]);
                        if ($select_employee->rowCount() > 0) {
                            $fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="employee">
                            <p class="title">Selected Employee: <span><?= $fetch_employee['name']; ?></span></p>
                            <img src="../uploaded_files/<?= $fetch_employee['profile']; ?>" alt="Employee Profile">
                        </div>
                        <?php } ?>

                        <?php
                        // Fetch Service Data
                        $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ? LIMIT 1");
                        $select_service->execute([$fetch_appointment['service_id']]);
                        if ($select_service->rowCount() > 0) {
                            $fetch_service = $select_service->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="employee">
                            <p class="title">Selected Service: <span><?= $fetch_service['name']; ?></span></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="empty"><p>No appointments received yet!</p></div>';
                }
                ?>
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
