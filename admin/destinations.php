<?php require __DIR__.'/../includes/db.php'; ?>
<?php require __DIR__.'/../includes/auth.php'; require_admin(); ?>
<?php require_once __DIR__.'/../includes/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Destinations - Admin</title>
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
		<h3 class="mb-0">Destinations</h3>
		<div>
			<a class="btn btn-secondary" href="<?php echo url('dashboard.php'); ?>">Back</a>
		</div>
	</div>
	<?php
	$errors = [];
	$success = '';
	if (isset($_POST['action']) && $_POST['action'] === 'create') {
		$name = trim($_POST['name'] ?? '');
		$desc = trim($_POST['description'] ?? '');
		$image = null;
		if (!empty($_FILES['image']['name'])) {
			$fn = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/','', $_FILES['image']['name']);
			@mkdir(__DIR__.'/../uploads', 0777, true);
			if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/../uploads/'.$fn)) {
				$image = $fn;
			}
		}
		$stmt = $mysqli->prepare('INSERT INTO destinations (name, description, image) VALUES (?, ?, ?)');
		$stmt->bind_param('sss', $name, $desc, $image);
		$success = $stmt->execute() ? 'Destination added.' : 'Failed to add destination.';
	}
	if (isset($_POST['action']) && $_POST['action'] === 'update') {
		$id = (int)$_POST['id'];
		$name = trim($_POST['name'] ?? '');
		$desc = trim($_POST['description'] ?? '');
		if ($id > 0 && $name !== '') {
			$imageVal = null;
			if (!empty($_FILES['image']['name'])) {
				$fn = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/','', $_FILES['image']['name']);
				@mkdir(__DIR__.'/../uploads', 0777, true);
				if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/../uploads/'.$fn)) {
					$imageVal = $fn;
				}
			}
			if ($imageVal !== null) {
				$stmt = $mysqli->prepare("UPDATE destinations SET name=?, description=?, image=? WHERE id=?");
				$stmt->bind_param('sssi', $name, $desc, $imageVal, $id);
			} else {
				$stmt = $mysqli->prepare("UPDATE destinations SET name=?, description=? WHERE id=?");
				$stmt->bind_param('ssi', $name, $desc, $id);
			}
			if ($stmt->execute()) {
				$success = 'Destination updated.';
			} else {
				$errors[] = 'Failed to update destination: ' . $stmt->error;
			}
		} else {
			$errors[] = 'Please fill required fields.';
		}
	}
	if (isset($_POST['action']) && $_POST['action'] === 'delete') {
		$id = (int)$_POST['id'];
		if ($id > 0) {
			$stmt = $mysqli->prepare('DELETE FROM destinations WHERE id = ?');
			$stmt->bind_param('i', $id);
			if ($stmt->execute()) {
				$success = 'Destination deleted.';
			} else {
				$errors[] = 'Failed to delete destination.';
			}
		}
	}
	$list = $mysqli->query('SELECT * FROM destinations ORDER BY id DESC');
	?>
	<?php if ($success): ?><div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div><?php endif; ?>
	<?php if ($errors): ?><div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div><?php endif; ?>
	<div class="card mb-4">
		<div class="card-body">
			<h5 class="card-title">Add Destination</h5>
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="create">
				<div class="row g-3">
					<div class="col-md-4">
						<label class="form-label">Name</label>
						<input class="form-control" name="name" placeholder="Name" required>
					</div>
					<div class="col-md-5">
						<label class="form-label">Description</label>
						<input class="form-control" name="description" placeholder="Short description">
					</div>
					<div class="col-md-2">
						<label class="form-label">Image</label>
						<input type="file" class="form-control" name="image" accept="image/*">
					</div>
					<div class="col-md-1 d-grid">
						<label class="form-label d-none d-md-block">&nbsp;</label>
						<button class="btn btn-primary">Add</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped align-middle">
			<thead><tr><th>#</th><th>Image</th><th>Name</th><th>Description</th><th>Actions</th></tr></thead>
			<tbody>
				<?php $i=1; while ($row = $list->fetch_assoc()): ?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php if ($row['image']): ?><img src="<?php echo url('uploads/' . htmlspecialchars($row['image'])); ?>" width="64" height="48" style="object-fit:cover"><?php endif; ?></td>
					<td><?php echo htmlspecialchars($row['name']); ?></td>
					<td><?php echo htmlspecialchars($row['description']); ?></td>
					<td>
						<form method="post" class="d-inline" enctype="multipart/form-data">
							<input type="hidden" name="action" value="update">
							<input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
							<input class="form-control form-control-sm d-inline-block mb-1" style="width:160px" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
							<input class="form-control form-control-sm d-inline-block mb-1" style="width:240px" name="description" value="<?php echo htmlspecialchars($row['description']); ?>">
							<input type="file" class="form-control form-control-sm d-inline-block mb-1" style="width:220px" name="image" accept="image/*">
							<button class="btn btn-sm btn-primary">Save</button>
						</form>
						<form method="post" class="d-inline ms-1" onsubmit="return confirm('Delete this destination?');">
							<input type="hidden" name="action" value="delete">
							<input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
							<button class="btn btn-sm btn-outline-danger">Delete</button>
						</form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
