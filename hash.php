<?php
// Use a strong password here to generate the hash
$password_to_hash = 'BbEnIDZV7II97C3'; 

// Generate the secure hash
$hashed_password = password_hash($password_to_hash, PASSWORD_DEFAULT);

// Display the hash
echo 'Your hashed password is: <br>';
echo '<textarea rows="3" cols="80" readonly>' . htmlspecialchars($hashed_password) . '</textarea>';

// HASH: $2y$10$H93Hy16KOy6Q.5tg.Kc/Let5c6FmcjrRCBH2GNwUcUNXS.IKJ4UAu
?>