<?php require __DIR__.'/includes/db.php'; ?>
<?php include __DIR__.'/includes/header.php'; ?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = trim($_POST['name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$password = $_POST['password'] ?? '';
	$confirm = $_POST['confirm'] ?? '';
	if ($name === '' || $email === '' || $password === '') { $errors[] = 'All fields are required.'; }
	if ($password !== $confirm) { $errors[] = 'Passwords do not match.'; }
	if (!$errors) {
		$hash = password_hash($password, PASSWORD_BCRYPT);
		$stmt = $mysqli->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
		$stmt->bind_param('sss', $name, $email, $hash);
		if ($stmt->execute()) {
			require_once __DIR__.'/includes/config.php';
			header('Location: ' . url('login.php?registered=1'));
			exit;
		} else {
			$errors[] = 'Email already registered or server error.';
		}
	}
}
?>
<h2>Create Account</h2>
<?php if ($errors): ?><div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div><?php endif; ?>
<div class="row">
	<div class="col-md-6">
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Email</label>
				<input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="password" class="form-control" name="password" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Confirm Password</label>
				<input type="password" class="form-control" name="confirm" required>
			</div>
			<button class="btn btn-primary">Register</button>
			<a href="<?php echo url('login.php'); ?>" class="btn btn-link">Already have an account?</a>
		</form>
	</div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
