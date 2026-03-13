<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CoLoc — Bienvenue</title>
    <style>
        :root {
            --noir: #0a0a0a;
            --noir2: #111111;
            --noir3: #1a1a1a;
            --gold: #c9a84c;
            --gold2: #e8c97a;
            --gold-dim: rgba(201, 168, 76, 0.07);
            --gold-border: rgba(201, 168, 76, 0.16);
            --muted: #5a5a5a;
            --text: #e8e8e8;
            --text2: #999;
            --red: #e05252;
            --green: #52c97a;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--noir);
            color: var(--text);
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: var(--noir2);
            border-bottom: 1px solid #1e1e1e;
            padding: 0 32px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--gold);
            text-decoration: none;
        }

        .logo-icon {
            background: var(--gold);
            color: var(--noir);
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 800;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px 5px 5px;
            background: var(--noir3);
            border: 1px solid #222;
            border-radius: 8px;
            cursor: pointer;
            transition: border-color 0.13s;
        }

        .user-chip:hover {
            border-color: #333;
        }

        .avatar {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background: linear-gradient(135deg, #c9a84c, #7a5c1a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.68rem;
            color: var(--noir);
        }

        .user-chip-name {
            font-size: 0.78rem;
            font-weight: 600;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            border-radius: 8px;
            font-family: system-ui, sans-serif;
            font-size: 0.83rem;
            cursor: pointer;
            transition: all 0.14s;
            text-decoration: none;
            border: none;
            outline: none;
            font-weight: 600;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--noir);
        }

        .btn-gold:hover {
            background: var(--gold2);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(201, 168, 76, 0.2);
        }

        .btn-outline {
            background: transparent;
            color: var(--text2);
            border: 1px solid #2a2a2a;
            font-weight: 400;
        }

        .btn-outline:hover {
            border-color: #3a3a3a;
            color: var(--text);
        }

        .btn-ghost {
            background: transparent;
            color: var(--muted);
            font-weight: 400;
            border: none;
        }

        .btn-ghost:hover {
            color: var(--text2);
        }

        /* ── PAGE ── */
        .page {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 60px 24px 80px;
            position: relative;
            overflow: hidden;
        }

        /* glow */
        .page::before {
            content: '';
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(ellipse, rgba(201, 168, 76, 0.06) 0%, transparent 65%);
            pointer-events: none;
        }

        /* ── HERO SECTION ── */
        .hero {
            text-align: center;
            max-width: 600px;
            margin-bottom: 52px;
        }

        .hello-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            color: var(--gold);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 22px;
            animation: fadeUp 0.35s 0.05s both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.15;
            margin-bottom: 14px;
            animation: fadeUp 0.35s 0.1s both;
        }

        .hero-title span {
            color: var(--gold);
        }

        .hero-sub {
            font-size: 0.95rem;
            color: var(--text2);
            line-height: 1.7;
            margin-bottom: 32px;
            animation: fadeUp 0.35s 0.15s both;
        }

        .hero-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeUp 0.35s 0.2s both;
        }

        .btn-lg {
            padding: 13px 28px;
            font-size: 0.92rem;
            border-radius: 10px;
        }

        /* ── OR DIVIDER ── */
        .or-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            max-width: 480px;
            margin: 36px 0;
            font-size: 0.72rem;
            color: var(--muted);
            animation: fadeUp 0.35s 0.22s both;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #1e1e1e;
        }

        /* ── INVITATION CARD ── */
        .invite-card {
            background: var(--noir2);
            border: 1px solid #1e1e1e;
            border-radius: 12px;
            padding: 20px 24px;
            width: 100%;
            max-width: 480px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 52px;
            animation: fadeUp 0.35s 0.25s both;
        }

        .invite-icon {
            width: 42px;
            height: 42px;
            border-radius: 9px;
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .invite-text {
            flex: 1;
        }

        .invite-title {
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .invite-sub {
            font-size: 0.75rem;
            color: var(--muted);
            line-height: 1.4;
        }

        .invite-input-row {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .invite-input {
            flex: 1;
            background: var(--noir3);
            border: 1px solid #252525;
            color: var(--text);
            font-family: system-ui, sans-serif;
            font-size: 0.8rem;
            padding: 8px 12px;
            border-radius: 7px;
            outline: none;
            transition: border-color 0.15s;
        }

        .invite-input:focus {
            border-color: var(--gold);
        }

        .invite-input::placeholder {
            color: #2e2e2e;
        }

        /* ── FEATURES ── */
        .features-title {
            font-size: 0.68rem;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: center;
            margin-bottom: 20px;
            animation: fadeUp 0.35s 0.28s both;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            width: 100%;
            max-width: 820px;
            animation: fadeUp 0.35s 0.3s both;
        }

        .feat-card {
            background: var(--noir2);
            border: 1px solid #1a1a1a;
            border-radius: 11px;
            padding: 20px 18px;
            transition: border-color 0.18s, transform 0.18s;
            position: relative;
            overflow: hidden;
        }

        .feat-card:hover {
            border-color: var(--gold-border);
            transform: translateY(-2px);
        }

        .feat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gold);
            opacity: 0;
            transition: opacity 0.18s;
        }

        .feat-card:hover::before {
            opacity: 1;
        }

        .feat-icon {
            width: 40px;
            height: 40px;
            border-radius: 9px;
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 13px;
        }

        .feat-title {
            font-size: 0.88rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .feat-desc {
            font-size: 0.76rem;
            color: var(--text2);
            line-height: 1.6;
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.78);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal {
            background: var(--noir2);
            border: 1px solid #252525;
            border-radius: 14px;
            width: 480px;
            max-width: 95vw;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.7);
            animation: fadeUp 0.25s both;
        }

        .modal-header {
            padding: 22px 26px 18px;
            border-bottom: 1px solid #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 1rem;
            font-weight: 700;
        }

        .modal-sub {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 3px;
        }

        .modal-body {
            padding: 24px 26px;
            display: grid;
            gap: 16px;
        }

        .modal-footer {
            padding: 16px 26px;
            border-top: 1px solid #1a1a1a;
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text2);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-label .req {
            color: var(--gold);
        }

        .form-input {
            background: var(--noir3);
            border: 1px solid #222;
            color: var(--text);
            font-family: system-ui, sans-serif;
            font-size: 0.87rem;
            padding: 10px 13px;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            width: 100%;
        }

        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.08);
        }

        .form-input::placeholder {
            color: #2e2e2e;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 80px;
            line-height: 1.5;
        }

        .helper {
            font-size: 0.67rem;
            color: var(--muted);
            margin-top: 4px;
        }

        /* step indicators */
        .steps-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 26px 18px;
            border-bottom: 1px solid #1a1a1a;
        }

        .step-dot {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            background: var(--noir3);
            border: 1px solid #2a2a2a;
            color: var(--muted);
        }

        .step-dot.active {
            background: var(--gold);
            color: var(--noir);
            border-color: var(--gold);
        }

        .step-dot.done {
            background: rgba(82, 201, 122, 0.1);
            border-color: rgba(82, 201, 122, 0.3);
            color: var(--green);
        }

        .step-line {
            flex: 1;
            height: 1px;
            background: #1e1e1e;
        }

        .step-label {
            font-size: 0.68rem;
            color: var(--muted);
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: var(--noir);
        }

        ::-webkit-scrollbar-thumb {
            background: #282828;
            border-radius: 2px;
        }
    </style>
</head>

<body>

    <!-- TOPBAR -->
    <div class="topbar">
        <a class="logo" href="{{route('index')}}">
            <div class="logo-icon">C</div>
            CoLoc
        </a>
        <div class="topbar-right">
            <div class="user-chip">
                <div class="avatar">JD</div>
                <span class="user-chip-name">Jean Dupont</span>
            </div>
            <button class="btn btn-ghost" style="font-size:0.8rem;">Déconnexion</button>
        </div>
    </div>

    <!-- PAGE -->
    <div class="page">

        <!-- HERO -->
        <div class="hello-badge"> Bienvenue sur CoLoc !</div>

        <div class="hero">
            <h1 class="hero-title">
                Vous n'avez pas encore<br>de <span>colocation active</span>
            </h1>
            <p class="hero-sub">
                Créez votre propre colocation et devenez Owner, ou rejoignez une colocation existante grâce à un lien
                d'invitation.
            </p>
            <div class="hero-actions">
                <a href="{{route('colocation.create')}}">
                <button class="btn btn-gold btn-lg">
                    Créer une colocation
                </button>
                </a>
            </div>
        </div>

        <!-- OR + INVITE TOKEN -->
        <div class="or-divider" style="max-width:480px;">Vous avez un lien d'invitation ?</div>

        <div class="invite-card">
            <div class="invite-icon">✦</div>
            <div class="invite-text">
                <div class="invite-title">Entrer un code d'invitation</div>
                <div class="invite-sub">Collez le lien ou le token reçu par email pour rejoindre une colocation.</div>
                <div class="invite-input-row">
                    <input class="invite-input" type="text" placeholder="https://coloc.app/invite/...  ou  token">
                    <button class="btn btn-gold" style="padding:8px 16px;font-size:0.78rem;">Rejoindre</button>
                </div>
            </div>
        </div>

        <!-- FEATURES -->
        <div class="features-title">Ce que vous pourrez faire avec CoLoc</div>

        <div class="features-grid">
            <div class="feat-card">
                <div class="feat-icon">D</div>
                <div class="feat-title">Suivi des dépenses</div>
                <div class="feat-desc">Ajoutez vos dépenses communes avec titre, montant, catégorie et payeur.
                    Historique complet disponible.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon">⇋</div>
                <div class="feat-title">Calcul automatique</div>
                <div class="feat-desc">Les soldes et remboursements sont calculés en temps réel. Zéro calcul manuel,
                    zéro conflit.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon">✦</div>
                <div class="feat-title">Invitations sécurisées</div>
                <div class="feat-desc">Invitez vos colocataires par email avec un token unique. Ils acceptent ou
                    refusent en un clic.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon">👁</div>
                <div class="feat-title">Vue simplifiée</div>
                <div class="feat-desc">Visualisez clairement qui doit à qui et marquez les remboursements comme
                    effectués.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon">★</div>
                <div class="feat-title">Réputation financière</div>
                <div class="feat-desc">Un score de confiance pour chaque membre selon son comportement. +1 sans dette,
                    −1 avec dette.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon">◻</div>
                <div class="feat-title">Catégories personnalisées</div>
                <div class="feat-desc">Organisez vos dépenses par catégorie : loyer, alimentation, énergie, loisirs et
                    plus encore.</div>
            </div>
        </div>
    </div>
</body>

</html>