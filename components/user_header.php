
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
        <form action="search_service.php" method="post" class="search-form">
            <input type="text" name="search_service" placeholder="Search services..." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" name="search_service_btn"></button>
        </form>
        <div class="icons">
            <div id="menu-btn" class="bx bx-menu"></div>
            <div id="profile-btn" class="profile-btn">
                <?php if (isset($user_profile)): ?>
                    <!-- If the user is logged in, show their profile image -->
                    <img src="uploaded_files/<?= htmlspecialchars($user_profile['image']); ?>" alt="Profile Picture" class="profile-img" onclick="toggleProfileDropdown()">
                <?php else: ?>
                    <!-- If the user is not logged in, show the default profile icon -->
                    <img src="image/man.png" alt="Profile Picture" class="profile-img" onclick="toggleProfileDropdown()">
                <?php endif; ?>
            </div>
        </div>
    </section>
</header>

<!-- Profile Dropdown -->
<div id="profile-dropdown" class="profile-dropdown">
    <div class="profile-dropdown-content">
        <?php if (isset($user_profile)): ?>
            <!-- If the user is logged in, show the profile image and logout button -->
            <img src="uploaded_files/<?= htmlspecialchars($user_profile['image']); ?>" alt="Profile Picture" class="profile-dropdown-img">
            <h3 class="profile-name"><?= htmlspecialchars($user_profile['name']); ?></h3>
            <div class="flex-btn">
                <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" class="btn">Logout</a>
            </div>
        <?php else: ?>
            <!-- If the user is not logged in, show login and register buttons -->
            <img src="image/man.png" alt="Default Profile Picture" class="profile-dropdown-img">
            <h3 class="profile-name">Please login or register</h3>
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