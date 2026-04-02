<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Online Library Management System') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .welcome-wrap {
                min-height: 100vh;
                background:
                    radial-gradient(circle at top left, rgba(186, 139, 45, 0.14), transparent 28%),
                    radial-gradient(circle at top right, rgba(31, 58, 51, 0.12), transparent 30%),
                    linear-gradient(180deg, rgba(247, 240, 226, 0.95), rgba(243, 236, 221, 1));
            }

            .welcome-hero {
                position: relative;
                overflow: hidden;
            }

            .welcome-hero::before,
            .welcome-hero::after {
                content: '';
                position: absolute;
                border-radius: 9999px;
                pointer-events: none;
                opacity: 0.9;
            }

            .welcome-hero::before {
                width: 19rem;
                height: 19rem;
                right: -6rem;
                top: -4rem;
                background: radial-gradient(circle, rgba(186, 139, 45, 0.18), rgba(186, 139, 45, 0.03));
            }

            .welcome-hero::after {
                width: 14rem;
                height: 14rem;
                left: -5rem;
                bottom: -4rem;
                background: radial-gradient(circle, rgba(31, 58, 51, 0.14), rgba(31, 58, 51, 0.03));
            }

            .welcome-panel {
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-soft);
                background: rgba(251, 247, 239, 0.9);
                backdrop-filter: blur(6px);
            }

            .welcome-title {
                font-family: var(--font-display);
                color: var(--color-primary);
            }

            .welcome-kicker {
                color: var(--color-accent);
                letter-spacing: 0.24em;
                text-transform: uppercase;
                font-size: 0.72rem;
                font-weight: 700;
            }

            .welcome-icon {
                width: 3.5rem;
                height: 3.5rem;
                border-radius: 1rem;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, var(--color-primary), #12201a);
                color: #fff3da;
                border: 1px solid rgba(215, 202, 176, 0.45);
                box-shadow: 0 12px 24px rgba(25, 41, 35, 0.16);
            }

            .welcome-grid {
                background-image:
                    linear-gradient(rgba(191, 172, 136, 0.12) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(191, 172, 136, 0.12) 1px, transparent 1px);
                background-size: 22px 22px;
            }
        </style>
    </head>
    <body class="antialiased welcome-wrap text-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="app-brand">
                    <span class="app-brand-mark">📚</span>
                    <span>
                        <span class="app-brand-title block">Online Library</span>
                        <span class="app-brand-subtitle block">Management System</span>
                    </span>
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-accent">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="top-nav-link text-[var(--color-primary)] border-b-0">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-accent">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <main class="welcome-hero px-4 sm:px-6 lg:px-8 pb-10">
            <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-8 items-center min-h-[calc(100vh-6rem)]">
                <section class="space-y-8 py-6 lg:py-0">
                    <div class="space-y-4">
                        <p class="welcome-kicker">Academic. Trusted. Refined.</p>
                        <h1 class="welcome-title text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                            A digital library built with the calm of old shelves and the speed of modern access.
                        </h1>
                        <p class="text-lg text-[var(--color-muted)] max-w-2xl leading-8">
                            Manage books, members, librarians, and borrowing with a secure role-based system designed for a professional academic environment.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('login') }}" class="btn-accent">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="surface-card px-5 py-2.5 font-semibold text-[var(--color-primary)] hover:-translate-y-0.5 transition-transform">Create Account</a>
                        @endif
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div class="surface-card p-5">
                            <div class="welcome-icon mb-4">◆</div>
                            <h2 class="font-semibold text-[var(--color-primary)]">Secure Roles</h2>
                            <p class="mt-2 text-sm text-[var(--color-muted)]">Member, Librarian, and Admin access handled server-side.</p>
                        </div>
                        <div class="surface-card p-5">
                            <div class="welcome-icon mb-4">◌</div>
                            <h2 class="font-semibold text-[var(--color-primary)]">Borrowing Control</h2>
                            <p class="mt-2 text-sm text-[var(--color-muted)]">Transactional borrowing keeps copies accurate.</p>
                        </div>
                        <div class="surface-card p-5">
                            <div class="welcome-icon mb-4">✦</div>
                            <h2 class="font-semibold text-[var(--color-primary)]">Academic Catalogue</h2>
                            <p class="mt-2 text-sm text-[var(--color-muted)]">A warm and elegant reading experience for users.</p>
                        </div>
                    </div>
                </section>

                <section class="relative">
                    <div class="welcome-panel rounded-3xl p-6 sm:p-8 lg:p-10">
                        <div class="welcome-grid rounded-2xl p-6 sm:p-8 min-h-[32rem] flex flex-col justify-between">
                            <div>
                                <p class="text-sm uppercase tracking-[0.28em] text-[var(--color-accent)] font-bold">Library Interior</p>
                                <h2 class="welcome-title text-3xl sm:text-4xl font-bold mt-3">A reading room feel for your digital campus.</h2>
                                <p class="mt-4 text-[var(--color-muted)] max-w-xl leading-7">
                                    Soft light, warm gold accents, and structured panels create a trustworthy interface that feels built for study, not generic software.
                                </p>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4 mt-8">
                                <div class="surface-card p-5">
                                    <div class="text-2xl mb-2">📖</div>
                                    <h3 class="font-semibold text-[var(--color-primary)]">Member Access</h3>
                                    <p class="text-sm text-[var(--color-muted)] mt-1">Browse available books and track your account.</p>
                                </div>
                                <div class="surface-card p-5">
                                    <div class="text-2xl mb-2">🏛️</div>
                                    <h3 class="font-semibold text-[var(--color-primary)]">Admin Control</h3>
                                    <p class="text-sm text-[var(--color-muted)] mt-1">Manage librarians, members, and permissions.</p>
                                </div>
                                <div class="surface-card p-5">
                                    <div class="text-2xl mb-2">🗂️</div>
                                    <h3 class="font-semibold text-[var(--color-primary)]">Book Records</h3>
                                    <p class="text-sm text-[var(--color-muted)] mt-1">Maintain title, author, ISBN, and copies.</p>
                                </div>
                                <div class="surface-card p-5">
                                    <div class="text-2xl mb-2">⏳</div>
                                    <h3 class="font-semibold text-[var(--color-primary)]">Safe Borrowing</h3>
                                    <p class="text-sm text-[var(--color-muted)] mt-1">Transactions keep inventory reliable.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <footer class="app-footer">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-2 text-sm">
                <p class="footer-title">Online Library Management System</p>
                <p>&copy; {{ now()->year }} Secure Academic Platform</p>
            </div>
        </footer>
    </body>
</html>
