<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $maintenance_title ?? 'We\'ll be back soon!'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }

        /* Animated background particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { width: 80px; height: 80px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 120px; height: 120px; left: 20%; animation-delay: 0.5s; }
        .particle:nth-child(3) { width: 60px; height: 60px; left: 60%; animation-delay: 1s; }
        .particle:nth-child(4) { width: 100px; height: 100px; left: 70%; animation-delay: 1.5s; }
        .particle:nth-child(5) { width: 40px; height: 40px; left: 85%; animation-delay: 2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.7; }
            50% { transform: translateY(-100px) rotate(180deg); opacity: 1; }
        }

        /* Glassmorphism container */
        .maintenance-container {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .maintenance-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 60px 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            transform: translateY(0);
            animation: cardEntry 1s ease-out;
            position: relative;
            overflow: hidden;
        }

        .maintenance-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shine 3s infinite;
        }

        @keyframes cardEntry {
            0% { opacity: 0; transform: translateY(50px) scale(0.9); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Logo/Icon */
        .maintenance-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            position: relative;
            animation: pulse 2s ease-in-out infinite;
        }

        .maintenance-icon::before {
            content: '🚧';
            font-size: 80px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Typography */
        .maintenance-title {
            color: #ffffff;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            0% { filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3)); }
            100% { filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.6)); }
        }

        .maintenance-message {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 40px;
            font-weight: 300;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Progress bar */
        .progress-container {
            margin: 40px 0;
            animation: fadeInUp 1s ease-out 1s both;
        }

        .progress-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #00f5ff, #0099ff, #00f5ff);
            border-radius: 10px;
            animation: progressAnimation 4s ease-in-out infinite;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: progressShine 2s linear infinite;
        }

        @keyframes progressAnimation {
            0% { width: 10%; }
            50% { width: 70%; }
            100% { width: 90%; }
        }

        @keyframes progressShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Contact info */
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
            animation: fadeInUp 1s ease-out 1.5s both;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 15px 25px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .contact-item:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .contact-item i {
            font-size: 1.2rem;
        }

        /* Social links */
        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            animation: fadeInUp 1s ease-out 2s both;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .maintenance-card {
                padding: 40px 30px;
                margin: 20px;
            }

            .maintenance-title {
                font-size: 2.5rem;
            }

            .maintenance-message {
                font-size: 1.1rem;
            }

            .contact-info {
                flex-direction: column;
                gap: 15px;
            }

            .contact-item {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .maintenance-title {
                font-size: 2rem;
            }

            .maintenance-message {
                font-size: 1rem;
            }

            .maintenance-card {
                padding: 30px 20px;
            }
        }

        /* Custom background if provided */
        <?php if (isset($maintenance_background) && $maintenance_background): ?>
        body {
            background: url('<?php echo esc_url($maintenance_background); ?>') center/cover no-repeat;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }
        <?php endif; ?>

        /* Loading animation */
        .loading-dots {
            display: inline-flex;
            gap: 5px;
            margin-left: 10px;
        }

        .loading-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            animation: loadingDots 1.5s ease-in-out infinite;
        }

        .loading-dot:nth-child(2) { animation-delay: 0.2s; }
        .loading-dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes loadingDots {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1.2); opacity: 1; }
        }

        /* Floating elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 2;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: floatingElements 20s linear infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            font-size: 2rem;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            left: 80%;
            font-size: 1.5rem;
            animation-delay: 5s;
        }

        .floating-element:nth-child(3) {
            top: 80%;
            left: 20%;
            font-size: 1.8rem;
            animation-delay: 10s;
        }

        @keyframes floatingElements {
            0% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-30px) rotate(90deg); }
            50% { transform: translateY(-60px) rotate(180deg); }
            75% { transform: translateY(-30px) rotate(270deg); }
            100% { transform: translateY(0px) rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Floating background elements -->
    <div class="floating-elements">
        <div class="floating-element">⚙️</div>
        <div class="floating-element">🔧</div>
        <div class="floating-element">💻</div>
    </div>

    <!-- Animated particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Main maintenance container -->
    <div class="maintenance-container">
        <div class="maintenance-card">
            <div class="maintenance-icon"></div>
            
            <h1 class="maintenance-title">
                <?php echo esc_html($maintenance_title ?? 'We\'ll be back soon!'); ?>
            </h1>
            
            <p class="maintenance-message">
                <?php echo esc_html($maintenance_message ?? 'We are currently performing scheduled maintenance to improve your experience. Thank you for your patience!'); ?>
                <span class="loading-dots">
                    <span class="loading-dot"></span>
                    <span class="loading-dot"></span>
                    <span class="loading-dot"></span>
                </span>
            </p>

            <div class="progress-container">
                <div class="progress-label">Maintenance Progress</div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>

            <div class="contact-info">
                <a href="mailto:info@ELRYADcompany.com" class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>Contact Us</span>
                </a>
                <a href="tel:+1234567890" class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>Call Us</span>
                </a>
            </div>

            <div class="social-links">
                <a href="#" class="social-link" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-link" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-link" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-link" aria-label="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        // Add dynamic particles
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = '100%';
            particle.style.width = (Math.random() * 60 + 20) + 'px';
            particle.style.height = particle.style.width;
            particle.style.animationDuration = (Math.random() * 4 + 3) + 's';
            particle.style.animationDelay = Math.random() * 2 + 's';
            
            document.querySelector('.particles').appendChild(particle);

            // Remove particle after animation
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, 8000);
        }

        // Create particles periodically
        setInterval(createParticle, 2000);

        // Add mouse interaction
        document.addEventListener('mousemove', (e) => {
            const card = document.querySelector('.maintenance-card');
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            const rotateX = (y / rect.height) * 10;
            const rotateY = (x / rect.width) * -10;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        // Reset card rotation when mouse leaves
        document.addEventListener('mouseleave', () => {
            const card = document.querySelector('.maintenance-card');
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
        });

        // Auto-refresh every 5 minutes
        setTimeout(() => {
            location.reload();
        }, 300000);

        // Add countdown timer (optional)
        function updateCountdown() {
            const now = new Date().getTime();
            const targetTime = now + (2 * 60 * 60 * 1000); // 2 hours from now
            
            const countdownElement = document.createElement('div');
            countdownElement.style.cssText = `
                color: rgba(255, 255, 255, 0.8);
                font-size: 1rem;
                margin-top: 20px;
                font-weight: 500;
            `;
            
            setInterval(() => {
                const currentTime = new Date().getTime();
                const timeLeft = targetTime - currentTime;
                
                if (timeLeft > 0) {
                    const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    
                    countdownElement.innerHTML = `
                        <i class="fas fa-clock"></i> 
                        Estimated completion: ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}
                    `;
                } else {
                    countdownElement.innerHTML = '<i class="fas fa-check-circle"></i> Maintenance should be complete!';
                }
            }, 1000);
            
            document.querySelector('.maintenance-card').appendChild(countdownElement);
        }

        // Uncomment the line below to enable countdown
        // updateCountdown();
    </script>
</body>
</html>