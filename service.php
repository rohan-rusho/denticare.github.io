<?php 
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
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
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
	<link rel="icon" href="../ddt/image/favicon.ico" type="image/x-icon">

</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
    <div class="detail">
        <h1>Our Services</h1>
        <p>
            Comprehensive dental care for every smile.<br>
            From preventive treatments to advanced cosmetic solutions.
        </p>
        <span>
            <a href="home.php">Home</a> <i class="bx bx-right-arrow-alt"></i> Our Services
        </span>
    </div>
    </div>


    <div class="show-container">
        <div class="heading">
            <h1>our best dental services</h1>
            <p>Bringing Confidence Through Exceptional Dentistry</p>
        </div>
        <div class="box-container">
            <?php
               $select_services = $conn->prepare("SELECT * FROM `services` WHERE status = ?");
               $select_services->execute(['active']);

               if ($select_services->rowCount() > 0) {
                while($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)){

            ?>
            <from action="" method="post" class="box">
                <img src="uploaded_files/<?= $fetch_services['image']; ?>" class="image">
                <p class="price">$<?= $fetch_services['price']; ?>/-</p>
                <div class="content">
                    <div class="button">
                        <div><h3><?= $fetch_services['name']; ?></h3></div>
                        <div>
                            <a href="view_page.php?pid=<?= $fetch_services['id']; ?>" class="bx bxs-show"></a>
                        </div>
                    </div>
                    <input type="hidden" name="service_id" value="<?=$fetch_services['id']; ?>">
                    <div class="flex-btn">
                        <a href="appointment.php?get_id=<?=$fetch_services['id']; ?>" class="btn" style="width: 100%;">book appointment</a>

                    </div>
                </div>
            </from>
            <?php 
                  }           
                }else {
                    echo '
                    <div class="empty">
                        <p>No services added yet </p>
                    </div>
                    ';
                }
            ?>
        </div>
    </div>






    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script type="text/javascript" src="/js/user_script.js"></script>

    <?php include '../ddt/components/alert.php'; ?>
</body>
</html>