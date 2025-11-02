<?php require __DIR__.'/includes/db.php'; ?>
<?php include __DIR__.'/includes/header.php'; ?>
<div class="hero mb-5">
	<div class="hero-overlay">
		<div class="hero-content">
			<h1 class="display-4 fw-bold">Plan. Book. Explore.</h1>
			<p class="lead mb-4">Discover amazing destinations and curated travel packages with Travel Mate</p>
			<div class="hero-buttons">
				<a href="<?php echo url('destinations.php'); ?>" class="btn btn-light btn-lg me-2">Explore Destinations</a>
				<a href="<?php echo url('packages.php'); ?>" class="btn btn-outline-light btn-lg">View Packages</a>
			</div>
		</div>
	</div>
</div>

<div class="row g-4 mb-5">
	<div class="col-md-4">
		<div class="card h-100 shadow-sm">
			<div class="card-body text-center">
				<div class="mb-3">
					<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea;">
						<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
					</svg>
				</div>
				<h5 class="card-title">Popular Destinations</h5>
				<p class="card-text">Browse handpicked places across the globe and discover your next adventure.</p>
				<a href="<?php echo url('destinations.php'); ?>" class="btn btn-primary mt-3">Browse Destinations</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card h-100 shadow-sm">
			<div class="card-body text-center">
				<div class="mb-3">
					<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea;">
						<path d="M20 6h-2.18c.11-.31.18-.65.18-1a2.996 2.996 0 0 0-5.5-1.65l-.5.67-.5-.68C10.96 2.54 10 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z" fill="currentColor"/>
					</svg>
				</div>
				<h5 class="card-title">Affordable Packages</h5>
				<p class="card-text">Transparent pricing, flexible durations, and instant booking for your convenience.</p>
				<a href="<?php echo url('packages.php'); ?>" class="btn btn-primary mt-3">See Packages</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card h-100 shadow-sm">
			<div class="card-body text-center">
				<div class="mb-3">
					<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea;">
						<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
					</svg>
				</div>
				<h5 class="card-title">Your Account</h5>
				<p class="card-text">Register or sign in to manage your bookings and travel history seamlessly.</p>
				<?php if (empty($_SESSION['user'])): ?>
					<a href="<?php echo url('register.php'); ?>" class="btn btn-outline-primary me-2 mt-3">Register</a>
					<a href="<?php echo url('login.php'); ?>" class="btn btn-primary mt-3">Login</a>
				<?php else: ?>
					<a href="<?php echo url('profile.php'); ?>" class="btn btn-primary mt-3">My Profile</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="row mt-5 mb-5">
	<div class="col-md-12">
		<div class="card shadow-sm">
			<div class="card-body p-4">
				<div class="d-flex align-items-center mb-4">
					<svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea; margin-right: 12px;">
						<path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<h4 class="card-title mb-0">Weather Forecast</h4>
				</div>
				<div id="weather-widget" class="mb-3">
					<div class="input-group input-group-lg mb-3" style="max-width: 400px;">
						<span class="input-group-text bg-light">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>
						<input type="text" class="form-control" id="weather-city" placeholder="Enter city name (e.g., London, New York, Tokyo)" value="London">
						<button class="btn btn-primary" type="button" id="weather-btn">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 6px;">
								<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							Get Weather
						</button>
					</div>
					<div id="weather-result" class="mt-3"></div>
				</div>
				<small class="text-muted d-block mt-3">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
						<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					Powered by Open-Meteo (Free Weather API)
				</small>
			</div>
		</div>
	</div>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
