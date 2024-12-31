<?php 
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['register'])) {
    $id = unique_id();

    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $pass = filter_var(trim(sha1($_POST['pass'])), FILTER_SANITIZE_STRING);
    $cpass = filter_var(trim(sha1($_POST['cpass'])), FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/' . $rename;

    // Check for existing email
    $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_users->execute([$email]);

    if ($select_users->rowCount() > 0) {
        $warning_msg[] = 'Email already taken!';
    } else {
        if ($pass != $cpass) {
            $warning_msg[] = 'Confirm password does not match!';
        } else {
            // Insert new admin
            $insert_users = $conn->prepare("INSERT INTO `users` (id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
            $insert_users->execute([$id, $name, $email, $pass, $rename]);

            // Ensure file upload
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                $success_msg[] = 'New admin registered! Please login now.';
            } else {
                $warning_msg[] = 'File upload failed. Please try again.';
            }
        }
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
    <link rel="stylesheet" type="text/css" href="css/user_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="../ddt/image/favicon.ico" type="image/x-icon">
</head>
<body>

    <?php include 'components/user_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Register Now</h1>
           
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Register Now</span>
        </div>
    </div>

    <!-- Register Section Starts -->
    <div class="form-container form">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>Register Now</h3>

            <!-- Display warning messages -->
            <?php if (!empty($warning_msg)): ?>
                <div class="alert alert-warning">
                    <?php foreach ($warning_msg as $msg): ?>
                        <p><?php echo $msg; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Display success messages -->
            <?php if (!empty($success_msg)): ?>
                <div class="alert alert-success">
                    <?php foreach ($success_msg as $msg): ?>
                        <p><?php echo $msg; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="flex">
                <div class="col">
                    <p>Your Name <span>*</span></p>
                    <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
                    <p>Your Email <span>*</span></p>
                    <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
                </div>

                <div class="col">
                    <p>Your Password <span>*</span></p>
                    <input type="password" id="registerPass" name="pass" placeholder="Enter your password" maxlength="50" required class="box">
                    <p>Confirm Password <span>*</span></p>
                    <input type="password" id="confirmPass" name="cpass" placeholder="Confirm your password" maxlength="50" required class="box">
                    <label>
                        <input type="checkbox" id="showPasswordCheckbox" onclick="togglePasswordVisibility()"> Show Password
                    </label>
                </div>
            </div>

            <div class="input-field">
                <p>Select Profile <span>*</span></p>
                <input type="file" name="image" accept="image/*" required class="box">
            </div>
            <p class="link">Already have an account? <a href="login.php">Login now</a></p>
            <button type="submit" name="register" class="btn">Register Now</button>
        </form>
    </div>    
    <!-- Register Section Ends -->

    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS for Show Password -->
    <script>
        function togglePasswordVisibility() {
            const passField = document.getElementById('registerPass');
            const confirmPassField = document.getElementById('confirmPass');
            const checkbox = document.getElementById('showPasswordCheckbox');

            if (checkbox.checked) {
                passField.type = 'text';
                confirmPassField.type = 'text';
            } else {
                passField.type = 'password';
                confirmPassField.type = 'password';
            }
        }
    </script>
</body>
</html>
