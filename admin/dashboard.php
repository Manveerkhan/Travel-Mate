<?php require __DIR__.'/../includes/db.php'; ?>
<?php require __DIR__.'/../includes/auth.php'; require_admin(); ?>
<?php require_once __DIR__.'/../includes/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard - Travel Mate</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
		<a class="navbar-brand" href="<?php echo url('dashboard.php'); ?>">Admin - Travel Mate</a>
		<div class="ms-auto">
			<a class="btn btn-outline-light btn-sm" href="<?php echo url('logout.php'); ?>">Logout</a>
		</div>
	</div>
</nav>
<div class="container my-4">
	<?php
	$usersResult = $mysqli->query('SELECT COUNT(*) as c FROM users');
	$users = $usersResult ? ($usersResult->fetch_assoc()['c'] ?? 0) : 0;
	
	$bookingsResult = $mysqli->query('SELECT COUNT(*) as c FROM bookings');
	$bookings = $bookingsResult ? ($bookingsResult->fetch_assoc()['c'] ?? 0) : 0;
	
	$destResult = $mysqli->query('SELECT COUNT(*) as c FROM destinations');
	$dest = $destResult ? ($destResult->fetch_assoc()['c'] ?? 0) : 0;
	?>
	<div class="row g-3">
		<div class="col-md-4">
			<div class="card text-bg-primary h-100"><div class="card-body"><h5 class="card-title">Total Users</h5><p class="display-6 mb-0"><?php echo (int)$users; ?></p></div></div>
		</div>
		<div class="col-md-4">
			<div class="card text-bg-success h-100"><div class="card-body"><h5 class="card-title">Total Bookings</h5><p class="display-6 mb-0"><?php echo (int)$bookings; ?></p></div></div>
		</div>
		<div class="col-md-4">
			<div class="card text-bg-warning h-100"><div class="card-body"><h5 class="card-title">Total Destinations</h5><p class="display-6 mb-0"><?php echo (int)$dest; ?></p></div></div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-lg-8">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Bookings Overview</h5>
					<canvas id="bookingsChart" height="120"></canvas>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="list-group">
				<a href="<?php echo url('destinations.php'); ?>" class="list-group-item list-group-item-action">Manage Destinations</a>
				<a href="<?php echo url('packages.php'); ?>" class="list-group-item list-group-item-action">Manage Packages</a>
				<a href="<?php echo url('users.php'); ?>" class="list-group-item list-group-item-action">Manage Users</a>
				<a href="<?php echo url('bookings.php'); ?>" class="list-group-item list-group-item-action">View Bookings</a>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('bookingsChart');
new Chart(ctx, { type: 'bar', data: { labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], datasets: [{ label: 'Bookings', data: [3,2,5,1,6,7,2,4,5,3,6,8], backgroundColor: 'rgba(13,110,253,.6)' }] }, options: { scales: { y: { beginAtZero: true } } } });
</script>
</body>
</html>
