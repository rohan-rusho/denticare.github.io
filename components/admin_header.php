<header>
    <div class="logo">
        <img src="../image/logo.png" width="200">
    </div>
    <div class="right">
        <div class="profile-icon">
            <i class="bx bxs-user" id="user-btn"></i> <!-- Profile icon -->
        </div>
        <div class="toggle-btn">
            <i class='bx bx-menu'></i>
        </div>
    </div>
    <div class="profile-detail">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
        $select_profile->execute([$admin_id]);

        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
            <div class="profile">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" alt="Profile Picture">
                <p><?= $fetch_profile['name']; ?></p>
            </div>
            <div class="flex-btn">
                <a href="profile.php" class="btn">Profile</a>
                <a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');" class="btn">Logout</a>
            </div>
        <?php
        }
        ?>
    </div>
</header>
<div class="side-container">
    <div class="sidebar">
        <?php
        // Fetch the admin profile for the sidebar
        $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
        $select_profile->execute([$admin_id]);

        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
            <div class="profile">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" alt="Profile Picture">
                <p><?= $fetch_profile['name']; ?></p>
            </div>
        <?php
        }
        ?>
        <h5>Menu</h5>
        <div class="navbar">
            <ul>
                <li><a href="dashboard.php"><i class="bx bx-right-arrow-alt"></i> Dashboard</a></li>
                <li><a href="add_service.php"><i class="bx bx-right-arrow-alt"></i> Add Service</a></li>
                <li><a href="view_service.php"><i class="bx bx-right-arrow-alt"></i> View Service</a></li>
                <li><a href="add_employee.php"><i class="bx bx-right-arrow-alt"></i> Add Employee</a></li>
                <li><a href="view_employee.php"><i class="bx bx-right-arrow-alt"></i> View Employee</a></li>
                <li><a href="user_account.php"><i class="bx bx-right-arrow-alt"></i> User Account</a></li>
                <li><a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');"><i class="bx bx-right-arrow-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>
