<?php 
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

$pid = $_GET['pid'];

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
        <h1>Service Details</h1>
            <p>
                Explore the exceptional services we offer to care for your dental needs.<br>
                From routine cleanings to advanced treatments, your smile is our priority.
            </p>
        <span>
            <a href="home.php">Home</a> <i class="bx bx-right-arrow-alt"></i> Service Details
        </span>
    </div>
    </div>

    <div class="view_container">
        <?php 
            
            if(isset($_GET['pid'])) {
                $pid = $_GET['pid'];
                $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = '$pid'");
                $select_service->execute();

                if ($select_service->rowCount() > 0) {
                    while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="post" class="box">
            <div class="img-box">
                <div class="heading">
                    <h1><img src="image/separator.png">service details<img src="image/separator.png"></h1>
                </div>
                <img src="uploaded_files/<?= $fetch_service['image']; ?>" >
            </div>
            <div class="details">
                <p class="price">$<?= $fetch_service['price']; ?>/-</p>
                <div class="name"><?= $fetch_service['name']; ?></div>
                <p class="service-dtail"><?= $fetch_service['service_details']; ?></p>
                <input type="hidden" name="service_id" value="<?= $fetch_service['id']; ?>">
                <div class="flex-btn">
                    <a href="appointment.php?get_id=<?= $fetch_service['id']; ?>" class="btn" style="width: 100%;">book appointment now</a>

                </div>
            </div>
        </form>
        <?php 
               }
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




    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS Link -->
    <script type="text/javascript" src="/js/user_script.js"></script>

    <?php include '../ddt/components/alert.php'; ?>
</body>
</html>