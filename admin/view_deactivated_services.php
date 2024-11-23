<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Active Services</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="../image/favicon.ico" type="image/x-icon">
</head>
<body style="padding-left: 0;">
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="show-container">
            <div class="heading">
                <h1><img src="../image/separator.png">All Deactive Services<img src="../image/separator.png"></h1>
            </div>

            <div class="box-container">
                <?php
                // Fetch all active services
                $select_services = $conn->prepare("SELECT * FROM `services` WHERE `status` = 'deactive'");
                $select_services->execute();

                if ($select_services->rowCount() > 0) {
                    while ($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <form action="" method="post" class="box">
                        <input type="hidden" name="service_id" value="<?= $fetch_services['id']; ?>">
                        <?php if ($fetch_services['image'] != '') { ?>
                            <img src="../uploaded_files/<?= $fetch_services['image']; ?>" class="image">
                        <?php } ?>
                        <div class="status" style="color: red;">
                            <?= $fetch_services['status']; ?>
                        </div>
                        <p class="price">$<?= $fetch_services['price']; ?></p>
                        <div class="content">
                            <div class="title"><?= $fetch_services['name']; ?></div>
                            <div class="flex-btn">
                                <a href="edit_service.php?id=<?= $fetch_services['id']; ?>" class="btn">edit</a>
                                <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this service?');">delete</button>
                                <a href="read_service.php?post_id=<?= $fetch_services['id']; ?>" class="btn">read</a>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                   }
                } else {
                    echo '
                    <div class="empty">
                        <p>No active services available. <a href="add_service.php" class="btn" style="margin-top: 1rem;">Add Service</a></p>
                    </div>
                    ';
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
