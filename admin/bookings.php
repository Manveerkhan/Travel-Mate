<?php require __DIR__.'/../includes/db.php'; ?>
<?php require __DIR__.'/../includes/auth.php'; require_admin(); ?>
<?php require_once __DIR__.'/../includes/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bookings - Admin</title>
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
<div class="container py-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h3 class="mb-0">Bookings</h3>
		<a class="btn btn-secondary" href="<?php echo url('dashboard.php'); ?>">Back</a>
	</div>
	<?php
	$success = '';
	$errors = [];
	if (isset($_POST['action']) && $_POST['action'] === 'status') {
		$id = (int)$_POST['id'];
		$status = $_POST['status'] === 'Approved' ? 'Approved' : 'Pending';
		if ($id > 0) {
			$stmt = $mysqli->prepare('UPDATE bookings SET status = ? WHERE id = ?');
			$stmt->bind_param('si', $status, $id);
			if ($stmt->execute()) {
				$success = 'Status updated.';
			} else {
				$errors[] = 'Failed to update status: ' . $stmt->error;
			}
		} else {
			$errors[] = 'Invalid booking ID.';
		}
	}
	$sql = 'SELECT b.*, u.name AS user_name, p.title AS package_title, d.name AS dest_name FROM bookings b JOIN users u ON u.id = b.user_id JOIN packages p ON p.id = b.package_id JOIN destinations d ON d.id = p.destination_id ORDER BY b.id DESC';
	$list = $mysqli->query($sql);
	if (!$list) {
		$errors[] = 'Failed to load bookings: ' . $mysqli->error;
	}
	?>
	<?php if ($success): ?><div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div><?php endif; ?>
	<?php if ($errors): ?><div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div><?php endif; ?>
	<div class="table-responsive">
		<table class="table table-striped align-middle">
			<thead><tr><th>#</th><th>User</th><th>Package</th><th>Destination</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
			<tbody>
				<?php 
				if ($list && $list->num_rows > 0):
					$i=1; 
					while ($row = $list->fetch_assoc()): 
				?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo htmlspecialchars($row['user_name']); ?></td>
					<td><?php echo htmlspecialchars($row['package_title']); ?></td>
					<td><?php echo htmlspecialchars($row['dest_name']); ?></td>
					<td><?php echo htmlspecialchars($row['booking_date']); ?></td>
					<td><span class="badge bg-<?php echo $row['status']==='Pending' ? 'warning' : 'success'; ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
					<td>
						<form method="post" class="d-inline">
							<input type="hidden" name="action" value="status">
							<input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
							<select name="status" class="form-select form-select-sm d-inline-block" style="width:140px">
								<option value="Pending" <?php if ($row['status']==='Pending') echo 'selected'; ?>>Pending</option>
								<option value="Approved" <?php if ($row['status']==='Approved') echo 'selected'; ?>>Approved</option>
							</select>
							<button class="btn btn-sm btn-primary">Update</button>
						</form>
					</td>
				</tr>
				<?php 
					endwhile;
				else:
				?>
				<tr>
					<td colspan="7" class="text-center text-muted py-4">No bookings found.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
