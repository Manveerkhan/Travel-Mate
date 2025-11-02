<?php require __DIR__.'/includes/db.php'; ?>
<?php require __DIR__.'/includes/auth.php'; ?>
<?php require_user(); ?>
<?php include __DIR__.'/includes/header.php'; ?>
<?php
$packageId = isset($_GET['package_id']) ? (int)$_GET['package_id'] : 0;
$stmt = $mysqli->prepare('SELECT p.*, d.name AS destination_name FROM packages p JOIN destinations d ON d.id = p.destination_id WHERE p.id = ?');
$stmt->bind_param('i', $packageId);
$stmt->execute();
$pkg = $stmt->get_result()->fetch_assoc();
if (!$pkg) {
	echo '<div class="alert alert-warning">Package not found.</div>';
	include __DIR__.'/includes/footer.php';
	exit;
}

$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$date = $_POST['booking_date'] ?? '';
	if ($date) {
		$uid = (int)$_SESSION['user']['id'];
		$ins = $mysqli->prepare('INSERT INTO bookings (user_id, package_id, booking_date, status) VALUES (?, ?, ?, "Pending")');
		$ins->bind_param('iis', $uid, $packageId, $date);
		$success = $ins->execute();
	}
}
?>
<h2>Book Package</h2>
<?php if ($success): ?><div class="alert alert-success">Booking placed successfully.</div><?php endif; ?>
<div class="card">
	<div class="card-body">
		<h5 class="card-title mb-1"><?php echo htmlspecialchars($pkg['title']); ?></h5>
		<p class="mb-1"><span class="badge bg-secondary"><?php echo htmlspecialchars($pkg['destination_name']); ?></span></p>
		<p class="mb-1">Duration: <?php echo htmlspecialchars($pkg['duration']); ?></p>
		<p class="fw-bold">$<?php echo number_format((float)$pkg['price'], 2); ?></p>
		<form method="post" class="mt-3">
			<label class="form-label">Select date</label>
			<input type="date" class="form-control mb-3" name="booking_date" required>
			<button class="btn btn-primary">Confirm Booking</button>
		</form>
	</div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
