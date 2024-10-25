<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit;
}

if (isset($_POST['publish'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['Price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    // Correct file upload handling
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    $status = 'active';

    // Correct connection variable and use of parameterized query
    $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
    $select_image->execute([$image]);

    if (!empty($image)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Image name is repeated';
        } elseif ($image_size > 10000000) {
            $warning_msg[] = 'Image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    if ($select_image->rowCount() > 0 && $image != '') {
        $warning_msg[] = 'Please rename your image.';
    } else {
        $insert_service = $conn->prepare("INSERT INTO `services`(id, name, price, image, service_details, status) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_service->execute([$id, $name, $price, $image, $content, $status]);
        $success_msg[] = 'Service added successfully.';
    }
}

if (isset($_POST['draft'])) {
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['Price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    // Correct file upload handling
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    $status = 'deactive';

    // Correct connection variable and use of parameterized query
    $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
    $select_image->execute([$image]);

    if (!empty($image)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Image name is repeated';
        } elseif ($image_size > 10000000) {
            $warning_msg[] = 'Image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    if ($select_image->rowCount() > 0 && $image != '') {
        $warning_msg[] = 'Please rename your image.';
    } else {
        $insert_service = $conn->prepare("INSERT INTO `services`(id, name, price, image, service_details, status) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_service->execute([$id, $name, $price, $image, $content, $status]);
        $success_msg[] = 'Service added successfully.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Dental Clinic Website Template</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body style="padding-left: 0;">
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="dashboard">
            <div class="heading">
                <h1><img src="../image/separator.png">add service<img src="../image/separator.png"></h1>
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>Service Name <span>*</span></p>
                        <input type="text" name="name" placeholder="Add service name" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Service Charge <span>*</span></p>
                        <input type="number" name="Price" placeholder="Add service charge" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Service Description <span>*</span></p>
                        <textarea name="content" class="box" required placeholder="Service description"></textarea>
                    </div>
                    <div class="input-field">
                        <p>Service Thumbnail <span>*</span></p>
                        <input type="file" name="image" accept="image/*" required class="box">
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="publish" class="btn">Publish</button>
                        <button type="submit" name="draft" class="btn">Save Draft</button>
                    </div>
                </form>
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
