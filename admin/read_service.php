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
    <link rel="icon" href="../image/favicon.ico" type="image/x-icon">
</head>
<body style="padding-left: 0;">
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="read-container">
            <div class="heading">
                <h1><img src="../image/separator.png">Service details<img src="../image/separator.png"></h1>
            </div>
            <div class="box-container">
                <?php
                $select_services = $conn->prepare("SELECT * FROM `services` WHERE id =?");
                $select_services->execute([$get_id]);

                  if ($select_services->rowCount() > 0){
                    while($fetch_service = $select_services->fetch(PDO::FETCH_ASSOC)){

                    
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="service_id" value="<?= $fetch_service['id']; ?>">
                    <div class="status" style="color: <?= ($fetch_service['status'] == 'active') ? 'limegreen' : 'red'; ?>;">
                            <?= $fetch_service['status']; ?>
                        </div>
                        <?php if($fetch_service['image'] != '') { ?>
                            <img src="../uploaded_files/<?= $fetch_service['image']; ?>" class="image">
                     <?php } ?>
                     <p class="price">$<?= $fetch_service['price']; ?></p>
                     <div class="name">$<?= $fetch_service['name']; ?></div>
                     <div class="content"><?= $fetch_service['service_details']; ?></div>
                     <div class="flex-btn">
                        <a href="edit_service.php?id=<?= $fetch_service['id']; ?>" class="btn">edit</a>
                         <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this service?');">delete</button>
                        <a href="view_service.php?post_id=<?= $fetch_service['id']; ?>" class="btn">go back</a>
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
