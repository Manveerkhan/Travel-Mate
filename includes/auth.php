<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

function require_user() {
	if (empty($_SESSION['user'])) {
		require_once __DIR__.'/config.php';
		header('Location: ' . url('login.php'));
		exit;
	}
}

function require_admin() {
	if (empty($_SESSION['admin'])) {
		require_once __DIR__.'/config.php';
		header('Location: ' . url('admin/login.php'));
		exit;
	}
}
?>
