<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    header('Location: login.php', true, 302);
    exit;
}

$delete_msg = []; // Initialize success message array

if (isset($_POST['delete'])) {
    $service_id = filter_var($_POST['service_id'], FILTER_SANITIZE_NUMBER_INT);

    // Check if the service exists before attempting to delete
    $check_service = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
    $check_service->execute([$service_id]);
    $fetch_service = $check_service->fetch(PDO::FETCH_ASSOC);

    if ($fetch_service) {
        // Delete the associated image if it exists
        if (!empty($fetch_service['image'])) {
            $image_path = '../uploaded_files/' . $fetch_service['image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        // Delete the service
        $delete_service = $conn->prepare("DELETE FROM `services` WHERE id = ?");
        $delete_service->execute([$service_id]);

        $delete_msg[] = 'Service deleted successfully';
    } else {
        $delete_msg[] = 'Service not found';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Our Services</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo filemtime('../css/admin_style.css'); ?>">
    <link rel="icon" href="../image/favicon.ico" type="image/x-icon">
</head>
<body style="padding-left: 0;">
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="show-container">
            <div class="heading">
                <h1><img src="../image/separator.png">Our Services<img src="../image/separator.png"></h1>
            </div>
            <div class="box-container">
                <?php
                // Display success messages
                if (!empty($delete_msg)) {
                    foreach ($delete_msg as $msg) {
                        echo '<div class="success-msg">' . htmlspecialchars($msg) . '</div>';
                    }
                }

                // Fetch services with optional pagination
                $select_services = $conn->prepare("SELECT * FROM `services`");
                $select_services->execute();

                if ($select_services->rowCount() > 0) {
                    while ($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <form action="" method="post" class="box">
                        <input type="hidden" name="service_id" value="<?= htmlspecialchars($fetch_services['id']); ?>">
                        <img src="<?= !empty($fetch_services['image']) ? '../uploaded_files/' . htmlspecialchars($fetch_services['image']) : '../image/placeholder.png'; ?>" class="image">
                        <div class="status" style="color: <?= ($fetch_services['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
                            <?= htmlspecialchars($fetch_services['status']); ?>
                        </div>
                        <p class="price">$<?= htmlspecialchars($fetch_services['price']); ?></p>
                        <div class="content">
                            <div class="title"><?= htmlspecialchars($fetch_services['name']); ?></div>
                            <div class="flex-btn">
                                <a href="edit_service.php?id=<?= htmlspecialchars($fetch_services['id']); ?>" class="btn">edit</a>
                                <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this service?');">delete</button>
                                <a href="read_service.php?post_id=<?= htmlspecialchars($fetch_services['id']); ?>" class="btn">read</a>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>No services added yet.</p>
                        <a href="add_service.php" class="btn" style="margin-top: 1rem;">Add Service</a>
                    </div>
                    ';
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
