<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit;
}
   $get_id = $_GET['post_id'];

   if(isset($_POST['delete'])){
    $employee_id = $_POST['service_id'];
    $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);

    $delete_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
    $delete_employee->execute([$employee_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image[''] != ''){
        unlink('../uploaded_files/'.$fetch_delete_image['profile']);      
    }

    $delete_employee = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
    header('location: view_employee.php');
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
        
        <section class="read-container">
            <div class="heading">
                <h1><img src="../image/separator.png">employee details<img src="../image/separator.png"></h1>
            </div>
            <div class="container">
                <?php
                $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id =?");
                $select_employee->execute([$get_id]);

                  if ($select_employee->rowCount() > 0){
                    while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){

                    
                ?>
                <form action="" method="post" class="box">
    <input type="hidden" name="employee_id" value="<?= $fetch_employee['id']; ?>">
    <div class="status" style="color: <?= ($fetch_employee['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
        <?= $fetch_employee['status']; ?>
    </div>
    <?php if ($fetch_employee['profile'] != '') { ?>
        <img src="../uploaded_files/<?= $fetch_employee['profile']; ?>" class="image">
    <?php } ?>
    <div class="name"><?= $fetch_employee['name']; ?></div>
    <div class="profession">Profession: <span><?= $fetch_employee['profession']; ?></span></div>
    <div class="employee-number">Employee Number: <span><?= $fetch_employee['number']; ?></span></div>
    <div class="employee-email">Employee Email: <span><?= $fetch_employee['email']; ?></span></div>
    <div class="content"><?= $fetch_employee['profile_dec']; ?></div>
    <div class="flex-btn">
        <a href="edit_employee.php?id=<?= $fetch_employee['id']; ?>" class="btn">edit</a>
        <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this employee?');">delete</button>
        <a href="view_employee.php?post_id=<?= $fetch_employee['id']; ?>" class="btn">go back</a>
    </div>
</form>

                <?php 
                      } 
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
