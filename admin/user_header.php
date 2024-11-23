<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"><img src="image/logo.png" width="130px"></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="service.php">services</a>
            <a href="team.php">our team</a>
            <a href="book_appointment.php">appointments</a>
            <a href="contact.php">contact</a>
        </nav>
        <form action="search_service.php" method="post" class="search-form>
            <input type="text" name="search_service" placeholder="search_service..." required
            maxlength="100">
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

            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

            ?>
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
            <h3 style="margin-bottom: 1rem;><?= $fetch_profile['name']; ?></h3>
            <div class="flex-btn">
                 <a href="profile.php" class="btn">view profile</a>
                 <a href="component/user_logout.php" onclick="return confirm('logout from this websit');" class="btn">logout</a>
            
            
            </div>
            <?php 
                }else{

            ?>
            <img src="image/man.png">
            <h3 style="margin-bottom: 1rem;">please login or register</h3>
            <div class="flex-btn">
                 <a href="login.php" class="btn">login</a>
                 <a href="register" class="btn">register</a>
            
            
            </div>
            <?php } ?>

        </div>

    </section>
</header>
