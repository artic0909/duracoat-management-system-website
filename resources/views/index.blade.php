<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duracoat - Management System</title>
    <!-- icon -->
    <link rel="icon" type="image/ico" href="../assets/img/favicon.ico">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            overflow-x: hidden;
            background: #ffffff;
            min-height: 100vh;
            color: #1a1a1a;
            line-height: 1.6;
        }

        /* Subtle animated background */
        .bg-gradient {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            opacity: 0.03;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(5deg); }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Professional Header */
        header {
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo-section {
            display: flex;
            align-items: start;
            flex-direction: column;
        }

        /* .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            font-weight: 900;
        } */

        .logo-text h1 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .logo-text p {
            font-size: 12px;
            color: #666;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-nav {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: #666;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #667eea;
        }

        .contact-btn {
            padding: 10px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 20px 80px;
            text-align: center;
        }

        .hero-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(30px);
            border-radius: 24px;
            padding: 80px 60px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.9);
            max-width: 1100px;
            margin: 0 auto;
        }

        .typewriter-text {
            font-size: clamp(36px, 6vw, 72px);
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .typewriter-text::after {
            content: '|';
            animation: blink 0.8s infinite;
            margin-left: 5px;
            color: #667eea;
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }

        .hero-description {
            font-size: clamp(18px, 2vw, 22px);
            color: #4a5568;
            max-width: 800px;
            margin: 0 auto 40px;
            font-weight: 400;
            line-height: 1.7;
        }

        .cta-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .cta-button {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 18px 40px;
            font-size: 18px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: wave 3s infinite;
        }

        @keyframes wave {
            0% { left: -100%; }
            50%, 100% { left: 100%; }
        }

        .arrow {
            font-size: 20px;
            animation: arrowMove 1.5s ease-in-out infinite;
        }

        @keyframes arrowMove {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(8px); }
        }

        .cta-secondary {
            padding: 18px 40px;
            font-size: 18px;
            font-weight: 600;
            color: #667eea;
            background: white;
            border: 2px solid #667eea;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cta-secondary:hover {
            background: #667eea;
            color: white;
        }

        /* Color Palette Section */
        .color-section {
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 15px;
            letter-spacing: -1px;
        }

        .section-subtitle {
            font-size: clamp(16px, 2vw, 20px);
            color: #666;
            font-weight: 400;
        }

        .color-scroll-wrapper {
            position: relative;
            margin-top: 40px;
        }

        .color-scroll-container {
            overflow: hidden;
            white-space: nowrap;
            padding: 30px 0;
            position: relative;
        }

        .color-grid {
            display: inline-flex;
            gap: 20px;
            animation: scroll 60s linear infinite;
        }

        .color-grid:hover {
            animation-play-state: paused;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .color-box {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            min-width: 140px;
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .color-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .color-sample {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .color-code {
            font-size: 14px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .color-name {
            font-size: 12px;
            color: #999;
            font-weight: 500;
            text-align: center;
            white-space: normal;
        }

        /* Features Section */
        .features-section {
            padding: 80px 20px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .feature-card {
            background: white;
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 25px;
        }

        .feature-card h3 {
            font-size: 22px;
            color: #1a1a1a;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .feature-card p {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
        }

        /* Info Section */
        .info-section {
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
        }

        .info-glass {
            background: white;
            backdrop-filter: blur(30px);
            border-radius: 24px;
            padding: 60px 50px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 35px;
            margin-top: 40px;
        }

        .info-item {
            display: flex;
            gap: 20px;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .info-content h4 {
            font-size: 18px;
            color: #1a1a1a;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .info-content p {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
        }

        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .stat-card {
            background: rgba(102, 126, 234, 0.05);
            padding: 40px 30px;
            border-radius: 16px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: scale(1.05);
        }

        .stat-number {
            font-size: 48px;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 16px;
            color: #666;
            font-weight: 600;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 20px 30px;
            margin-top: 80px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .footer-section p,
        .footer-section a {
            color: #999;
            text-decoration: none;
            font-size: 14px;
            line-height: 2;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #333;
            color: #999;
            font-size: 14px;
        }

        .website-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }

        .website-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .header-nav {
                display: none;
            }

            .hero-glass {
                padding: 50px 30px;
            }

            .typewriter-text {
                min-height: 150px;
            }

            .cta-container {
                flex-direction: column;
            }

            .info-glass {
                padding: 40px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-gradient"></div>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <div class="logo-icon"><img src="logo.png" width="180" alt=""></div>
                    <div class="logo-text">
                        <p>Powder Management System</p>
                    </div>
                </div>
                <nav class="header-nav">
                    <a href="#features" class="nav-link">Features</a>
                    <a href="#colors" class="nav-link">Colors</a>
                    <a href="#about" class="nav-link">About</a>
                    <button class="contact-btn">Contact Us</button>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-glass">
                    <div class="typewriter-text" id="typewriter"></div>
                    <p class="hero-description">
                        Complete digital solution for powder coating businesses. Manage orders, track inventory, 
                        access 500+ RAL colors, and streamline your entire operation with our professional platform.
                    </p>
                    <div class="cta-container">
                        <a href="{{ route('manager.login') }}" class="cta-button">
                            <span>Get Started With Manager</span>
                            <span class="arrow">→</span>
                        </a>
                        <a href="./admin/login.html" class="cta-secondary">Admin</a>
                        <a href="./admin/login.html" class="cta-secondary">Viewer</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="color-section" id="colors">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">RAL Color Palette Collection</h2>
                    <p class="section-subtitle">Professional powder coating colors at your fingertips</p>
                </div>
                <div class="color-scroll-wrapper">
                    <div class="color-scroll-container">
                        <div class="color-grid" id="colorGrid"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features-section" id="features">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Powerful Features</h2>
                    <p class="section-subtitle">Everything you need to manage your powder coating business</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3>Order Management</h3>
                        <p>Track and manage all orders in real-time with automated workflows, status updates, and comprehensive order history.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎨</div>
                        <h3>Color Database</h3>
                        <p>Access complete RAL and Pantone color codes with custom formulations and instant color matching capabilities.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📦</div>
                        <h3>Inventory Control</h3>
                        <p>Monitor powder stock levels with automatic reorder alerts and integrated supplier management system.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">👥</div>
                        <h3>Client Portal</h3>
                        <p>Provide clients with real-time order tracking, history access, and instant quote request functionality.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Billing & Invoicing</h3>
                        <p>Automated invoice generation with integrated payment tracking and comprehensive financial reporting.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📈</div>
                        <h3>Analytics Dashboard</h3>
                        <p>Real-time business insights including performance metrics, popular colors, and detailed revenue trends.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="info-section" id="about">
            <div class="container">
                <div class="info-glass">
                    <div class="section-header">
                        <h2 class="section-title">Why Choose Duracoat?</h2>
                        <p class="section-subtitle">Built specifically for powder coating professionals</p>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">✅</div>
                            <div class="info-content">
                                <h4>Industry Specific</h4>
                                <p>Exclusively designed for powder coating businesses with tailored workflows and features.</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">🔒</div>
                            <div class="info-content">
                                <h4>Secure & Reliable</h4>
                                <p>Enterprise-grade security with automated backups and guaranteed 99.9% uptime.</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">📱</div>
                            <div class="info-content">
                                <h4>Mobile Ready</h4>
                                <p>Access your business data anywhere, anytime from any device with responsive design.</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">⚡</div>
                            <div class="info-content">
                                <h4>Quick Setup</h4>
                                <p>Get started in minutes with easy onboarding and dedicated support team.</p>
                            </div>
                        </div>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Color Codes</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">System Access</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Cloud Based</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">99.9%</div>
                            <div class="stat-label">Uptime</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>DURACOAT</h3>
                    <p>Professional powder coating management system for modern businesses.</p>
                    <p style="margin-top: 20px;">
                        <a href="https://www.duracoat.co.in" class="website-link">www.duracoat.co.in</a>
                    </p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <p><a href="#features">Features</a></p>
                    <p><a href="#colors">Colors</a></p>
                    <p><a href="#about">About Us</a></p>
                    <p><a href="#">Pricing</a></p>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>Email: info@duracoat.co.in</p>
                    <p>Support: support@duracoat.co.in</p>
                    <p>Phone: +91 XXX XXX XXXX</p>
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <p><a href="#">Privacy Policy</a></p>
                    <p><a href="#">Terms of Service</a></p>
                    <p><a href="#">Cookie Policy</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 Duracoat. All rights reserved. Professional Powder Coating Management System.</p>
            </div>
        </div>
    </footer>

    <script>
        // Multiple typewriter texts
        const texts = [
            "Manage Your Colors Professionally",
            "Track Orders Efficiently",
            "Streamline Your Business",
            "Access 500+ RAL Color Codes",
            "Real-Time Inventory Management",
            "Automate Your Workflow"
        ];
        
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const typewriterElement = document.getElementById('typewriter');

        function typeWriter() {
            const currentText = texts[textIndex];
            
            if (!isDeleting && charIndex < currentText.length) {
                typewriterElement.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
                setTimeout(typeWriter, 80);
            } else if (isDeleting && charIndex > 0) {
                typewriterElement.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
                setTimeout(typeWriter, 40);
            } else if (!isDeleting && charIndex === currentText.length) {
                setTimeout(() => {
                    isDeleting = true;
                    typeWriter();
                }, 2500);
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                setTimeout(typeWriter, 500);
            }
        }

        window.addEventListener('load', () => {
            setTimeout(typeWriter, 500);
        });

        // RAL Color Database
        const ralColors = [
            { code: 'RAL 1000', name: 'Green Beige', hex: '#BEBD7F' },
            { code: 'RAL 1001', name: 'Beige', hex: '#C2B078' },
            { code: 'RAL 1002', name: 'Sand Yellow', hex: '#C6A664' },
            { code: 'RAL 1003', name: 'Signal Yellow', hex: '#E5BE01' },
            { code: 'RAL 1004', name: 'Golden Yellow', hex: '#CDA434' },
            { code: 'RAL 1005', name: 'Honey Yellow', hex: '#A98307' },
            { code: 'RAL 1006', name: 'Maize Yellow', hex: '#E4A010' },
            { code: 'RAL 1007', name: 'Daffodil Yellow', hex: '#DC9D00' },
            { code: 'RAL 2000', name: 'Yellow Orange', hex: '#ED760E' },
            { code: 'RAL 2001', name: 'Red Orange', hex: '#C93C20' },
            { code: 'RAL 2002', name: 'Vermilion', hex: '#CB2821' },
            { code: 'RAL 2003', name: 'Pastel Orange', hex: '#FF7514' },
            { code: 'RAL 2004', name: 'Pure Orange', hex: '#F44611' },
            { code: 'RAL 3000', name: 'Flame Red', hex: '#AF2B1E' },
            { code: 'RAL 3001', name: 'Signal Red', hex: '#A52019' },
            { code: 'RAL 3002', name: 'Carmine Red', hex: '#A2231D' },
            { code: 'RAL 3003', name: 'Ruby Red', hex: '#9B111E' },
            { code: 'RAL 3004', name: 'Purple Red', hex: '#75151E' },
            { code: 'RAL 3005', name: 'Wine Red', hex: '#5E2129' },
            { code: 'RAL 4001', name: 'Red Lilac', hex: '#6D3F5B' },
            { code: 'RAL 4002', name: 'Red Violet', hex: '#922B3E' },
            { code: 'RAL 4003', name: 'Heather Violet', hex: '#DE4C8A' },
            { code: 'RAL 4004', name: 'Claret Violet', hex: '#641C34' },
            { code: 'RAL 5000', name: 'Violet Blue', hex: '#354D73' },
            { code: 'RAL 5001', name: 'Green Blue', hex: '#1F3438' },
            { code: 'RAL 5002', name: 'Ultramarine Blue', hex: '#20214F' },
            { code: 'RAL 5003', name: 'Sapphire Blue', hex: '#1D1E33' },
            { code: 'RAL 5004', name: 'Black Blue', hex: '#18171C' },
            { code: 'RAL 5005', name: 'Signal Blue', hex: '#1E2460' },
            { code: 'RAL 5007', name: 'Brilliant Blue', hex: '#3E5F8A' },
            { code: 'RAL 5008', name: 'Grey Blue', hex: '#26252D' },
            { code: 'RAL 5009', name: 'Azure Blue', hex: '#025669' },
            { code: 'RAL 5010', name: 'Gentian Blue', hex: '#0E4194' },
            { code: 'RAL 5011', name: 'Steel Blue', hex: '#231A24' },
            { code: 'RAL 5012', name: 'Light Blue', hex: '#3B83BD' },
            { code: 'RAL 5013', name: 'Cobalt Blue', hex: '#1E213D' },
            { code: 'RAL 5014', name: 'Pigeon Blue', hex: '#606E8C' },
            { code: 'RAL 5015', name: 'Sky Blue', hex: '#2271B3' },
            { code: 'RAL 6000', name: 'Patina Green', hex: '#316650' },
            { code: 'RAL 6001', name: 'Emerald Green', hex: '#287233' },
            { code: 'RAL 6002', name: 'Leaf Green', hex: '#2D572C' },
            { code: 'RAL 6003', name: 'Olive Green', hex: '#424632' },
            { code: 'RAL 6004', name: 'Blue Green', hex: '#1F3A3D' },
            { code: 'RAL 6005', name: 'Moss Green', hex: '#2F4F4F' },
            { code: 'RAL 6006', name: 'Grey Olive', hex: '#3E3B32' },
            { code: 'RAL 6007', name: 'Bottle Green', hex: '#343B29' },
            { code: 'RAL 6008', name: 'Brown Green', hex: '#39352A' },
            { code: 'RAL 6009', name: 'Fir Green', hex: '#31372B' },
            { code: 'RAL 6010', name: 'Grass Green', hex: '#35682D' },
            { code: 'RAL 6011', name: 'Reseda Green', hex: '#587246' },
            { code: 'RAL 6012', name: 'Black Green', hex: '#343E40' },
            { code: 'RAL 6013', name: 'Reed Green', hex: '#6C7156' },
            { code: 'RAL 6014', name: 'Yellow Olive', hex: '#47402E' },
            { code: 'RAL 6015', name: 'Black Olive', hex: '#3B3C36' },
            { code: 'RAL 6016', name: 'Turquoise Green', hex: '#1E5945' },
            { code: 'RAL 6017', name: 'May Green', hex: '#4C9141' },
            { code: 'RAL 6018', name: 'Yellow Green', hex: '#57A639' },
            { code: 'RAL 6019', name: 'Pastel Green', hex: '#BDECB6' },
            { code: 'RAL 6020', name: 'Chrome Green', hex: '#2E3A23' },
            { code: 'RAL 6021', name: 'Pale Green', hex: '#89AC76' },
            { code: 'RAL 7000', name: 'Squirrel Grey', hex: '#78858B' },
            { code: 'RAL 7001', name: 'Silver Grey', hex: '#8A9597' },
            { code: 'RAL 7002', name: 'Olive Grey', hex: '#7E7B52' },
            { code: 'RAL 7003', name: 'Moss Grey', hex: '#6C7059' },
            { code: 'RAL 7004', name: 'Signal Grey', hex: '#969992' },
            { code: 'RAL 7005', name: 'Mouse Grey', hex: '#646B63' },
            { code: 'RAL 7006', name: 'Beige Grey', hex: '#6D6552' },
            { code: 'RAL 7008', name: 'Khaki Grey', hex: '#6A5F31' },
            { code: 'RAL 7009', name: 'Green Grey', hex: '#4D5645' },
            { code: 'RAL 7010', name: 'Tarpaulin Grey', hex: '#4C514A' },
            { code: 'RAL 7011', name: 'Iron Grey', hex: '#434B4D' },
            { code: 'RAL 7012', name: 'Basalt Grey', hex: '#4E5754' },
            { code: 'RAL 7013', name: 'Brown Grey', hex: '#464531' },
            { code: 'RAL 7015', name: 'Slate Grey', hex: '#434750' },
            { code: 'RAL 7016', name: 'Anthracite Grey', hex: '#293133' },
            { code: 'RAL 8000', name: 'Green Brown', hex: '#826C34' },
            { code: 'RAL 8001', name: 'Ochre Brown', hex: '#955F20' },
            { code: 'RAL 8002', name: 'Signal Brown', hex: '#6C3B2A' },
            { code: 'RAL 8003', name: 'Clay Brown', hex: '#734222' },
            { code: 'RAL 8004', name: 'Copper Brown', hex: '#8E402A' },
            { code: 'RAL 8007', name: 'Fawn Brown', hex: '#59351F' },
            { code: 'RAL 8008', name: 'Olive Brown', hex: '#6F4F28' },
            { code: 'RAL 8011', name: 'Nut Brown', hex: '#5B3A29' },
            { code: 'RAL 8012', name: 'Red Brown', hex: '#592321' },
            { code: 'RAL 8014', name: 'Sepia Brown', hex: '#382C1E' },
            { code: 'RAL 8015', name: 'Chestnut Brown', hex: '#633A34' },
            { code: 'RAL 8016', name: 'Mahogany Brown', hex: '#4C2F27' },
            { code: 'RAL 8017', name: 'Chocolate Brown', hex: '#45322E' },
            { code: 'RAL 8019', name: 'Grey Brown', hex: '#403A3A' },
            { code: 'RAL 8022', name: 'Black Brown', hex: '#212121' },
            { code: 'RAL 8023', name: 'Orange Brown', hex: '#A65E2E' },
            { code: 'RAL 8024', name: 'Beige Brown', hex: '#79553D' },
            { code: 'RAL 8025', name: 'Pale Brown', hex: '#755C48' },
            { code: 'RAL 8028', name: 'Terra Brown', hex: '#4E3B31' },
            { code: 'RAL 9001', name: 'Cream', hex: '#FDF4E3' },
            { code: 'RAL 9002', name: 'Grey White', hex: '#E7EBDA' },
            { code: 'RAL 9003', name: 'Signal White', hex: '#F4F4F4' },
            { code: 'RAL 9004', name: 'Signal Black', hex: '#282828' },
            { code: 'RAL 9005', name: 'Jet Black', hex: '#0A0A0A' },
            { code: 'RAL 9006', name: 'White Aluminium', hex: '#A5A5A5' },
            { code: 'RAL 9007', name: 'Grey Aluminium', hex: '#8F8F8F' },
            { code: 'RAL 9010', name: 'Pure White', hex: '#FFFFFF' },
            { code: 'RAL 9011', name: 'Graphite Black', hex: '#1C1C1C' },
            { code: 'RAL 9016', name: 'Traffic White', hex: '#F6F6F6' },
            { code: 'RAL 9017', name: 'Traffic Black', hex: '#1E1E1E' },
            { code: 'RAL 9018', name: 'Papyrus White', hex: '#D7D7D7' }
        ];

        // Generate color boxes (duplicate for infinite loop)
        const colorGrid = document.getElementById('colorGrid');
        
        // Add colors twice for seamless loop
        const addColors = () => {
            ralColors.forEach(color => {
                const colorBox = document.createElement('div');
                colorBox.className = 'color-box';
                colorBox.innerHTML = `
                    <div class="color-sample" style="background-color: ${color.hex}"></div>
                    <div class="color-code">${color.code}</div>
                    <div class="color-name">${color.name}</div>
                `;
                colorGrid.appendChild(colorBox);
            });
        };
        
        // Add colors twice for seamless infinite scroll
        addColors();
        addColors();

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>