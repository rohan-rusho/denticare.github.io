<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit;
}

if (isset($_POST['update'])) {
    $service_id = $_POST['service_id'];
    $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $update_service = $conn->prepare("UPDATE `services` SET name = ?, price = ?, service_details = ?, status = ? WHERE id = ?");
    $update_service->execute([$name, $price, $content, $status, $service_id]);

    $success_msg[] = 'Service updated successfully';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'Image size is too large';
        } else {
            $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
            $select_image->execute([$image]);

            if ($select_image->rowCount() > 0 && $image != '') {
                $warning_msg[] = 'Please rename your image';
            } else {
                $update_image = $conn->prepare("UPDATE `services` SET image = ? WHERE id = ?");
                $update_image->execute([$image, $service_id]);

                move_uploaded_file($image_tmp_name, $image_folder);

                if ($old_image != $image && $old_image != '') {
                    unlink('../uploaded_files/' . $old_image);
                }
                $success_msg[] = 'Image updated';
            }
        }
    }
}

if (isset($_POST['delete'])) {
    $service_id = $_POST['service_id'];
    $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
    $delete_image->execute([$service_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image['image'] != '') {
        unlink('../uploaded_files/' . $fetch_delete_image['image']);
    }

    $delete_service = $conn->prepare("DELETE FROM `services` WHERE id = ?");
    $delete_service->execute([$service_id]);
    header('location: view_service.php');
    exit;
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
    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="../image/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="post_editor">
        <div class="heading">
                <h1><img src="../image/separator.png">Edit Service<img src="../image/separator.png"></h1>
            </div>
            <div class="form-container">
                <?php 
                $service_id = $_GET['id'];
                $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
                $select_service->execute([$service_id]);

                if ($select_service->rowCount() > 0) {
                    $fetch_service = $select_service->fetch(PDO::FETCH_ASSOC);
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= $fetch_service['image']; ?>">
                    <input type="hidden" name="service_id" value="<?= $fetch_service['id']; ?>">
                    <div class="input-field">
                        <p>Service Status <span>*</span></p>
                        <select name="status" class="box">
                            <option value="active" <?= ($fetch_service['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="deactive" <?= ($fetch_service['status'] === 'deactive') ? 'selected' : ''; ?>>Deactive</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <p>Service Name <span>*</span></p>
                        <input type="text" name="name" value="<?= $fetch_service['name']; ?>" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Service Price <span>*</span></p>
                        <input type="number" name="price" value="<?= $fetch_service['price']; ?>" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Service Description <span>*</span></p>
                        <textarea name="content" class="box" required><?= $fetch_service['service_details']; ?></textarea>
                    </div>
                    <div class="input-field">
                        <p>Service Image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                        <?php if($fetch_service['image'] != '') { ?>
                            <img src="../uploaded_files/<?= $fetch_service['image']; ?>" class="image" style="width: 100%;">
                        <?php } ?>
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="update" class="btn">Update Service</button>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this service?');">Delete Service</button>
                        <a href="view_service.php?post_id=<?= $fetch_service['id']; ?>" class="btn" style="text-align: center;" >Go Back</a>
                    </div>
                </form>
                <?php
                } else {
                    echo '<div class="empty"><p>No services found</p></div>';
                }
                ?>
            </div>    
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/admin_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
