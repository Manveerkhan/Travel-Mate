<?php include __DIR__.'/includes/header.php'; ?>

<!-- Hero Section -->
<div class="hero mb-5" style="min-height: 400px;">
	<div class="hero-overlay" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.85) 0%, rgba(118, 75, 162, 0.85) 100%), url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80') no-repeat center center / cover;">
		<div class="text-center">
			<h1 class="display-4 fw-bold mb-3">Get In Touch</h1>
			<p class="lead">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
		</div>
	</div>
</div>

<div class="row g-4 mb-5">
	<!-- Contact Form -->
	<div class="col-lg-8">
		<div class="card shadow-sm">
			<div class="card-body p-4">
				<h3 class="card-title mb-4">Send us a Message</h3>
				<form id="contactForm">
					<div class="mb-4">
						<label for="contactName" class="form-label fw-semibold">Your Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control form-control-lg" id="contactName" placeholder="Enter your full name" required>
					</div>
					<div class="mb-4">
						<label for="contactEmail" class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
						<input type="email" class="form-control form-control-lg" id="contactEmail" placeholder="you@example.com" required>
					</div>
					<div class="mb-4">
						<label for="contactSubject" class="form-label fw-semibold">Subject</label>
						<input type="text" class="form-control form-control-lg" id="contactSubject" placeholder="What is this regarding?">
					</div>
					<div class="mb-4">
						<label for="contactMessage" class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
						<textarea class="form-control" id="contactMessage" rows="6" placeholder="Tell us how we can help you..." required></textarea>
					</div>
					<button class="btn btn-primary btn-lg" type="submit">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 8px;">
							<line x1="22" y1="2" x2="11" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<polygon points="22 2 15 22 11 13 2 9 22 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						Send Message
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Contact Information -->
	<div class="col-lg-4">
		<div class="card shadow-sm mb-4">
			<div class="card-body p-4">
				<h4 class="card-title mb-4">Contact Information</h4>
				
				<div class="mb-4">
					<div class="d-flex align-items-start mb-3">
						<div class="me-3">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea;">
								<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
						<div>
							<h6 class="mb-1 fw-semibold">Address</h6>
							<p class="text-muted mb-0 small">Gharuan<br>Mohali<br>India</p>
						</div>
					</div>
				</div>

				<div class="mb-4">
					<div class="d-flex align-items-start mb-3">
						<div class="me-3">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea;">
								<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
						<div>
							<h6 class="mb-1 fw-semibold">Phone</h6>
							<p class="text-muted mb-0 small">
								<a href="tel:+91 7009808750" class="text-decoration-none">+91 7009808750</a><br>
							</p>
						</div>
					</div>
				</div>

				<div class="mb-4">
					<div class="d-flex align-items-start mb-3">
						<div class="me-3">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea;">
								<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
						<div>
							<h6 class="mb-1 fw-semibold">Email</h6>
							<p class="text-muted mb-0 small">
								<a href="mailto:info@travelmate.com" class="text-decoration-none">info@travelmate.com</a><br>
								<a href="mailto:support@travelmate.com" class="text-decoration-none">support@travelmate.com</a>
							</p>
						</div>
					</div>
				</div>

				<div>
					<div class="d-flex align-items-start">
						<div class="me-3">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea;">
								<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<polyline points="12 6 12 12 16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
						<div>
							<h6 class="mb-1 fw-semibold">Business Hours</h6>
							<p class="text-muted mb-0 small">
								Monday - Friday: 9:00 AM - 6:00 PM<br>
								Saturday: 10:00 AM - 4:00 PM<br>
								Sunday: Closed
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Quick Links -->
		<div class="card shadow-sm">
			<div class="card-body p-4">
				<h5 class="card-title mb-3">Quick Links</h5>
				<ul class="list-unstyled mb-0">
					<li class="mb-2">
						<a href="<?php echo url('about.php'); ?>" class="text-decoration-none d-flex align-items-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea; margin-right: 8px;">
								<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							About Us
						</a>
					</li>
					<li class="mb-2">
						<a href="<?php echo url('packages.php'); ?>" class="text-decoration-none d-flex align-items-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea; margin-right: 8px;">
								<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							View Packages
						</a>
					</li>
					<li class="mb-2">
						<a href="<?php echo url('destinations.php'); ?>" class="text-decoration-none d-flex align-items-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea; margin-right: 8px;">
								<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							Explore Destinations
						</a>
					</li>
					<li>
						<a href="<?php echo url('register.php'); ?>" class="text-decoration-none d-flex align-items-center">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #667eea; margin-right: 8px;">
								<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							Create Account
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
	e.preventDefault();
	alert('Thank you for your message! We will get back to you soon.');
	this.reset();
});
</script>

<?php include __DIR__.'/includes/footer.php'; ?>
