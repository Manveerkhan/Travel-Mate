<?php require __DIR__.'/../includes/db.php'; ?>
<?php require __DIR__.'/../includes/auth.php'; require_admin(); ?>
<?php require_once __DIR__.'/../includes/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Packages - Admin</title>
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
		<h3 class="mb-0">Packages</h3>
		<div>
			<a class="btn btn-secondary" href="<?php echo url('dashboard.php'); ?>">Back</a>
		</div>
	</div>
	<?php
	$success = '';
	$errors = [];
	if (isset($_POST['action']) && $_POST['action'] === 'create') {
		$did = (int)$_POST['destination_id'];
		$title = trim($_POST['title'] ?? '');
		$price = (float)($_POST['price'] ?? 0);
		$duration = trim($_POST['duration'] ?? '');
		$image = null;
		if (!empty($_FILES['image']['name'])) {
			$fn = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/','', $_FILES['image']['name']);
			@mkdir(__DIR__.'/../uploads', 0777, true);
			if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/../uploads/'.$fn)) { $image = $fn; }
		}
		if ($did > 0 && $title !== '' && $price > 0 && $duration !== '') {
			$stmt = $mysqli->prepare('INSERT INTO packages (destination_id, title, price, duration, image) VALUES (?, ?, ?, ?, ?)');
			$stmt->bind_param('isdss', $did, $title, $price, $duration, $image);
			if ($stmt->execute()) {
				$success = 'Package added.';
			} else {
				$errors[] = 'Failed to add package: ' . $stmt->error;
			}
		} else {
			$errors[] = 'Please fill all required fields.';
		}
	}
	if (isset($_POST['action']) && $_POST['action'] === 'update') {
		$id = (int)$_POST['id'];
		$did = (int)$_POST['destination_id'];
		$title = trim($_POST['title'] ?? '');
		$price = (float)($_POST['price'] ?? 0);
		$duration = trim($_POST['duration'] ?? '');
		if ($id > 0 && $did > 0 && $title !== '' && $price > 0 && $duration !== '') {
			$imageVal = null;
			if (!empty($_FILES['image']['name'])) {
				$fn = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/','', $_FILES['image']['name']);
				@mkdir(__DIR__.'/../uploads', 0777, true);
				if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/../uploads/'.$fn)) {
					$imageVal = $fn;
				}
			}
			if ($imageVal !== null) {
				$stmt = $mysqli->prepare("UPDATE packages SET destination_id=?, title=?, price=?, duration=?, image=? WHERE id=?");
				$stmt->bind_param('isdssi', $did, $title, $price, $duration, $imageVal, $id);
			} else {
				$stmt = $mysqli->prepare("UPDATE packages SET destination_id=?, title=?, price=?, duration=? WHERE id=?");
				$stmt->bind_param('isdsi', $did, $title, $price, $duration, $id);
			}
			if ($stmt->execute()) {
				$success = 'Package updated.';
			} else {
				$errors[] = 'Failed to update package: ' . $stmt->error;
			}
		} else {
			$errors[] = 'Please fill all required fields.';
		}
	}
	if (isset($_POST['action']) && $_POST['action'] === 'delete') {
		$id = (int)$_POST['id'];
		if ($id > 0) {
			$stmt = $mysqli->prepare('DELETE FROM packages WHERE id = ?');
			$stmt->bind_param('i', $id);
			if ($stmt->execute()) {
				$success = 'Package deleted.';
			} else {
				$errors[] = 'Failed to delete package.';
			}
		}
	}
	$destinations = $mysqli->query('SELECT id, name FROM destinations ORDER BY name ASC');
	$list = $mysqli->query('SELECT p.*, d.name AS destination_name FROM packages p JOIN destinations d ON d.id = p.destination_id ORDER BY p.id DESC');
	?>
	<?php if ($success): ?><div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div><?php endif; ?>
	<?php if ($errors): ?><div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div><?php endif; ?>
	<div class="card mb-4">
		<div class="card-body">
			<h5 class="card-title">Add Package</h5>
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="create">
				<div class="row g-2 align-items-end">
					<div class="col-md-3">
						<label class="form-label">Destination</label>
						<select class="form-select" name="destination_id" required>
							<option value="">Select...</option>
							<?php while ($d = $destinations->fetch_assoc()): ?>
								<option value="<?php echo (int)$d['id']; ?>"><?php echo htmlspecialchars($d['name']); ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="col-md-3"><label class="form-label">Title</label><input class="form-control" name="title" required></div>
					<div class="col-md-2"><label class="form-label">Price</label><input type="number" step="0.01" class="form-control" name="price" required></div>
					<div class="col-md-2"><label class="form-label">Duration</label><input class="form-control" name="duration" placeholder="5 days" required></div>
					<div class="col-md-2"><label class="form-label">Image</label><input type="file" class="form-control" name="image" accept="image/*"></div>
				</div>
				<div class="mt-3"><button class="btn btn-primary">Add</button></div>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped align-middle">
			<thead><tr><th>#</th><th>Image</th><th>Title</th><th>Destination</th><th>Price</th><th>Duration</th><th>Actions</th></tr></thead>
			<tbody>
				<?php $i=1; while ($row = $list->fetch_assoc()): ?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php if ($row['image']): ?><img src="<?php echo url('uploads/' . htmlspecialchars($row['image'])); ?>" width="64" height="48" style="object-fit:cover"><?php endif; ?></td>
					<td><?php echo htmlspecialchars($row['title']); ?></td>
					<td><?php echo htmlspecialchars($row['destination_name']); ?></td>
					<td>$<?php echo number_format((float)$row['price'],2); ?></td>
					<td><?php echo htmlspecialchars($row['duration']); ?></td>
					<td>
						<form method="post" class="d-flex flex-wrap gap-1 align-items-center" enctype="multipart/form-data">
							<input type="hidden" name="action" value="update">
							<input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
							<select class="form-select form-select-sm" name="destination_id" style="width:160px">
								<?php 
								$ds = $mysqli->query('SELECT id, name FROM destinations ORDER BY name ASC');
								if ($ds) {
									while ($d=$ds->fetch_assoc()): 
								?>
									<option value="<?php echo (int)$d['id']; ?>" <?php if ($d['id']==$row['destination_id']) echo 'selected'; ?>><?php echo htmlspecialchars($d['name']); ?></option>
								<?php 
									endwhile;
									$ds->free_result();
								}
								?>
							</select>
							<input class="form-control form-control-sm" style="width:160px" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
							<input type="number" step="0.01" class="form-control form-control-sm" style="width:120px" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">
							<input class="form-control form-control-sm" style="width:120px" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>">
							<input type="file" class="form-control form-control-sm" style="width:200px" name="image" accept="image/*">
							<button class="btn btn-sm btn-primary">Save</button>
						</form>
						<form method="post" class="d-inline ms-1" onsubmit="return confirm('Delete this package?');">
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
