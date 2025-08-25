<?php
// Use a strong password here to generate the hash
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
$password_to_hash = 'BbEnIDZV7II97C3'; 

// Generate the secure hash
$hashed_password = password_hash($password_to_hash, PASSWORD_DEFAULT);

// Display the hash
echo 'Your hashed password is: <br>';
echo '<textarea rows="3" cols="80" readonly>' . htmlspecialchars($hashed_password) . '</textarea>';

// HASH: $2y$10$H93Hy16KOy6Q.5tg.Kc/Let5c6FmcjrRCBH2GNwUcUNXS.IKJ4UAu
?>