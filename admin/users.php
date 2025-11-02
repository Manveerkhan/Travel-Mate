<?php require __DIR__.'/../includes/db.php'; ?>
<?php require __DIR__.'/../includes/auth.php'; require_admin(); ?>
<?php require_once __DIR__.'/../includes/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Users - Admin</title>
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
		<h3 class="mb-0">Users</h3>
		<a class="btn btn-secondary" href="<?php echo url('dashboard.php'); ?>">Back</a>
	</div>
	<?php
	$success = '';
	if (isset($_POST['action']) && $_POST['action'] === 'delete') {
		$id = (int)$_POST['id'];
		if ($id > 0) {
			$stmt = $mysqli->prepare('DELETE FROM users WHERE id = ?');
			$stmt->bind_param('i', $id);
			if ($stmt->execute()) {
				$success = 'User deleted.';
			} else {
				$errors[] = 'Failed to delete user: ' . $stmt->error;
			}
		}
	}
	$list = $mysqli->query('SELECT id, name, email, created_at FROM users ORDER BY id DESC');
	$errors = [];
	if (!$list) {
		$errors[] = 'Failed to load users: ' . $mysqli->error;
	}
	?>
	<?php if ($success): ?><div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div><?php endif; ?>
	<?php if ($errors): ?><div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div><?php endif; ?>
	<div class="table-responsive">
		<table class="table table-striped align-middle">
			<thead><tr><th>#</th><th>Name</th><th>Email</th><th>Joined</th><th>Actions</th></tr></thead>
			<tbody>
				<?php 
				if ($list && $list->num_rows > 0):
					$i=1; 
					while ($row = $list->fetch_assoc()): 
				?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo htmlspecialchars($row['name']); ?></td>
					<td><?php echo htmlspecialchars($row['email']); ?></td>
					<td><?php echo htmlspecialchars($row['created_at']); ?></td>
					<td>
						<form method="post" onsubmit="return confirm('Delete this user? This also deletes their bookings.');" class="d-inline">
							<input type="hidden" name="action" value="delete">
							<input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
							<button class="btn btn-sm btn-outline-danger">Delete</button>
						</form>
					</td>
				</tr>
				<?php 
					endwhile;
				else:
				?>
				<tr>
					<td colspan="5" class="text-center text-muted py-4">No users found.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
