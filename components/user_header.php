<?php
include 'components/connect.php';

// Retrieve user_id from the cookie
$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : '';

// Fetch user data if user_id is available
if (!empty($user_id)) {
    $query = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
    $query->execute([$user_id]);
    $fetch_profile = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<header class="header">
    <section class="flex">
        <a href="home.php" class="logo">
            <img src="image/logo.png" width="130px" alt="DentiCare Logo">
        </a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="service.php">Services</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="icons">
            
            <div id="profile-btn" class="profile-btn" onclick="toggleProfileDropdown()">
                <!-- Show only the default profile picture -->
                <img src="image/man.png" alt="Default Profile Picture" class="profile-img">
            </div>
        </div>
    </section>
</header>

<!-- Profile Dropdown -->
<div id="profile-dropdown" class="profile-dropdown">
    <div class="profile-dropdown-content">
        <?php if (!empty($fetch_profile)): ?>
            <!-- Show user photo and name in the dropdown -->
            <img src="uploaded_files/<?= htmlspecialchars($fetch_profile['image']); ?>" alt="Profile Picture" class="profile-dropdown-img">
            <h3><?= htmlspecialchars($fetch_profile['name']); ?></h3>
            <div class="flex-btn">
                <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" class="btn">Logout</a>
            </div>
        <?php else: ?>
            <!-- Show login/register options in the dropdown -->
            <h3>Please login or register</h3>
            <div class="flex-btn">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn">Register</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Toggle profile dropdown visibility
function toggleProfileDropdown() {
    const dropdown = document.getElementById('profile-dropdown');
    dropdown.classList.toggle('active');
}
</script>