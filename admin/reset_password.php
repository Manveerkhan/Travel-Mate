<?php
/**
 * Admin Password Reset Script
 * Run this once via browser or CLI to reset admin password
 * Then DELETE this file for security!
 */
require_once __DIR__.'/../includes/db.php';

$new_password = 'admin123'; // Change this to your desired password

// Generate new hash
$hash = password_hash($new_password, PASSWORD_BCRYPT);

// Update admin password
$username = 'admin';
$stmt = $mysqli->prepare('UPDATE admin SET password = ? WHERE username = ?');
$stmt->bind_param('ss', $hash, $username);

if ($stmt->execute()) {
	echo "✓ Admin password updated successfully!\n";
	echo "Username: admin\n";
	echo "Password: " . htmlspecialchars($new_password) . "\n";
	echo "\n⚠️  IMPORTANT: Delete this file (reset_password.php) for security!\n";
} else {
	echo "✗ Error updating password: " . $stmt->error . "\n";
}

$stmt->close();
$mysqli->close();
?>

