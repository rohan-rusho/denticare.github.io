<?php 
include '../components/connect.php';

// Check if admin is logged in
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    header('location:login.php');
    exit;
}

// Validate the 'post_id' parameter from the URL
$get_id = isset($_GET['post_id']) ? filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT) : null;
if (!$get_id) {
    echo '<script>alert("Invalid service ID!"); window.history.back();</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Service Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../image/favicon.ico" type="image/x-icon">
</head>
<body style="padding-left: 0;">
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="read-container">
            <div class="heading">
                <h1><img src="../image/separator.png"> Service Details <img src="../image/separator.png"></h1>
            </div>
            <div class="container">
                <?php
                // Fetch the service details
                $select_services = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
                $select_services->execute([$get_id]);

                if ($select_services->rowCount() > 0) {
                    $fetch_service = $select_services->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="box">
                    <?php if (!empty($fetch_service['image'])) { ?>
                        <img src="../uploaded_files/<?= htmlspecialchars($fetch_service['image']); ?>" class="image">
                    <?php } ?>
                    <p class="price">$<?= htmlspecialchars($fetch_service['price']); ?></p>
                    <div class="name"><?= htmlspecialchars($fetch_service['name']); ?></div>
                    <div class="content"><?= htmlspecialchars($fetch_service['service_details']); ?></div>
                    <div class="status" style="color: <?= ($fetch_service['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
                        <?= htmlspecialchars($fetch_service['status']); ?>
                    </div>
                    <div class="flex-btn">
                        <a href="edit_service.php?id=<?= htmlspecialchars($fetch_service['id']); ?>" class="btn">edit</a>
                        <a href="show_service.php" class="btn">go back</a>
                    </div>
                </div>
                <?php
                } else {
                    echo '<div class="empty"><p>Service not found!</p></div>';
                }
                ?>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
