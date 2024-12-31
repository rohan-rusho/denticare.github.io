<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $varify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
    $varify_delete->execute([$delete_id]);

    if ($varify_delete->rowCount() > 0) {
        $delete_msg = $conn->prepare("DELETE FROM `message` WHERE id = ?");
        $delete_msg->execute([$delete_id]);

        $success_msg[] = 'Message deleted successfully';
    } else {
        $warning_msg[] = 'Message already deleted';
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
        
        <section class="message-container">
            <div class="heading">
                <h1><img src="../image/separator.png">User's Messages<img src="../image/separator.png"></h1>
            </div>
            <div class="box-container">
                <?php
                $select_msg = $conn->prepare("SELECT * FROM `message` ");
                $select_msg->execute();
                
                if ($select_msg->rowCount() > 0) {
                    while ($fetch_msg = $select_msg->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="box">
                        <h3 class="name"><?= $fetch_msg['name']; ?></h3>
                        <h4><?= $fetch_msg['subject']; ?></h4>
                        <p><?= $fetch_msg['message']; ?></p>
                        <form action="" method="post">
                            <input type="hidden" name="delete_id" value="<?= $fetch_msg['id']; ?>">
                            <button type="submit" name="delete" class="btn" onclick="return confirm('Are you sure you want to delete this message?');">Delete Message</button>
                        </form>
                    </div>
                <?php
                    }
                } else {
                    echo '<div class="empty"><p>No messages received yet!</p></div>';
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
