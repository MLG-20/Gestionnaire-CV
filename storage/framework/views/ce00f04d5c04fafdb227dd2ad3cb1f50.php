<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter - Sama CV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <!-- Anti-flash: applique le thème avant le rendu -->
    <script>(function(){if(localStorage.getItem('sama-theme')==='light')document.documentElement.classList.add('light');})()</script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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
            max-width: 450px;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .875rem;
            border-top: 1px solid rgba(255, 255, 255, .08);
            padding-top: 1.5rem;
            margin-top: 1rem;
        }

        html.light .form-footer {
            border-top-color: rgba(0, 0, 0, .08);
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

        /* ── Success Message ── */
        .success-message {
            background: rgba(34, 197, 94, .1);
            border: 1px solid rgba(34, 197, 94, .3);
            border-radius: .75rem;
            padding: 1rem;
            color: #86efac;
            font-size: .9rem;
            margin-bottom: 1.5rem;
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
        <a href="<?php echo e(route('home')); ?>" class="logo">Sama CV</a>
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
                    <h1>Bienvenue</h1>
                    <p>Connectez-vous à votre compte</p>
                </div>

                <!-- Success message -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status = session('status')): ?>
                    <div class="success-message"><?php echo e($status); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Form -->
                <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm">
                    <?php echo csrf_field(); ?>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="<?php echo e(old('email')); ?>"
                            required
                            autofocus
                            class="form-input"
                            placeholder="vous@example.com"
                        />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-message"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                                class="password-toggle"
                                id="togglePassword"
                                aria-label="Afficher/masquer le mot de passe"
                            >
                                <svg id="eyeIcon" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-message"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Remember me -->
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                            >
                            <label for="remember_me">Se souvenir de moi</label>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn-submit" id="submitBtn">
                        Se connecter
                    </button>
                </form>

                <!-- Footer links -->
                <div class="form-footer">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="form-link">Mot de passe oublié ?</a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <a href="<?php echo e(route('register')); ?>" class="form-link">Créer un compte</a>
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
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
        });

        // Form submission
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');

        loginForm.addEventListener('submit', () => {
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>
<?php /**PATH C:\Herd\Gestion-CV\resources\views/auth/login.blade.php ENDPATH**/ ?>