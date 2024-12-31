<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Canceled Appointments</title>

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
                <h1><img src="../image/separator.png"> Canceled Appointments <img src="../image/separator.png"></h1>
            </div>
            <div class="box-container">
                <?php
                // Query to fetch only canceled appointments
                $select_canceled_appointments = $conn->prepare("SELECT * FROM `appointments` WHERE status = 'canceled'");
                $select_canceled_appointments->execute();

                if ($select_canceled_appointments->rowCount() > 0) {
                    while ($fetch_appointment = $select_canceled_appointments->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <div class="status" style="color: red;">
                        <?= $fetch_appointment['status']; ?>
                    </div>
                    <div class="detail">
                        <p>User Name: <span><?= $fetch_appointment['name']; ?></span></p>
                        <p>User ID: <span><?= $fetch_appointment['user_id']; ?></span></p>
                        <p>Placed On: <span><?= $fetch_appointment['date']; ?></span></p>
                        <p>Number: <span><?= $fetch_appointment['number']; ?></span></p>
                        <p>Email: <span><?= $fetch_appointment['email']; ?></span></p>
                        <p>Time: <span><?= $fetch_appointment['time']; ?></span></p>
                        <p>Total Price: <span>$<?= $fetch_appointment['price']; ?></span></p>
                        <p>Payment Status: <span><?= $fetch_appointment['payment_status']; ?></span></p>

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
                    echo '<div class="empty"><p>No canceled appointments found!</p></div>';
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
