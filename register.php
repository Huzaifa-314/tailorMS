<?php
include('frontend_header.php');
dbconnect();

// Initialize variables
$errors = [];
$successMessage = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $role = 'customer';

    // Basic validation
    if (empty($username)) {
        $errors[] = 'User Name is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid Email is required.';
    }
    if (empty($phone) || !preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors[] = 'Valid Phone number is required.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    }
    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    // If there are no errors, insert the user
    if (empty($errors)) {
        $hashedPassword = md5($password);

        $query = "INSERT INTO users (username, email, phone, password, role) VALUES (:username, :email, :phone, :password, :role)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            header("Location: signin.php?success=Regisration success! You can log in");
        } else {
            $errors[] = 'Registration failed. Please try again.';
        }
    }
}
?>

<div class="container my-5">
    <h2 class="mb-4">Register</h2>

    <!-- Display success or error messages -->
    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <!-- Full-width User Name -->
        <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="row">
            <!-- Left Column (Email) -->
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Right Column (Phone) -->
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
        </div>

        <div class="row">
            <!-- Left Column (Password) -->
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Right Column (Confirm Password) -->
            <div class="col-md-6 mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
    </form>
</div>

<?php include('frontend_footer.php'); ?>
