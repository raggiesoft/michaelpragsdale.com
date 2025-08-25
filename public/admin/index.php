<?php // --- admin/index.php (Revised with Username Field) ---
/**
 * My Portfolio Website
 *
 * This file is part of My Portfolio Website.
 *
 * My Portfolio Website is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * @copyright Copyright (c) 2025 Michael Ragsdale
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */
    require_once 'auth.php';

    if (is_logged_in()) {
        header('Location: dashboard.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body style="padding: 2rem;">
    <div class="container" style="max-width: 400px;">
        <h1>Admin Login</h1>
        <p>Please log in to manage site content.</p>
        

        <?php // Display an error message if the login failed ?>
        <?php if (!empty($login_error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $login_error; ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <div style="margin-bottom: 1rem;">
                <label for="username" style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Username</label>
                <input type="text" id="username" name="username" required style="padding: 0.5rem; width: 100%;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="password" style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Password</label>
                <input type="password" id="password" name="password" required style="padding: 0.5rem; width: 100%;">
            </div>

            <button type="submit" class="button button-primary">Log In</button>
        </form>
        <p><a href="/">Return Home</a></p>
    </div>
</body>
</html>