<?php 
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location:login.php');
    exit;
}

if (isset($_POST['publish']) || isset($_POST['draft'])) {
    $id = unique_id();

    // Correct field names and sanitize inputs
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $profession = $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    // File upload handling
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    // Determine status based on button clicked
    $status = isset($_POST['publish']) ? 'active' : 'deactive';

    // Check if the image already exists in the database
    $select_image = $conn->prepare("SELECT * FROM `employee` WHERE profile = ?");
    $select_image->execute([$image]);

    // Flag to allow or prevent insertion
    $allow_insertion = true;

    // Validate the image upload
    if (!empty($image)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Image name is repeated. Please rename your image.';
            $allow_insertion = false;
        } elseif ($image_size > 10000000) { // Limit set to 10 MB
            $warning_msg[] = 'Image size is too large. Maximum allowed size is 10 MB.';
            $allow_insertion = false;
        } else {
            if (!move_uploaded_file($image_tmp_name, $image_folder)) {
                $warning_msg[] = 'Failed to upload the image.';
                $allow_insertion = false;
            }
        }
    } else {
        $image = ''; // If no image is provided, insert a blank value
    }

    // Insert data only if all validations pass
    if ($allow_insertion) {
        $insert_employee = $conn->prepare("INSERT INTO `employee` (id, name, profession, email, number, profile_dec, profile, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_employee->execute([$id, $name, $profession, $email, $number, $content, $image, $status]);

        $success_msg[] = ($status === 'active') ? 'Employee added successfully.' : 'Employee saved as draft.';
    } else {
        $warning_msg[] = 'Data was not saved due to image validation issues.';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="../image/favicon.ico" type="image/x-icon">
</head>
<body style="padding-left: 0;">
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        
        <section class="dashboard">
            <div class="heading">
                <h1><img src="../image/separator.png">Add Employee<img src="../image/separator.png"></h1>
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="flex">
                        <div class="col">
                            <div class="input-field">
                                <p>Employee Name<span>*</span></p>
                                <input type="text" name="name" placeholder="Add employee name" class="box" required>
                            </div>
                            <div class="input-field">
                                <p>Employee Email<span>*</span></p>
                                <input type="email" name="email" placeholder="Add employee email" class="box" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-field">
                                <p>Employee Profession<span>*</span></p>
                                <input type="text" name="profession" placeholder="Add employee profession" class="box" required>
                            </div>
                            <div class="input-field">
                                <p>Employee Number<span>*</span></p>
                                <input type="number" name="number" placeholder="Add employee number" class="box" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <p>Profile Description<span>*</span></p>
                        <textarea name="content" placeholder="Employee profile description" class="box"></textarea>
                    </div>
                    <div class="input-field">
                        <p>Select Profile Image<span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box" required>
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="publish" class="btn">Add Employee</button>
                        <button type="submit" name="draft" class="btn">Save Draft</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>
