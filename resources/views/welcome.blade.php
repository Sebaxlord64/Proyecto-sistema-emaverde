<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMA VERDE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2d7848;
            --primary-dark: #245c3a;
            --secondary: #4a5568;
            --light: #f7fafc;
            --dark: #245c3a;
            --accent: #38a169;
            --text: #245c3a;;
            --text-light: #718096;
            --success: #38a169;
            --warning: #dd6b20;
            --border: #e2e8f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(to bottom, #f0fff4, #e2e8f0);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text);
        }
        
        .header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1rem 2rem;
        }
        
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        .logo-icon {
            font-size: 1.8rem;
        }
        
        .nav-links {
            display: flex;
            gap: 1rem;
        }
        
        .nav-link {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary);
            background-color: rgba(72, 187, 120, 0.1);
        }
        
        .nav-link.btn {
            background-color: var(--primary);
            color: white;
        }
        
        .nav-link.btn:hover {
            background-color: var(--primary-dark);
        }
        
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
            text-align: center;
        }
        
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .welcome-subtitle {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 600px;
            line-height: 1.6;
        }
        
        .footer {
            background-color: var(--dark);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-text {
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 1rem;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <i class="fas fa-futbol logo-icon"></i>
                <span>Ema Verde</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="nav-link btn">Registrarse</a>
            </div>
        </nav>
    </header>
    
    <main class="main-content">
        <h1 class="welcome-title">Bienvenido a la plataforma web de Ema Verde</h1>
        <p class="welcome-subtitle">Sistema para la reserva de espacios deportivos</p>
    </main>
    
    <footer class="footer">
        <div class="footer-content">
            <p class="footer-text">2025 - Ema Verde</p>
        </div>
    </footer>

    <script>
        // Efecto de escritura para el título
        document.addEventListener('DOMContentLoaded', function() {
            const welcomeTitle = document.querySelector('.welcome-title');
            const originalText = welcomeTitle.textContent;
            welcomeTitle.textContent = '';
            
            let i = 0;
            const typeWriter = () => {
                if (i < originalText.length) {
                    welcomeTitle.textContent += originalText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            };
            
            setTimeout(typeWriter, 500);
        });
    </script>
</body>
</html>