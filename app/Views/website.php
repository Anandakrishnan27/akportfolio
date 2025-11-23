<body>
    <!-- Header with Navigation -->
    <header>
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-rocket"></i>
                <span>Nexus</span>
            </div>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            <nav>
                <ul id="navMenu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">
            <!-- Hero Section -->
            <section class="hero" id="home">
                <h1>Welcome to Our Interactive Website</h1>
                <p>Discover a beautifully designed, responsive, and interactive experience with all the components you
                    need.</p>
                <div class="hero-buttons">
                    <a href="#features" class="btn">Explore Features</a>
                    <a href="#contact" class="btn btn-outline">Contact Us</a>
                </div>
            </section>

            <!-- Features Section -->
            <section class="features" id="features">
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h3>Lightning Fast</h3>
                    <p>Optimized for speed and performance on all devices.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Fully Responsive</h3>
                    <p>Looks amazing on desktop, tablet, and mobile devices.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Modern Design</h3>
                    <p>Clean, modern aesthetic with thoughtful animations.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Secure & Reliable</h3>
                    <p>Built with security best practices in mind.</p>
                </div>
            </section>
            <!-- Dynamic Carousal -->
            <div>{{ home_slider }}</div>

            <!-- Contact Form -->
            <section class="contact-form" id="contact">
                <h2>Get In Touch</h2>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Nexus</h3>
                <p>Creating beautiful digital experiences that inspire and engage users worldwide.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">UI/UX Design</a></li>
                    <li><a href="#">Mobile Apps</a></li>
                    <li><a href="#">SEO Optimization</a></li>
                    <li><a href="#">Digital Marketing</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt"></i> 123 Design Street, CA</li>
                    <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-envelope"></i> info@nexus.com</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Nexus. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.getElementById('navMenu');

        mobileMenuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Smooth Scrolling for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    navMenu.classList.remove('active');
                }
            });
        });

        // Form Submission Handling
        const contactForm = document.getElementById('contactForm');

        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            // Simple validation
            if (name && email && message) {
                // In a real application, you would send this to a server
                alert(`Thank you, ${name}! Your message has been sent. We'll contact you at ${email} soon.`);
                contactForm.reset();
            } else {
                alert('Please fill in all fields.');
            }
        });

        // Header scroll effect
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
                header.style.background =
                    'linear-gradient(135deg, rgba(67, 97, 238, 0.95), rgba(63, 55, 201, 0.95))';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
                header.style.background = 'linear-gradient(135deg, var(--primary), var(--secondary))';
            }
        });
    </script>
</body>

</html>