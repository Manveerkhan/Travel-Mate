<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
require_once __DIR__.'/config.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travel Mate</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand fw-bold" href="<?php echo url('index.php'); ?>">Travel Mate</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarsExample">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item"><a class="nav-link" href="<?php echo url('index.php'); ?>">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="<?php echo url('destinations.php'); ?>">Destinations</a></li>
				<li class="nav-item"><a class="nav-link" href="<?php echo url('packages.php'); ?>">Packages</a></li>
				<li class="nav-item"><a class="nav-link" href="<?php echo url('about.php'); ?>">About</a></li>
				<li class="nav-item"><a class="nav-link" href="<?php echo url('contact.php'); ?>">Contact</a></li>
			</ul>
			<form class="d-flex me-2 mb-2 mb-lg-0" method="get" action="<?php echo url('destinations.php'); ?>" data-search-form>
				<input class="form-control form-control-sm" type="search" name="q" placeholder="Search destinations..." aria-label="Search" style="width: 200px;">
				<button class="btn btn-outline-light btn-sm ms-2" type="submit">Search</button>
			</form>
			<ul class="navbar-nav">
				<?php if (!empty($_SESSION['user'])): ?>
					<li class="nav-item"><a class="nav-link" href="<?php echo url('profile.php'); ?>">Hi, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo url('logout.php'); ?>">Logout</a></li>
				<?php else: ?>
					<li class="nav-item"><a class="nav-link" href="<?php echo url('login.php'); ?>">Login</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo url('register.php'); ?>">Register</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>
<div class="container mt-4">
