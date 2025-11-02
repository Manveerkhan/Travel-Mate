<?php require __DIR__.'/includes/db.php'; ?>
<?php include __DIR__.'/includes/header.php'; ?>
<?php
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$sql = 'SELECT * FROM destinations';
$params = [];
if ($q !== '') {
	$sql .= ' WHERE name LIKE ? OR description LIKE ?';
	$like = "%$q%";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param('ss', $like, $like);
	$stmt->execute();
	$result = $stmt->get_result();
} else {
	$result = $mysqli->query($sql);
}
?>
<div class="d-flex justify-content-between align-items-center mb-3">
	<h2 class="mb-0">Destinations</h2>
	<form class="d-flex" method="get" data-search-form>
		<input class="form-control me-2" type="search" name="q" placeholder="Search destinations" value="<?php echo htmlspecialchars($q); ?>">
		<button class="btn btn-outline-primary" type="submit">Search</button>
	</form>
</div>
<div class="row g-4">
	<?php while ($row = $result->fetch_assoc()): ?>
		<div class="col-md-4">
			<div class="card h-100">
				<?php if (!empty($row['image'])): ?>
					<img class="card-img-top" src="<?php echo url('uploads/' . htmlspecialchars($row['image'])); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
				<?php endif; ?>
				<div class="card-body d-flex flex-column">
					<h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
					<p class="card-text flex-grow-1"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
					<a class="btn btn-primary mt-2" href="<?php echo url('packages.php?destination_id=' . (int)$row['id']); ?>">Book Now</a>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
