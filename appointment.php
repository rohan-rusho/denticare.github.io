<?php
include 'components/connect.php';

if (isset($_POST['book_appointment'])) {
    $user_id = $_COOKIE['user_id'] ?? '';
    $name = $_POST['first_name'] . ' ' . $_POST['last_name']; // Combine first and last names
    $number = $_POST['number'];
    $email = $_POST['email'];
    $service_id = $_GET['get_id'] ?? null; // Ensure service ID is fetched correctly
    $employee_id = $_POST['employee'];
    $date = $_POST['date'];
    $time = $_POST['appointment_time'];
    $price = $_POST['price'] ?? 0; // Adjust price fetching logic as needed
    $status = 'pending';
    $payment_status = 'unpaid';

    // Check if user ID or service ID is missing
    if (empty($user_id)) {
        echo "<script>alert('User ID is missing. Please log in again.');</script>";
        exit;
    }

    if (empty($service_id)) {
        echo "<script>alert('Service not found.');</script>";
        exit;
    }

    try {
        // Check for duplicate appointments
        $check_duplicate = $conn->prepare("SELECT COUNT(*) FROM `appointments` WHERE user_id = ? AND date = ? AND time = ?");
        $check_duplicate->execute([$user_id, $date, $time]);
        if ($check_duplicate->fetchColumn() > 0) {
            echo "<script>alert('You already have an appointment at this time.');</script>";
            exit;
        }

        // Insert new appointment
        $insert_appointment = $conn->prepare("INSERT INTO `appointments` 
            (user_id, name, number, email, service_id, employee_id, date, time, price, status, payment_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_appointment->execute([
            $user_id, $name, $number, $email, $service_id, $employee_id, $date, $time, $price, $status, $payment_status
        ]);

        echo "<script>alert('Appointment booked successfully!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
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
            <h1>Book Your Appointment</h1>
            <p>Provide necessary information for your appointment booking.<br>
               From routine cleanings to advanced treatments, your smile is our priority.</p>
            <span>
                <a href="home.php">Home</a> <i class="bx bx-right-arrow-alt"></i> Appointment
            </span>
        </div>
    </div>

    <div class="summary">
        <h3>Book Your Appointment</h3>
        <div class="container">
            <?php
             $grand_total = 0;

             if (isset($_GET['get_id'])) {
                 $select_get = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
                 $select_get->execute([$_GET['get_id']]);

                 if ($select_get->rowCount() > 0) {
                     while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                         $sub_total = $fetch_get['price'];
                         $grand_total += $sub_total;
            ?>
            <div class="flex">
                <img src="uploaded_files/<?= $fetch_get['image']; ?>" class="image">
                <div>
                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                    <p class="price">$<?= $fetch_get['price']; ?></p>
                </div>
            </div>
            <?php
                     }
                 } else {
                     echo '<div class="empty"><p>No services found.</p></div>';
                 }
             } else {
                 echo '<div class="empty"><p>No services selected.</p></div>';
             }
            ?>
            <div class="grand-total">Total Amount Payable: <span><p>$<?= $grand_total; ?></p></span></div>
        </div>
    </div>

    <div class="form-container form">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>First Name <span>*</span></p>
                        <input type="text" name="first_name" placeholder="Enter your first name" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Last Name <span>*</span></p>
                        <input type="text" name="last_name" placeholder="Enter your last name" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Your Number <span>*</span></p>
                        <input type="number" name="number" placeholder="Enter your number" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>Your Email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email" class="box" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>Payment Method <span>*</span></p>
                        <select name="payment" class="box select" required>
                            <option selected disabled>Select Payment Method</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nagad">Nagad</option>
                            <option value="Rocket">Rocket</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <p>Select Doctor <span>*</span></p>
                        <select name="employee" class="box select" required>
                            <option selected disabled>Select Doctor</option>
                            <?php
                            $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE status = ?");
                            $select_employee->execute(['active']);
                            while ($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$fetch_employee['id']}'>{$fetch_employee['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                        // Set the timezone to your location
                        date_default_timezone_set('Asia/Kolkata'); // Replace with your desired timezone

                        // Get today's date in the format required for the min attribute
                        $today = date('Y-m-d');
                    ?>

                        <div class="input-field">
                            <p>Select Date <span>*</span></p>
                            <!-- The min attribute is dynamically set to today's date -->
                            <input type="date" name="date" class="box" required min="<?php echo $today; ?>">
                        </div>
                    <div class="input-field">
                        <p>Select Time <span>*</span></p>
                        <select name="appointment_time" class="box select" required>
                            <option selected disabled>Select Time</option>
                            <option value="10:00am">10:00 AM</option>
                            <option value="11:00am">11:00 AM</option>
                            <option value="12:00pm">12:00 PM</option>
                            <option value="1:00pm" disabled>1:00 PM (Break)</option>
                            <option value="1:30pm">1:30 PM</option>
                            <option value="2:00pm">2:00 PM</option>
                            <option value="3:00pm">3:00 PM</option>
                            <option value="4:00pm">4:00 PM</option>
                            <option value="5:00pm">5:00 PM</option>
                            <option value="6:00pm">6:00 PM</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="book_appointment" class="btn">Book Appointment</button>
        </form>
    </div>

    <?php include 'components/user_footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="/js/user_script.js"></script>
</body>
</html>
