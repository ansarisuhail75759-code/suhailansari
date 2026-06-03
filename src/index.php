<?php
require_once 'seo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Render Dynamic SEO & OpenGraph Headers -->
    <?php renderSeoHeaders(); ?>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php">VOLT & <span>VELOCITY</span></a>
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#inventory">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#technology">Innovation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#testimonials">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#test-drive">Book Drive</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-neon" href="#inventory">Explore Fleet</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content reveal active">
                    <span class="hero-tagline">Uncompromised Power</span>
                    <h1 class="hero-title text-gradient-neon">The Future of Motion is Electric</h1>
                    <p class="hero-desc">
                        Volt & Velocity blends raw electric hypercar dynamics with state-of-the-art autonomous capabilities. Redefine luxury with an range of up to 520 miles and track-tuned engineering.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#test-drive" class="btn btn-neon">Schedule Drive</a>
                        <a href="#inventory" class="btn btn-outline-neon">View Fleet</a>
                    </div>
                    
                    <!-- Specifications Banner -->
                    <div class="row hero-stats">
                        <div class="col-4">
                            <div class="hero-stat-val text-gradient-cyan-blue">1.85s</div>
                            <div class="hero-stat-lbl">0-60 MPH</div>
                        </div>
                        <div class="col-4">
                            <div class="hero-stat-val text-gradient-cyan-blue">520 mi</div>
                            <div class="hero-stat-lbl">Est. Range</div>
                        </div>
                        <div class="col-4">
                            <div class="hero-stat-val text-gradient-cyan-blue">1,900 hp</div>
                            <div class="hero-stat-lbl">Peak Power</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-wrapper mt-5 mt-lg-0 text-center reveal active">
                    <div class="hero-glow-circle"></div>
                    <img src="assets/images/hero_car.png" alt="Volt & Velocity Concept Hypercar" class="hero-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Fleet / Inventory Section -->
    <section id="inventory" class="py-5" style="background-color: #0b0f19; border-top: 1px solid var(--border-glass); border-bottom: 1px solid var(--border-glass);">
        <div class="container py-5">
            <div class="row align-items-end section-title-wrap reveal">
                <div class="col-md-6">
                    <span class="section-subtitle">Exquisite Lineup</span>
                    <h2 class="section-title text-gradient-neon">Meet the V&V Family</h2>
                </div>
                <div class="col-md-6 text-md-end mt-4 mt-md-0">
                    <div class="btn-group gap-2 flex-wrap" role="group">
                        <button type="button" class="btn btn-neon filter-btn" data-filter="all">All Models</button>
                        <button type="button" class="btn btn-outline-neon filter-btn" data-filter="performance">Hypercars</button>
                        <button type="button" class="btn btn-outline-neon filter-btn" data-filter="sedan">Sedans</button>
                        <button type="button" class="btn btn-outline-neon filter-btn" data-filter="suv">SUVs</button>
                    </div>
                </div>
            </div>

            <!-- Dynamic PHP Card Grid -->
            <div class="row g-4 justify-content-center">
                <?php if (!empty($inventory)): ?>
                    <?php foreach ($inventory as $key => $car): ?>
                        <div class="col-md-6 col-lg-4 car-item-col reveal" data-category="<?php echo htmlspecialchars($car['category']); ?>">
                            <div class="card-car">
                                <div class="card-car-img-wrapper">
                                    <span class="card-car-badge"><?php echo htmlspecialchars($car['badge']); ?></span>
                                    <img src="<?php echo htmlspecialchars($car['image']); ?>" class="card-car-img" alt="<?php echo htmlspecialchars($car['name']); ?>">
                                </div>
                                <div class="card-car-body">
                                    <h3 class="card-car-title"><?php echo htmlspecialchars($car['name']); ?></h3>
                                    <div class="card-car-price"><?php echo htmlspecialchars($car['price']); ?> <span>Starting MSRP</span></div>
                                    <p class="text-muted small"><?php echo htmlspecialchars($car['description']); ?></p>
                                    
                                    <div class="row card-car-specs text-center">
                                        <div class="col-4 border-end border-glass">
                                            <span class="card-car-spec-item"><i class="bi bi-lightning-charge"></i>HP</span>
                                            <span class="card-car-spec-val"><?php echo htmlspecialchars($car['hp']); ?></span>
                                        </div>
                                        <div class="col-4 border-end border-glass">
                                            <span class="card-car-spec-item"><i class="bi bi-speedometer"></i>0-60</span>
                                            <span class="card-car-spec-val"><?php echo htmlspecialchars($car['zeroToSixty']); ?></span>
                                        </div>
                                        <div class="col-4">
                                            <span class="card-car-spec-item"><i class="bi bi-battery-charging"></i>Range</span>
                                            <span class="card-car-spec-val"><?php echo htmlspecialchars($car['range']); ?></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Dynamic SEO Share / Detail Link Link -->
                                    <div class="mt-3 text-center">
                                        <a href="index.php?car=<?php echo urlencode($key); ?>#inventory" class="text-decoration-none small text-gradient-cyan-blue fw-bold">
                                            <i class="bi bi-link-45deg"></i> Focus SEO Meta Details
                                        </a>
                                    </div>
                                </div>
                                <div class="card-car-footer">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button class="btn btn-neon w-100 btn-book-now" data-model="<?php echo htmlspecialchars($key); ?>">Reserve</button>
                                        </div>
                                        <div class="col-6">
                                            <a href="#test-drive" class="btn btn-outline-neon w-100 btn-book-now" data-model="<?php echo htmlspecialchars($key); ?>">Test Drive</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No vehicles available in the database.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Innovation / Features Section -->
    <section id="technology" class="py-5 bg-dark">
        <div class="container py-5">
            <div class="text-center section-title-wrap reveal">
                <span class="section-subtitle">V&V Core Engineering</span>
                <h2 class="section-title text-gradient-neon">Pioneering Technologies</h2>
                <p class="text-muted col-md-6 mx-auto mt-3">We don't just build electric vehicles. We create cohesive ecosystems that redefine your relationship with travel.</p>
            </div>

            <div class="row g-4 mt-2">
                <!-- Feature 1 -->
                <div class="col-md-4 reveal">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h3>Cognitive Autopilot</h3>
                        <p>Powered by our custom neuromorphic processors, the V&V Autopilot adapts to real-time city infrastructure and weather conditions seamlessly.</p>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-4 reveal">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-fuel-pump-diesel"></i>
                        </div>
                        <h3>Solid-State Core</h3>
                        <p>Next-gen solid-state battery matrices yield a 40% higher energy density than regular lithium-ion, allowing complete charges in just 9 minutes.</p>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-4 reveal">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h3>Cybernetic Security</h3>
                        <p>Dual-redundant cryptographic architecture keeps your vehicle's drive control data secure from remote breaches and over-the-air hacks.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Statistics / Parallax Section -->
    <section class="parallax-section">
        <div class="container text-center">
            <div class="row g-4 justify-content-center">
                <div class="col-sm-6 col-md-3 reveal">
                    <div class="counter-value">4.8M+</div>
                    <div class="counter-label">Miles Driven Daily</div>
                </div>
                <div class="col-sm-6 col-md-3 reveal">
                    <div class="counter-value">25k+</div>
                    <div class="counter-label">Superchargers Global</div>
                </div>
                <div class="col-sm-6 col-md-3 reveal">
                    <div class="counter-value">99.8%</div>
                    <div class="counter-label">Owner Satisfaction</div>
                </div>
                <div class="col-sm-6 col-md-3 reveal">
                    <div class="counter-value">0g</div>
                    <div class="counter-label">CO₂ Output</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="text-center section-title-wrap reveal">
                <span class="section-subtitle">Real Showcases</span>
                <h2 class="section-title text-gradient-neon">From Our Drivers</h2>
            </div>

            <div id="testimonialCarousel" class="carousel slide reveal" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <!-- Testimonial 1 -->
                    <div class="carousel-item active" data-bs-interval="6000">
                        <div class="testimonial-card">
                            <p class="testimonial-text">
                                "The Aether is an absolute beast. The instantaneous torque leaves conventional supercars in the dust, and the cockpit feels like it's straight out of a spaceship. The steering precision is phenomenal."
                            </p>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">HA</div>
                                <div>
                                    <div class="author-name">Helena Adams</div>
                                    <div class="author-title">Owner of V&V Aether #042</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="carousel-item" data-bs-interval="6000">
                        <div class="testimonial-card">
                            <p class="testimonial-text">
                                "Charging is unbelievably fast. I plugged in the Nexus for a short coffee break and came back to 400 miles of range. Autopilot handled the entire commute back in rush-hour traffic flawlessly."
                            </p>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">MK</div>
                                <div>
                                    <div class="author-name">Marcus Kaelen</div>
                                    <div class="author-title">Executive Tech VP & Nexus Driver</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="carousel-item" data-bs-interval="6000">
                        <div class="testimonial-card">
                            <p class="testimonial-text">
                                "Taking the Zenith up the rocky paths of Tahoe was smooth beyond words. The independent wheel motors adjusted torque instantaneously on ice patches. Best adventure vehicle I've ever owned."
                            </p>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">SL</div>
                                <div>
                                    <div class="author-name">Sarah Lindon</div>
                                    <div class="author-title">Offroad Enthusiast, Zenith Owner</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Test Drive Booking Section -->
    <section id="test-drive" class="contact-section" style="background-color: #0b0f19; border-top: 1px solid var(--border-glass);">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 reveal">
                    <span class="section-subtitle">Experience Center</span>
                    <h2 class="section-title text-gradient-neon mb-4">Book Your Private Showcase Session</h2>
                    <p class="text-muted mb-4">
                        Experience Volt & Velocity first hand. Book an appointment at one of our design lounges. An engineering concierge will walk you through the battery architecture, track telemetry, and customization options before your launch.
                    </p>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="fs-4 text-gradient-cyan-blue"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <div class="fw-bold">Headquarters Center</div>
                            <div class="text-muted small">800 Cyber Boulevard, Suite 10, CA</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="fs-4 text-gradient-cyan-blue"><i class="bi bi-telephone"></i></div>
                        <div>
                            <div class="fw-bold">Concierge Hotline</div>
                            <div class="text-muted small">+1 (800) 555-VOLT</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 reveal">
                    <div class="form-glass">
                        <form id="bookingForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="clientName" class="form-label form-label-custom">Full Name</label>
                                    <input type="text" class="form-control form-control-custom" id="clientName" placeholder="e.g. John Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="clientEmail" class="form-label form-label-custom">Email Address</label>
                                    <input type="email" class="form-control form-control-custom" id="clientEmail" placeholder="e.g. john@example.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="clientPhone" class="form-label form-label-custom">Phone Number</label>
                                    <input type="tel" class="form-control form-control-custom" id="clientPhone" placeholder="+1 (555) 000-0000" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="carModel" class="form-label form-label-custom">Select Model</label>
                                    <select class="form-select form-control form-control-custom form-select-custom" id="carModel" required>
                                        <option value="" disabled selected>Choose a vehicle...</option>
                                        <?php foreach ($inventory as $key => $car): ?>
                                            <option value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($car['name']); ?> (<?php echo htmlspecialchars($car['badge']); ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="bookingDate" class="form-label form-label-custom">Preferred Date</label>
                                    <input type="date" class="form-control form-control-custom" id="bookingDate" required>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-neon w-100 py-3">Book Private Showcase</button>
                                </div>
                            </div>
                        </form>
                        <!-- Form Response Placeholder -->
                        <div id="formResponse" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-logo">VOLT & <span>VELOCITY</span></div>
                    <p class="footer-desc">
                        Redefining automotive paradigms through electric power and smart hardware automation. Handcrafted speed for the modern pioneer.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon-btn" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon-btn" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-icon-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2 offset-lg-1">
                    <h4 class="footer-title">Inventory</h4>
                    <ul class="footer-links">
                        <?php foreach ($inventory as $key => $car): ?>
                            <li><a href="#inventory"><?php echo htmlspecialchars($car['name']); ?></a></li>
                        <?php endforeach; ?>
                        <li><a href="#inventory">Future Concepts</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h4 class="footer-title">Innovations</h4>
                    <ul class="footer-links">
                        <li><a href="#technology">Solid State Cells</a></li>
                        <li><a href="#technology">Autopilot V4</a></li>
                        <li><a href="#technology">OTA Architecture</a></li>
                        <li><a href="#technology">Supercharging V3</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-3">
                    <h4 class="footer-title">Stay Connected</h4>
                    <p class="text-muted small">Subscribe to receive exclusive allocation announcements and concepts.</p>
                    <div class="input-group mb-3 border border-glass rounded-3 overflow-hidden">
                        <input type="email" class="form-control form-control-custom border-0" placeholder="Your Email" aria-label="Your Email">
                        <button class="btn btn-neon rounded-0 border-0" type="button" aria-label="Subscribe"><i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="row footer-bottom text-center text-md-start">
                <div class="col-md-6 mb-2 mb-md-0">
                    &copy; 2026 Volt & Velocity Motor Corporation. All rights reserved.
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-muted me-3 text-decoration-none small">Privacy Policy</a>
                    <a href="#" class="text-muted text-decoration-none small">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="app.js" defer></script>
</body>
</html>
