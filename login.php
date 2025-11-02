<?php require __DIR__.'/includes/db.php'; ?>
<?php include __DIR__.'/includes/header.php'; ?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = trim($_POST['email'] ?? '');
	$password = $_POST['password'] ?? '';
	$stmt = $mysqli->prepare('SELECT * FROM users WHERE email = ?');
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$res = $stmt->get_result();
	$user = $res->fetch_assoc();
	if ($user && password_verify($password, $user['password'])) {
		$_SESSION['user'] = ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']];
		require_once __DIR__.'/includes/config.php';
		header('Location: ' . url('index.php'));
		exit;
	} else {
		$errors[] = 'Invalid credentials.';
	}
}
$registered = isset($_GET['registered']);
?>
<h2>Login</h2>
<?php if ($registered): ?><div class="alert alert-success">Registration successful. Please log in.</div><?php endif; ?>
<?php if ($errors): ?><div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div><?php endif; ?>
<div class="row">
	<div class="col-md-6">
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Email</label>
				<input type="email" class="form-control" name="email" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="password" class="form-control" name="password" required>
			</div>
			<button class="btn btn-primary">Login</button>
			<a href="<?php echo url('register.php'); ?>" class="btn btn-link">Create an account</a>
		</form>
	</div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
