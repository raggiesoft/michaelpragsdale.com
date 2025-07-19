<?php // --- admin/auth.php (Revised with Username) ---

session_start();

// --- Configuration ---
$admin_username = 'RaggieSoftAdmin'; // Choose your desired username
// This is the hashed password you generated earlier
$stored_hash = '$2y$10$H93Hy16KOy6Q.5tg.Kc/Let5c6FmcjrRCBH2GNwUcUNXS.IKJ4UAu';

// The is_logged_in() and require_login() functions remain exactly the same.
function is_logged_in() {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: index.php');
        exit();
    }
}

// --- Login Form Processing (Revised) ---
$login_error = ''; // Initialize an error variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if both username and password fields were submitted
    if (isset($_POST['username'], $_POST['password'])) {
        $submitted_username = $_POST['username'];
        $submitted_password = $_POST['password'];

        // 1. Check if the username matches.
        // 2. THEN, verify the password against the stored hash.
        if ($submitted_username === $admin_username && password_verify($submitted_password, $stored_hash)) {

            // If both are correct, log the user in and clear any old error messages.
            $_SESSION['is_logged_in'] = true;
            unset($_SESSION['login_error']); // Clear previous errors
            header('Location: dashboard.php');
            exit();

        } else {
            // If login fails, set an error message.
            $login_error = "Invalid username or password.";
        }
    }
}
?>