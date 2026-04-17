<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte - Sama CV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <!-- Anti-flash: applique le thème avant le rendu -->
    <script>(function(){if(localStorage.getItem('sama-theme')==='light')document.documentElement.classList.add('light');})()</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ── Thème sombre par défaut ── */
        :root {
            color-scheme: dark;
        }

        html {
            background: #080b14;
            color: #f0f4ff;
        }

        body {
            background: #080b14;
            color: #f0f4ff;
            overflow-x: hidden;
            margin: 0;
        }

        /* ── Mode clair ── */
        html.light {
            color-scheme: light;
            background: #f5f7fb;
            color: #0f172a;
        }

        html.light body {
            background: #f5f7fb;
            color: #0f172a;
        }

        /* ── Gradient mesh background ── */
        .mesh-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(99,102,241,.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 110%, rgba(168,85,247,.14) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 50%, rgba(14,165,233,.07) 0%, transparent 65%);
        }

        html.light .mesh-bg {
            background:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(99,102,241,.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 110%, rgba(168,85,247,.06) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 50%, rgba(14,165,233,.03) 0%, transparent 65%);
        }

        /* ── Container ── */
        .auth-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            padding-top: 6rem;
        }

        /* ── Navbar ── */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(8, 11, 20, .7);
            border-bottom: 1px solid rgba(255, 255, 255, .06);
        }

        html.light .navbar {
            background: rgba(255, 255, 255, .7);
            border-bottom: 1px solid rgba(0, 0, 0, .06);
        }

        .logo {
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -.02em;
            background: linear-gradient(135deg, #818cf8, #a78bfa, #38bdf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        .nav-right {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .15);
            background: rgba(99, 102, 241, .1);
            color: #a5b4fc;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
        }

        html.light .theme-toggle {
            border-color: rgba(0, 0, 0, .1);
            background: rgba(99, 102, 241, .05);
            color: #4f46e5;
        }

        .theme-toggle:hover {
            border-color: rgba(129, 140, 248, .5);
            background: rgba(129, 140, 248, .15);
        }

        /* ── Form Container ── */
        .form-wrapper {
            max-width: 480px;
            width: 100%;
        }

        .form-card {
            background: rgba(15, 23, 42, .7);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 1.25rem;
            padding: 3rem 2.5rem;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, .3);
        }

        html.light .form-card {
            background: rgba(255, 255, 255, .8);
            border-color: rgba(0, 0, 0, .08);
            box-shadow: 0 8px 32px rgba(0, 0, 0, .08);
        }

        /* ── Header ── */
        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: 900;
            margin: 0 0 .5rem;
            letter-spacing: -.02em;
        }

        .form-header p {
            color: #94a3b8;
            margin: 0;
            font-size: .95rem;
        }

        html.light .form-header p {
            color: #64748b;
        }

        /* ── Form Fields ── */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: .875rem;
            font-weight: 600;
            margin-bottom: .5rem;
            color: #cbd5e1;
        }

        html.light .form-label {
            color: #334155;
        }

        .form-input {
            width: 100%;
            padding: .875rem 1rem;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: .75rem;
            background: rgba(30, 41, 59, .5);
            color: #f0f4ff;
            font-size: .95rem;
            transition: all .2s;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(129, 140, 248, .6);
            background: rgba(30, 41, 59, .7);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .1);
        }

        html.light .form-input {
            background: rgba(0, 0, 0, .03);
            border-color: rgba(0, 0, 0, .1);
            color: #0f172a;
        }

        html.light .form-input:focus {
            border-color: rgba(99, 102, 241, .6);
            background: rgba(0, 0, 0, .05);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .05);
        }

        .form-input::placeholder {
            color: #64748b;
        }

        html.light .form-input::placeholder {
            color: #cbd5e1;
        }

        /* ── Password field with eye ── */
        .password-wrapper {
            position: relative;
            margin-bottom: 0.5rem;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: .5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color .2s;
        }

        .password-toggle:hover {
            color: #cbd5e1;
        }

        html.light .password-toggle {
            color: #94a3b8;
        }

        html.light .password-toggle:hover {
            color: #334155;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
        }

        /* ── Password strength indicator ── */
        .strength-bars {
            display: flex;
            gap: .5rem;
            margin-bottom: .75rem;
        }

        .strength-bar {
            flex: 1;
            height: 3px;
            border-radius: 2px;
            background: rgba(255, 255, 255, .1);
            transition: background .2s;
        }

        html.light .strength-bar {
            background: rgba(0, 0, 0, .1);
        }

        .strength-text {
            font-size: .75rem;
            color: #94a3b8;
        }

        html.light .strength-text {
            color: #94a3b8;
        }

        /* ── Match indicator ── */
        .match-indicator {
            font-size: .75rem;
            margin-top: .35rem;
            display: none;
        }

        .match-indicator.show {
            display: block;
        }

        .match-indicator.match {
            color: #86efac;
        }

        .match-indicator.nomatch {
            color: #f87171;
        }

        /* ── Checkbox ── */
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #6366f1;
        }

        .checkbox-group label {
            font-size: .875rem;
            color: #cbd5e1;
            cursor: pointer;
            margin: 0;
        }

        html.light .checkbox-group label {
            color: #64748b;
        }

        /* ── Button ── */
        .btn-submit {
            width: 100%;
            padding: 1rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: .75rem;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s;
            box-shadow: 0 4px 20px rgba(99, 102, 241, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, .55);
        }

        .btn-submit:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        /* ── Links ── */
        .form-footer {
            text-align: center;
            font-size: .875rem;
            border-top: 1px solid rgba(255, 255, 255, .08);
            padding-top: 1.5rem;
        }

        html.light .form-footer {
            border-top-color: rgba(0, 0, 0, .08);
        }

        .footer-text {
            color: #cbd5e1;
        }

        html.light .footer-text {
            color: #334155;
        }

        .form-link {
            color: #818cf8;
            text-decoration: none;
            font-weight: 500;
            transition: color .2s;
        }

        .form-link:hover {
            color: #a78bfa;
        }

        /* ── Error Messages ── */
        .error-message {
            color: #f87171;
            font-size: .8rem;
            margin-top: .35rem;
        }

        /* ── Spinner ── */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, .3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ── Responsive ── */
        @media (max-width: 640px) {
            .form-card {
                padding: 2rem 1.5rem;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }

            .navbar {
                padding: .75rem 1.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- Gradient mesh background -->
    <div class="mesh-bg"></div>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">Sama CV</a>
        <div class="nav-right">
            <button class="theme-toggle" id="themeToggle" aria-label="Basculer le thème">
                <svg id="sunIcon" fill="currentColor" viewBox="0 0 20 20" class="hidden">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm0 10a3 3 0 100-6 3 3 0 000 6zm0-5a2 2 0 100 4 2 2 0 000-4zm0 7a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm4.243-1.757a1 1 0 01.414 1.414l-.707.707a1 1 0 11-1.414-1.414l.707-.707zM6.414 6.414a1 1 0 000 1.414L7.121 8.536a1 1 0 001.414-1.414l-.707-.707zM14.657 14.657a1 1 0 000-1.414l-.707-.707a1 1 0 01-1.414 1.414l.707.707zm-2.121-10.5a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707zM3 10a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm12 0a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM2.757 5.757a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707zm12.728 2.12a1 1 0 011.414-1.413l.707.706a1 1 0 01-1.414 1.414l-.707-.707z" clip-rule="evenodd"/>
                </svg>
                <svg id="moonIcon" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Main content -->
    <div class="auth-container">
        <div class="form-wrapper">
            <div class="form-card">
                <!-- Header -->
                <div class="form-header">
                    <h1>Créer un compte</h1>
                    <p>Rejoignez-nous en quelques étapes simples</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nom complet</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="form-input"
                            placeholder="Jean Dupont"
                        />
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="form-input"
                            placeholder="vous@example.com"
                        />
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="password-wrapper">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                class="form-input"
                                placeholder="••••••••"
                                style="padding-right: 2.75rem;"
                            />
                            <button
                                type="button"
                                class="password-toggle togglePassword"
                                aria-label="Afficher/masquer le mot de passe"
                            >
                                <svg class="eyeIcon" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Password strength indicator -->
                        <div class="strength-bars" id="strengthBars">
                            <div class="strength-bar"></div>
                            <div class="strength-bar"></div>
                            <div class="strength-bar"></div>
                            <div class="strength-bar"></div>
                        </div>
                        <p class="strength-text" id="strengthText">Entrez un mot de passe</p>

                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <div class="password-wrapper">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                class="form-input"
                                placeholder="••••••••"
                                style="padding-right: 2.75rem;"
                            />
                            <button
                                type="button"
                                class="password-toggle togglePassword"
                                aria-label="Afficher/masquer le mot de passe"
                            >
                                <svg class="eyeIcon" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        <div id="matchIndicator" class="match-indicator"></div>
                        @error('password_confirmation')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn-submit" id="submitBtn">
                        Créer un compte
                    </button>
                </form>

                <!-- Footer link -->
                <div class="form-footer">
                    <p style="margin: 0;" class="footer-text">
                        Vous avez déjà un compte? <a href="{{ route('login') }}" class="form-link">Se connecter</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Theme toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');

        function updateThemeIcon() {
            const isLight = html.classList.contains('light');
            sunIcon.classList.toggle('hidden', !isLight);
            moonIcon.classList.toggle('hidden', isLight);
        }

        themeToggle.addEventListener('click', () => {
            const isLight = html.classList.contains('light');
            if (isLight) {
                html.classList.remove('light');
                localStorage.setItem('sama-theme', 'dark');
            } else {
                html.classList.add('light');
                localStorage.setItem('sama-theme', 'light');
            }
            updateThemeIcon();
        });

        updateThemeIcon();

        // Password visibility toggle
        document.querySelectorAll('.togglePassword').forEach(button => {
            button.addEventListener('click', () => {
                const input = button.parentElement.querySelector('input[type="password"], input[type="text"]');
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const strengthBars = document.querySelectorAll('#strengthBars > .strength-bar');
        const strengthText = document.getElementById('strengthText');

        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            return strength;
        }

        function updateStrengthIndicator() {
            const password = passwordInput.value;
            const strength = calculatePasswordStrength(password);

            strengthBars.forEach((bar, index) => {
                bar.style.background = '';
                if (index < strength) {
                    if (strength <= 2) bar.style.background = '#f87171'; // Red
                    else if (strength <= 3) bar.style.background = '#fbbf24'; // Yellow
                    else if (strength <= 4) bar.style.background = '#60a5fa'; // Blue
                    else bar.style.background = '#34d399'; // Green
                } else {
                    bar.style.background = 'rgba(255, 255, 255, .1)';
                }
            });

            const texts = [
                'Entrez un mot de passe',
                'Très faible',
                'Faible',
                'Moyen',
                'Bon',
                'Excellent'
            ];
            strengthText.textContent = texts[strength];
        }

        passwordInput.addEventListener('input', updateStrengthIndicator);

        // Password match indicator
        const confirmInput = document.getElementById('password_confirmation');
        const matchIndicator = document.getElementById('matchIndicator');

        function updateMatchIndicator() {
            if (confirmInput.value === '' || passwordInput.value === '') {
                matchIndicator.classList.remove('show');
                return;
            }

            matchIndicator.classList.add('show');
            if (passwordInput.value === confirmInput.value) {
                matchIndicator.textContent = '✓ Les mots de passe correspondent';
                matchIndicator.classList.remove('nomatch');
                matchIndicator.classList.add('match');
            } else {
                matchIndicator.textContent = '✗ Les mots de passe ne correspondent pas';
                matchIndicator.classList.remove('match');
                matchIndicator.classList.add('nomatch');
            }
        }

        passwordInput.addEventListener('input', updateMatchIndicator);
        confirmInput.addEventListener('input', updateMatchIndicator);

        // Form submission
        const registerForm = document.getElementById('registerForm');
        const submitBtn = document.getElementById('submitBtn');

        registerForm.addEventListener('submit', () => {
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>
