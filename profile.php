<?php require __DIR__.'/includes/db.php'; ?>
<?php require __DIR__.'/includes/auth.php'; ?>
<?php require_user(); ?>
<?php include __DIR__.'/includes/header.php'; ?>
<?php
$uid = (int)$_SESSION['user']['id'];
$sql = 'SELECT b.*, p.title, d.name AS destination_name FROM bookings b JOIN packages p ON p.id = b.package_id JOIN destinations d ON d.id = p.destination_id WHERE b.user_id = ? ORDER BY b.id DESC';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $uid);
$stmt->execute();
$bookings = $stmt->get_result();
?>
<h2>My Profile</h2>
<div class="card mb-3">
	<div class="card-body">
		<p class="mb-1"><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
		<p class="mb-0"><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user']['email']); ?></p>
	</div>
</div>
<h4>Booking History</h4>
<div class="table-responsive">
	<table class="table table-striped align-middle">
		<thead>
			<tr>
				<th>#</th>
				<th>Package</th>
				<th>Destination</th>
				<th>Booking Date</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; while ($row = $bookings->fetch_assoc()): ?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo htmlspecialchars($row['title']); ?></td>
				<td><?php echo htmlspecialchars($row['destination_name']); ?></td>
				<td><?php echo htmlspecialchars($row['booking_date']); ?></td>
				<td><span class="badge bg-<?php echo $row['status']==='Pending' ? 'warning' : 'success'; ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
