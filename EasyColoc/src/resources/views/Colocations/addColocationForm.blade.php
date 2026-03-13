<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CoLoc — Créer une colocation</title>
    <style>
        :root {
            --noir: #0a0a0a;
            --noir2: #111111;
            --noir3: #1a1a1a;
            --gold: #c9a84c;
            --gold2: #e8c97a;
            --gold-dim: rgba(201, 168, 76, 0.07);
            --gold-border: rgba(201, 168, 76, 0.18);
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

        /* NAVBAR */
        .navbar {
            background: var(--noir2);
            border-bottom: 1px solid #1e1e1e;
            padding: 0 32px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--gold);
            text-decoration: none;
        }

        .nav-logo-icon {
            background: var(--gold);
            color: var(--noir);
            width: 26px;
            height: 26px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 800;
        }

        .nav-btn-back {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.82rem;
            color: var(--text2);
            background: transparent;
            border: 1px solid #2a2a2a;
            cursor: pointer;
            transition: all 0.13s;
            text-decoration: none;
        }

        .nav-btn-back:hover {
            border-color: #444;
            color: var(--text);
        }

        /* MAIN */
        .main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        /* FORM BOX */
        .form-box {
            width: 100%;
            max-width: 480px;
            animation: up 0.35s 0.05s both;
        }

        @keyframes up {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ICON HEADER */
        .form-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 22px;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            text-align: center;
            margin-bottom: 6px;
        }

        .form-sub {
            font-size: 0.82rem;
            color: var(--muted);
            text-align: center;
            margin-bottom: 36px;
            line-height: 1.6;
        }

        /* CARD */
        .form-card {
            background: var(--noir2);
            border: 1px solid #1e1e1e;
            border-radius: 14px;
            overflow: hidden;
        }

        .form-card-body {
            padding: 28px 28px 24px;
        }

        /* LABEL */
        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text2);
            margin-bottom: 8px;
        }

        .form-label .req {
            color: var(--gold);
        }

        .form-label .hint {
            font-weight: 400;
            color: var(--muted);
            font-size: 0.68rem;
        }

        /* INPUT */
        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            pointer-events: none;
            opacity: 0.3;
        }

        .form-input {
            width: 100%;
            background: var(--noir3);
            border: 1px solid #252525;
            color: var(--text);
            font-family: system-ui, sans-serif;
            font-size: 0.95rem;
            padding: 12px 14px 12px 40px;
            border-radius: 9px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            letter-spacing: 0.01em;
        }

        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.08);
        }

        .form-input:hover:not(:focus) {
            border-color: #333;
        }

        .form-input::placeholder {
            color: #333;
        }

        .form-input.has-value {
            border-color: #333;
        }

        /* char counter */
        .char-counter {
            font-size: 0.65rem;
            color: var(--muted);
            text-align: right;
            margin-top: 5px;
        }

        .char-counter.warn {
            color: var(--red);
        }

        /* helper */
        .helper {
            font-size: 0.7rem;
            color: var(--muted);
            margin-top: 6px;
            line-height: 1.5;
        }

        /* preview badge */
        .name-preview {
            margin-top: 16px;
            background: var(--noir3);
            border: 1px solid #222;
            border-radius: 9px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .name-preview.visible {
            opacity: 1;
        }

        .preview-dot {
            width: 8px;
            height: 8px;
            background: var(--gold);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .preview-label {
            font-size: 0.62rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .preview-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--gold);
            margin-top: 1px;
        }

        .preview-owner {
            font-size: 0.65rem;
            color: var(--muted);
            margin-top: 2px;
        }

        /* FOOTER */
        .form-card-footer {
            padding: 18px 28px;
            border-top: 1px solid #1a1a1a;
            background: #0d0d0d;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .footer-note {
            font-size: 0.68rem;
            color: var(--muted);
        }

        .footer-note span {
            color: var(--gold);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: 8px;
            font-family: system-ui, sans-serif;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.15s;
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

        .btn-gold:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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

        /* INFO CHIPS */
        .info-row {
            display: flex;
            gap: 10px;
            margin-top: 22px;
        }

        .info-chip {
            flex: 1;
            background: var(--noir2);
            border: 1px solid #1e1e1e;
            border-radius: 9px;
            padding: 12px 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .chip-icon {
            font-size: 1rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .chip-text .ct {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text);
        }

        .chip-text .cs {
            font-size: 0.68rem;
            color: var(--muted);
            margin-top: 2px;
            line-height: 1.4;
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

    <!-- NAVBAR -->
    <nav class="navbar">
        <a class="nav-logo" href="{{route('index')}}">
            <div class="nav-logo-icon">C</div>
            CoLoc
        </a>
        <a class="nav-btn-back" href="#">← Retour au dashboard</a>
    </nav>

    <div class="main">
        <div class="form-box">

            <!-- Header -->
            <div class="form-icon">C</div>
            <div class="form-title">Créer une colocation</div>
            <div class="form-sub">Donnez un nom à votre colocation.<br>Vous en deviendrez automatiquement l'<strong
                    style="color:var(--gold);">Owner</strong>.</div>

            <!-- Card -->
            <form class="form-card" action="{{route('colocation.store')}}" method="POST">
                @csrf
                <div class="form-card-body">

                    <div>
                        <label class="form-label">
                            Nom de la colocation <span class="req">*</span>
                            <span class="hint">Max. 60 caractères</span>
                        </label>
                        <div class="input-wrap">
                            <span class="input-icon">C</span>
                            <input class="form-input" id="coloc-name" type="text" name="name"
                                placeholder="Ex: Les Appartés du 12ème..." maxlength="60" autocomplete="off"
                                oninput="handleInput(this)">
                        </div>
                        <div class="char-counter" id="char-count">0 / 60</div>
                        <div class="helper">Choisissez un nom mémorable pour votre colocation. Il sera visible par tous
                            les membres invités.</div>
                    </div>

                    <!-- Live preview -->
                    <div class="name-preview" id="preview">
                        <div class="preview-dot"></div>
                        <div>
                            <div class="preview-label">Aperçu</div>
                            <div class="preview-name" id="preview-name">—</div>
                            <div class="preview-owner">Owner : Jean Dupont · 1 membre · Active</div>
                        </div>
                    </div>

                </div>

                <div class="form-card-footer">
                    <div class="footer-note">Vous serez <span>Owner</span> de cette colocation</div>
                    <div style="display:flex;gap:8px;">
                        <a class="btn btn-outline" href="{{route('colocation.premier')}}">Annuler</a>
                        <button class="btn btn-gold" id="submit-btn">
                            Créer la colocation
                        </button>
                    </div>
                </div>
            </form>

        <!-- Info chips -->
        <div class="info-row">
            <div class="info-chip">
                <span class="chip-icon">O</span>
                <div class="chip-text">
                    <div class="ct">Vous serez Owner</div>
                    <div class="cs">Gérez membres, dépenses et invitations</div>
                </div>
            </div>
            <div class="info-chip">
                <span class="chip-icon">⚠</span>
                <div class="chip-text">
                    <div class="ct">Une seule colocation</div>
                    <div class="cs">Vous ne pouvez avoir qu'une colocation active</div>
                </div>
            </div>
        </div>

    </div>
</div>

    <script>
        const input     = document.getElementById('coloc-name');
  const counter   = document.getElementById('char-count');
  const preview   = document.getElementById('preview');
  const previewNm = document.getElementById('preview-name');
  const submitBtn = document.getElementById('submit-btn');

  function handleInput(el) {
    const len = el.value.length;
    const val = el.value.trim();

    counter.textContent = len + ' / 60';
    counter.classList.toggle('warn', len > 50);


    if (val.length > 0) {
      previewNm.textContent = val;
      preview.classList.add('visible');
    } else {
      preview.classList.remove('visible');
    }
    submitBtn.disabled = val.length < 5;
  }

    </script>
</body>

</html>