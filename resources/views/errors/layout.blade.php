<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet">

        <style>
            :root {
                color-scheme: dark;
            }

            *, *::before, *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: "Instrument Sans", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
                background-color: #030712;
                color: #f8fafc;
            }

            .page {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 3rem 1.25rem;
                background-image: radial-gradient(circle at top, rgba(79, 70, 229, 0.35), transparent 55%), radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.18), transparent 50%);
            }

            .card {
                width: min(560px, 100%);
                border-radius: 28px;
                padding: clamp(1.75rem, 3vw, 2.5rem);
                background: rgba(15, 23, 42, 0.95);
                border: 1px solid rgba(148, 163, 184, 0.25);
                box-shadow: 0 30px 60px rgba(2, 6, 23, 0.65);
                position: relative;
                overflow: hidden;
            }

            .card::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), transparent 50%);
                pointer-events: none;
            }

            .card-content {
                position: relative;
                z-index: 1;
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
            }

            .eyebrow {
                margin: 0;
                font-size: 0.85rem;
                letter-spacing: 0.4em;
                text-transform: uppercase;
                color: #94a3b8;
            }

            .status {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                align-items: baseline;
            }

            .code {
                margin: 0;
                font-size: clamp(48px, 7vw, 92px);
                font-weight: 600;
                color: #38bdf8;
            }

            .message {
                margin: 0;
                font-size: clamp(24px, 4vw, 36px);
                font-weight: 500;
                color: #f1f5f9;
            }

            .description {
                margin: 0;
                color: #cbd5f5;
                line-height: 1.6;
                font-size: 1rem;
            }

            .note {
                margin: 0;
                font-size: 0.85rem;
                color: #94a3b8;
            }

            .actions {
                display: flex;
                gap: 0.75rem;
                flex-wrap: wrap;
                margin-top: 0.25rem;
            }

            .button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.35rem;
                border-radius: 999px;
                padding: 0.85rem 1.5rem;
                font-size: 0.95rem;
                font-weight: 500;
                text-decoration: none;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .button.primary {
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                color: #fff;
                border: 1px solid transparent;
                box-shadow: 0 12px 25px rgba(99, 102, 241, 0.35);
            }

            .button.primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 25px 45px rgba(99, 102, 241, 0.45);
            }

            .button.ghost {
                border: 1px solid rgba(226, 232, 240, 0.6);
                color: #e2e8f0;
                background: transparent;
            }

            .button.ghost:hover {
                background-color: rgba(226, 232, 240, 0.08);
            }

            @media (max-width: 600px) {
                .status {
                    flex-direction: column;
                    align-items: flex-start;
                }
            }
        </style>
    </head>
    <body>
        <div class="page" role="main">
            <article class="card">
                <div class="card-content">
                    <p class="eyebrow">
                        <span>{{ config('app.name', 'Web Discovery') }}</span> &bull; Erreur
                    </p>

                    <div class="status">
                        <p class="code">@yield('code')</p>
                        <p class="message">@yield('message')</p>
                    </div>

                    <p class="description">
                        @yield('description', __("Nous reparons la situation et serons de retour sous peu."))
                    </p>

                    <div class="actions">
                        <a class="button primary" href="{{ url('/') }}">
                            Retour a l'accueil
                        </a>
                        <a class="button ghost" href="mailto:bonjour@web-discovery.fr">
                            Nous contacter
                        </a>
                    </div>

                    @hasSection('note')
                        <p class="note">@yield('note')</p>
                    @endif
                </div>
            </article>
        </div>
    </body>
</html>
