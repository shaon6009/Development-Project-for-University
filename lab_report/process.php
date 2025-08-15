<?php
session_start();
require_once 'db.php';

// Store old inputs in session to refill form on error
$_SESSION['old'] = [
    'full_name' => $_POST['full_name'] ?? '',
    'email' => $_POST['email'] ?? ''
];

$errors = [];

// Sanitize inputs
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validation
if (!$full_name) {
    $errors[] = "Full Name is required.";
}
if (!$email) {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}
if (!$password) {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: register.php');
    exit;
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['errors'] = ["Email is already registered."];
    $stmt->close();
    header('Location: register.php');
    exit;
}
$stmt->close();

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into DB
$stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $full_name, $email, $hashed_password);

if ($stmt->execute()) {
    // Clear old input
    unset($_SESSION['old']);
    header('Location: success.php');
} else {
    $_SESSION['errors'] = ["Database error: Could not register."];
    header('Location: register.php');
}

$stmt->close();
$conn->close();
exit;
?>
