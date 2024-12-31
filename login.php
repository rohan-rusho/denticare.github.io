<?php 
include 'components/connect.php';

$error_msg = [];
$success_msg = [];

if (isset($_POST['login'])) {
    // Sanitize input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']); // Hash password with SHA-1
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    // Check user credentials in the database
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        // Login success
        setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
        header('location:home.php'); // Redirect to homepage
        exit;
    } else {
        // Login failed
        $error_msg[] = 'Incorrect email or password';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentiCare - Secure Login</title>

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
            <h1>Login to Your Account</h1>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Login</span>
        </div>
    </div>

    <!-- Login Section Starts -->
    <div class="form-container form">
        <form action="" method="post" class="login">
            <h3>Secure Login</h3>

            <!-- Display Messages -->
            <?php
                if (!empty($success_msg)) {
                     foreach ($success_msg as $msg) {
                             echo '<div class="success-msg">' . htmlspecialchars($msg) . '</div>';
                      }
                      }

                    // Display error messages (if any)
                    if (!empty($error_msg)) {
                        foreach ($error_msg as $msg) {
                            echo '<div class="error-msg">' . htmlspecialchars($msg) . '</div>';
                        }
                    }
                    ?>

            <div class="input-field">
                <p>Email Address <span>*</span></p>
                <input type="email" name="email" placeholder="Enter your email address" maxlength="50" required class="box">
            </div>

            <div class="input-field">
                <p>Password <span>*</span></p>
                <input type="password" id="loginPass" name="pass" placeholder="Enter your password" maxlength="50" required class="box">
                <label>
                    <input type="checkbox" onclick="togglePasswordVisibility('loginPass')"> Show Password
                </label>
            </div>

            <div class="input-field">
                <button type="submit" name="login" class="btn">Login Now</button>
            </div>

            <p class="link">Don't have an account? <a href="register.php">Sign Up Here</a></p>
        </form>
    </div>    
    <!-- Login Section Ends -->

    <?php include 'components/user_footer.php'; ?>

    <!-- SweetAlert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- JavaScript for Show Password -->
    <script>
        function togglePasswordVisibility(inputId) {
            const passwordField = document.getElementById(inputId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>
</html>
