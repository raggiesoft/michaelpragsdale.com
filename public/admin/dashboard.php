<?php
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
    require_login();

    $success_message = '';
    $error_message = '';
    $jobs_json_path = __DIR__ . '/../assets/json/employment.json';

    // --- FORM PROCESSING LOGIC ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['company']) && !empty($_POST['roles'])) {

            $jobs = json_decode(file_get_contents($jobs_json_path), true);

            // Because of our form's `name` attributes (e.g., roles[0][title]),
            // PHP automatically gives us a perfectly structured array for the roles!
            $submitted_roles = $_POST['roles'];

            // We still need to process the description textareas into arrays of bullet points
            foreach ($submitted_roles as $index => $role) {
                if (isset($role['description'])) {
                    $submitted_roles[$index]['description'] = array_filter(array_map('trim', explode("\n", $role['description'])));
                }
            }

            $new_job = [
                'company' => $_POST['company'],
                'location' => $_POST['location'],
                'period' => $_POST['period'],
                'logo' => $_POST['logo'],
                'categories' => $_POST['categories'],
                'roles' => $submitted_roles // Assign the structured roles array
            ];

            array_unshift($jobs, $new_job);

            if (file_put_contents($jobs_json_path, json_encode($jobs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))) {
                $success_message = "Successfully added new job entry for " . htmlspecialchars($_POST['company']) . "!";
            } else {
                $error_message = "Error: Could not write to the JSON file. Check file permissions.";
            }

        } else {
            $error_message = "Error: Company name and at least one Role Title are required.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; font-weight: 700; margin-bottom: 0.5rem; }
        .form-group input, .form-group textarea { width: 100%; max-width: 600px; padding: var(--spacing-sm); border: var(--border-width) solid var(--border-color); border-radius: var(--border-radius); }
        .form-group textarea { min-height: 120px; }
        .form-group small { display: block; margin-top: 0.5rem; color: var(--text-color-muted); }
        .role-entry { border: 1px solid var(--border-color); padding: var(--spacing-lg); border-radius: var(--border-radius); margin-bottom: var(--spacing-lg); position: relative; }
        .role-entry-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .remove-role-btn { position: absolute; top: 1rem; right: 1rem; }
    </style>
</head>
<body style="padding: 2rem;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Admin Dashboard</h1>
            <a href="logout.php" class="button button-outline-secondary">Log Out</a>
        </div>
        <p>Use this form to add a new job entry with one or more roles.</p>

        <hr>

        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <h2>Add New Job Entry</h2>
        <form action="dashboard.php" method="POST">

            <fieldset>
                <legend><h3>Company Details</h3></legend>
                <div class="form-group"><label for="company">Company Name</label><input type="text" id="company" name="company" required></div>
                <div class="form-group"><label for="location">Location</label><input type="text" id="location" name="location"></div>
                <div class="form-group"><label for="period">Overall Period</label><input type="text" id="period" name="period"></div>
                <div class="form-group"><label for="logo">Logo Path</label><input type="text" id="logo" name="logo" placeholder="assets/images/employment/company-name.png"></div>
                <div class="form-group"><label for="categories">Categories</label><input type="text" id="categories" name="categories"><small>Space-separated slugs (e.g., developer current-employer)</small></div>
            </fieldset>

            <hr>

            <fieldset>
                <legend><h3>Roles</h3></legend>
                <div id="roles-container">
                    <?php // --- The first role entry --- ?>
                    <div class="role-entry">
                        <div class="role-entry-header">
                            <h4>Role 1</h4>
                            <?php // No remove button for the first role ?>
                        </div>
                        <div class="form-group"><label for="role_title_0">Role Title</label><input type="text" id="role_title_0" name="roles[0][title]" required></div>
                        <div class="form-group"><label for="role_period_0">Role Period</label><input type="text" id="role_period_0" name="roles[0][period]"></div>
                        <div class="form-group"><label for="role_description_0">Role Description</label><textarea id="role_description_0" name="roles[0][description]"></textarea><small>Enter each bullet point on a new line.</small></div>
                    </div>
                </div>
                <button type="button" id="add-role-btn" class="button button-outline-success"><i class="fa-duotone fa-plus fa-fw"></i> Add Another Role</button>
            </fieldset>

            <hr style="margin-top: 2rem;">

            <button type="submit" class="button button-primary"><i class="fa-duotone fa-plus fa-fw"></i> Add Full Job Entry</button>
        </form>

    </div>

    <?php // Include our new admin javascript file ?>
    <script src="../assets/js/admin.js"></script>
</body>
</html>