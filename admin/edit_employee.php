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
    $employee_id = $_POST['employee_id'];
    $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $profession = $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);
    
    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $update_employee = $conn->prepare("UPDATE `employee` SET name = ?, profession = ?, email = ?, number = ?, profile_dec = ?, status = ? WHERE id = ?");
    $update_employee->execute([$name, $profession, $email, $number, $content, $status, $employee_id]);

    $success_msg[] = 'Employee updated successfully';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'Image size is too large';
        } else {
            $select_image = $conn->prepare("SELECT * FROM `employee` WHERE profile = ?");
            $select_image->execute([$image]);

            if ($select_image->rowCount() > 0 && $image != '') {
                $warning_msg[] = 'Please rename your image';
            } else {
                $update_image = $conn->prepare("UPDATE `employee` SET profile = ? WHERE id = ?");
                $update_image->execute([$image, $employee_id]);

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
    $employee_id = $_POST['employee_id'];
    $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
    $delete_image->execute([$employee_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image['profile'] != '') {
        unlink('../uploaded_files/' . $fetch_delete_image['profile']);
    }

    $delete_employee = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
    $delete_employee->execute([$employee_id]);
    header('location: view_employee.php');
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
                <h1><img src="../image/separator.png">Edit Employee <img src="../image/separator.png"></h1>
            </div>
            <div class="form-container">
                <?php 
                $employee_id = $_GET['id'];
                $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
                $select_employee->execute([$employee_id]);

                if ($select_employee->rowCount() > 0) {
                    $fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC);
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= $fetch_employee['profile']; ?>">
                    <input type="hidden" name="employee_id" value="<?= $fetch_employee['id']; ?>">
                    <div class="input-field">
                        <p>Employee Status <span>*</span></p>
                        <select name="status" class="box">
                            <option value="active" <?= ($fetch_employee['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="deactive" <?= ($fetch_employee['status'] === 'deactive') ? 'selected' : ''; ?>>Deactive</option>
                        </select>
                    </div>
                    <div class="flex">
                        <div class="col">
                            <div class="input-field">
                                <p>Employee Name<span>*</span></p>
                                <input type="text" name="name" value="<?= $fetch_employee['name']; ?>" placeholder="Enter employee name" class="box" required>
                            </div>
                            <div class="input-field">
                                <p>Employee Email<span>*</span></p>
                                <input type="email" name="email" value="<?= $fetch_employee['email']; ?>" placeholder="Add employee email" class="box">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-field">
                                <p>Employee Profession<span>*</span></p>
                                <input type="text" name="profession" value="<?= $fetch_employee['profession']; ?>" placeholder="Add employee profession" class="box">
                            </div>
                            <div class="input-field">
                                <p>Employee Number<span>*</span></p>
                                <input type="number" name="number" value="<?= $fetch_employee['number']; ?>" placeholder="Add employee number" class="box" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <p>Employee Image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                        <?php if($fetch_employee['profile'] != '') { ?>
                            <img src="../uploaded_files/<?= $fetch_employee['profile']; ?>" class="image" style="width: 100%;">
                        <?php } ?>
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="update" class="btn">Update Employee</button>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this employee?');">Delete Employee</button>
                        <a href="view_employee.php" class="btn">Go Back</a>
                    </div>
                </form>
                <?php
                } else {
                    echo '<div class="empty"><p>No employee found</p></div>';
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
