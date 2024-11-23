<header class="header">
    <section class="flex">
        <a href="home.php" class="logo">
            <img src="image/logo.png" width="130px" alt="DentiCare Logo">
        </a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="service.php">Services</a>
            <a href="team.php">Our Team</a>
            <a href="book_appointment.php">Appointments</a>
            <a href="contact.php">Contact</a>
        </nav>
        <form action="search_service.php" method="post" class="search-form">
            <input type="text" name="search_service" placeholder="Search services..." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" name="search_service_btn"></button>
        </form>
        <div class="icons">
            <div id="menu-btn" class="bx bx-menu"></div>
            <div id="search-btn" class="bx bx-search-alt-2"></div>
            <div id="user-btn" class="bx bxs-user"></div>
        </div>
        <div class="profile" style="background-image: none;">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);

            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
                <img src="uploaded_files/<?= htmlspecialchars($fetch_profile['image']); ?>" alt="Profile Picture">
                <h3 style="margin-bottom: 1rem;"><?= htmlspecialchars($fetch_profile['name']); ?></h3>
                <div class="flex-btn">
                    <a href="profile.php" class="btn">View Profile</a>
                    <a href="component/user_logout.php" onclick="return confirm('Logout from this website?');" class="btn">Logout</a>
                </div>
            <?php 
            } else {
            ?>
                <img src="image/man.png" alt="Default Profile Picture">
                <h3 style="margin-bottom: 1rem;">Please login or register</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn">Login</a>
                    <a href="register.php" class="btn">Register</a>
                </div>
            <?php } ?>
        </div>
    </section>
</header>
