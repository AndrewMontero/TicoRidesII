<?php
// Initialize variables to store form field values
$firstName = $lastName = $email = $username = $password = $confirmPassword = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $firstName = sanitizeInput($_POST["firstName"]);
    $lastName = sanitizeInput($_POST["lastName"]);
    $email = sanitizeInput($_POST["email"]);
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);
    $confirmPassword = sanitizeInput($_POST["confirmPassword"]);

    // Validate form fields
    $errors = validateForm($firstName, $lastName, $email, $username, $password, $confirmPassword);

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        // Perform registration process
        // You can implement your registration logic here
        // For example, storing user data in a database
        // Redirect the user to a success page after registration
        header("Location: registration_success.php");
        exit;
    }
}

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate form fields
function validateForm($firstName, $lastName, $email, $username, $password, $confirmPassword) {
    $errors = [];

    // Validate that all fields are not empty
    if (empty($firstName) || empty($lastName) || empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
        $errors[] = "Please fill in all fields.";
    }

    // Validate that password and confirm password match
    if ($password != $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    // Validate email format using a regular expression
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    return $errors;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="sthyles/user_register.css">
</head>

<body>
    <img src="images/logo.png" class="img" alt="Illustrative Purposes">
    <div>
        <!-- The form is submitted to the same page with POST method -->
        <form id="registrationForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Label and input field for first name -->
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>

            <!-- Label and input field for last name -->
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>

            <!-- Label and input field for email -->
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <!-- Label and input field for username -->
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <!-- Label and input field for password -->
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <!-- Label and input field to confirm password -->
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <!-- Submit button for form -->
            <button type="submit">Register</button>
        </form>
        <!-- Display errors, if any -->
        <?php if (!empty($errors)) : ?>
            <div class="error-messages">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <!-- Link to the login page -->
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>

</html>
