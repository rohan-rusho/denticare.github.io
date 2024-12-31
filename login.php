<?php
session_start();  // Start the session to manage the user's login state

include 'components/connect.php';

// If the user is already logged in (via session), retrieve the session user ID
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);  // Use SHA1 for password hashing
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    // Check if the user exists in the database
    $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
    $select_users->execute([$email, $pass]);

    $row = $select_users->fetch(PDO::FETCH_ASSOC);

    // If the user is found in the database
    if ($select_users->rowCount() > 0) {
        // Store user information in session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];

        // Optionally, set a cookie for remembering the user for 30 days (if required)
        // setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');

        // Redirect to the home page after successful login
        header('Location: home.php');
        exit();  // Ensure the script stops after redirection
    } else {
        $warning_msg[] = 'Incorrect email or password';
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
