<?php require __DIR__.'/../includes/db.php'; ?>
<?php require __DIR__.'/../includes/auth.php'; ?>
<?php require_once __DIR__.'/../includes/config.php'; ?>
<?php if (!empty($_SESSION['admin'])) { header('Location: ' . url('dashboard.php')); exit; } ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login - Travel Mate</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<a class="nav-link" href="http://localhost/travel/">Home</a>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-5">
			<div class="card shadow-sm">
				<div class="card-body">
					<h3 class="mb-3">Admin Login</h3>
					<?php
					$errors = [];
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						$username = trim($_POST['username'] ?? '');
						$password = $_POST['password'] ?? '';
						$stmt = $mysqli->prepare('SELECT * FROM admin WHERE username = ?');
						$stmt->bind_param('s', $username);
						$stmt->execute();
						$admin = $stmt->get_result()->fetch_assoc();
						if ($admin && password_verify($password, $admin['password'])) {
							$_SESSION['admin'] = ['id' => $admin['id'], 'username' => $admin['username']];
							header('Location: ' . url('dashboard.php'));
							exit;
						} else {
							$errors[] = 'Invalid credentials.';
						}
					}
					?>
					<?php if ($errors): ?><div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div><?php endif; ?>
					<form method="post">
						<div class="mb-3">
							<label class="form-label">Username</label>
							<input class="form-control" name="username" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="password" class="form-control" name="password" required>
						</div>
						<button class="btn btn-primary w-100">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
