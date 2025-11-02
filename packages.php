<?php require __DIR__.'/includes/db.php'; ?>
<?php include __DIR__.'/includes/header.php'; ?>
<?php
$destinationId = isset($_GET['destination_id']) ? (int)$_GET['destination_id'] : 0;
$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$sql = 'SELECT p.*, d.name AS destination_name FROM packages p JOIN destinations d ON d.id = p.destination_id';
$where = [];
$params = [];
$types = '';
if ($destinationId > 0) { $where[] = 'p.destination_id = ?'; $params[] = $destinationId; $types .= 'i'; }
if ($q !== '') { $where[] = '(p.title LIKE ? OR d.name LIKE ?)'; $params[] = "%$q%"; $params[] = "%$q%"; $types .= 'ss'; }
if ($where) { $sql .= ' WHERE ' . implode(' AND ', $where); }
$sql .= ' ORDER BY p.id DESC';

if ($params) {
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param($types, ...$params);
	$stmt->execute();
	$result = $stmt->get_result();
} else {
	$result = $mysqli->query($sql);
}
?>
<div class="d-flex justify-content-between align-items-center mb-3">
	<h2 class="mb-0">Packages</h2>
	<form class="d-flex" method="get" data-search-form>
		<?php if ($destinationId): ?><input type="hidden" name="destination_id" value="<?php echo $destinationId; ?>"><?php endif; ?>
		<input class="form-control me-2" type="search" name="q" placeholder="Search packages" value="<?php echo htmlspecialchars($q); ?>">
		<button class="btn btn-outline-primary" type="submit">Search</button>
	</form>
</div>
<div class="row g-4">
	<?php while ($row = $result->fetch_assoc()): ?>
		<div class="col-md-4">
			<div class="card h-100">
				<?php if (!empty($row['image'])): ?>
					<img class="card-img-top" src="<?php echo url('uploads/' . htmlspecialchars($row['image'])); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
				<?php endif; ?>
				<div class="card-body d-flex flex-column">
					<h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
					<p class="card-text mb-1"><span class="badge bg-secondary"><?php echo htmlspecialchars($row['destination_name']); ?></span></p>
					<p class="card-text">Duration: <?php echo htmlspecialchars($row['duration']); ?></p>
					<p class="card-text fw-bold">$<?php echo number_format((float)$row['price'], 2); ?></p>
					<a class="btn btn-primary mt-auto" href="<?php echo url('book.php?package_id=' . (int)$row['id']); ?>">Book</a>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
