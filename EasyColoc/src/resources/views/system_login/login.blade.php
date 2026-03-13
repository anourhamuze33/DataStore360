<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CoLoc — Connexion</title>
  <style>
    :root {
      --noir:  #0a0a0a;
      --noir2: #111111;
      --noir3: #1a1a1a;
      --gold:  #c9a84c;
      --gold2: #e8c97a;
      --gold-dim: rgba(201,168,76,0.07);
      --gold-border: rgba(201,168,76,0.18);
      --muted: #6b6b6b;
      --text:  #e8e8e8;
      --text2: #a0a0a0;
      --red:   #e05252;
      --green: #52c97a;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--noir);
      color: var(--text);
      font-family: system-ui, -apple-system, sans-serif;
      min-height: 100vh;
      display: flex; flex-direction: column;
    }

    /* NAVBAR */
    .navbar {
      background: var(--noir2);
      border-bottom: 1px solid #1e1e1e;
      padding: 0 32px; height: 54px;
      display: flex; align-items: center; justify-content: space-between;
      flex-shrink: 0;
    }
    .nav-logo {
      display: flex; align-items: center; gap: 9px;
      font-size: 1.1rem; font-weight: 800;
      letter-spacing: -0.03em; color: var(--gold); text-decoration: none;
    }
    .nav-logo-icon {
      background: var(--gold); color: var(--noir);
      width: 26px; height: 26px; border-radius: 6px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.8rem; font-weight: 800;
    }
    .nav-btn-back {
      display: flex; align-items: center; gap: 6px;
      padding: 6px 14px; border-radius: 6px; font-size: 0.82rem;
      color: var(--text2); background: transparent;
      border: 1px solid #2a2a2a; cursor: pointer;
      transition: all 0.13s; text-decoration: none;
    }
    .nav-btn-back:hover { border-color: #444; color: var(--text); }
    .nav-btn-primary {
      display: flex; align-items: center; gap: 6px;
      padding: 6px 16px; border-radius: 6px; font-size: 0.82rem;
      font-weight: 600; color: var(--noir); background: var(--gold);
      border: none; cursor: pointer; transition: all 0.13s; text-decoration: none;
    }
    .nav-btn-primary:hover { background: var(--gold2); }

    /* MAIN */
    .main { flex: 1; display: flex; }

    /* LEFT PANEL */
    .left-panel {
      width: 400px; flex-shrink: 0;
      background: var(--noir2); border-right: 1px solid #1e1e1e;
      display: flex; flex-direction: column;
      padding: 52px 44px; position: relative; overflow: hidden;
    }
    .left-panel::before {
      content: ''; position: absolute;
      width: 380px; height: 380px; border-radius: 50%;
      background: radial-gradient(circle, rgba(201,168,76,0.06) 0%, transparent 70%);
      bottom: -100px; left: -80px; pointer-events: none;
    }

    .panel-greeting {
      font-size: 0.68rem; letter-spacing: 0.13em;
      text-transform: uppercase; color: var(--gold); opacity: 0.8; margin-bottom: 10px;
    }
    .panel-title {
      font-size: 1.75rem; font-weight: 800;
      letter-spacing: -0.03em; line-height: 1.2; margin-bottom: 14px;
    }
    .panel-title span { color: var(--gold); }
    .panel-sub { font-size: 0.86rem; color: var(--muted); line-height: 1.65; margin-bottom: 48px; }

    .info-cards { display: flex; flex-direction: column; gap: 12px; }
    .info-card {
      background: var(--noir3); border: 1px solid #222;
      border-radius: 10px; padding: 14px 16px;
      display: flex; align-items: flex-start; gap: 12px;
    }
    .info-icon {
      width: 36px; height: 36px; border-radius: 8px;
      background: var(--gold-dim); border: 1px solid var(--gold-border);
      display: flex; align-items: center; justify-content: center;
      font-size: 1rem; flex-shrink: 0;
    }
    .info-text .it { font-size: 0.82rem; font-weight: 600; color: var(--text); }
    .info-text .is { font-size: 0.72rem; color: var(--muted); margin-top: 2px; line-height: 1.5; }

    .panel-footer {
      margin-top: auto; padding-top: 20px;
      border-top: 1px solid #1e1e1e;
      font-size: 0.7rem; color: var(--muted);
    }

    /* RIGHT PANEL */
    .right-panel {
      flex: 1; display: flex; align-items: center; justify-content: center;
      padding: 48px 40px; overflow-y: auto;
    }

    .form-box {
      width: 100%; max-width: 420px;
      animation: up 0.35s 0.05s both;
    }
    @keyframes up { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }

    .form-box-title { font-size: 1.3rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 4px; }
    .form-box-sub { font-size: 0.82rem; color: var(--muted); margin-bottom: 32px; }
    .form-box-sub a { color: var(--gold); text-decoration: none; font-weight: 600; }
    .form-box-sub a:hover { text-decoration: underline; }

    /* FORM */
    .form-group { margin-bottom: 18px; }
    .form-label {
      display: flex; align-items: center; justify-content: space-between;
      font-size: 0.75rem; font-weight: 600; color: var(--text2); margin-bottom: 7px;
    }
    .form-label a { color: var(--gold); font-weight: 500; font-size: 0.7rem; text-decoration: none; }
    .form-label a:hover { text-decoration: underline; }

    .input-wrap { position: relative; }
    .input-icon {
      position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
      font-size: 0.88rem; pointer-events: none; opacity: 0.35;
    }
    .form-input {
      width: 100%; background: var(--noir3); border: 1px solid #252525;
      color: var(--text); font-family: system-ui, sans-serif;
      font-size: 0.9rem; padding: 11px 14px 11px 36px;
      border-radius: 8px; outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }
    .form-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.08); }
    .form-input:hover:not(:focus) { border-color: #333; }
    .form-input::placeholder { color: #383838; }
    .form-input.error { border-color: var(--red); }

    .pwd-toggle {
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      cursor: pointer; color: var(--muted); font-size: 0.75rem;
      user-select: none; transition: color 0.13s;
    }
    .pwd-toggle:hover { color: var(--text2); }

    .error-msg { font-size: 0.68rem; color: var(--red); margin-top: 5px; display: none; }

    .remember-row {
      display: flex; align-items: center; margin-bottom: 24px;
    }
    .remember-check {
      display: flex; align-items: center; gap: 8px;
      font-size: 0.78rem; color: var(--text2); cursor: pointer;
    }
    .remember-check input { accent-color: var(--gold); cursor: pointer; }

    .alert {
      display: flex; align-items: flex-start; gap: 10px;
      padding: 12px 14px; border-radius: 8px;
      font-size: 0.78rem; margin-bottom: 20px;
    }
    .alert-icon { font-size: 1rem; flex-shrink: 0; margin-top: 1px; }
    .alert.error { background: rgba(224,82,82,0.08); border: 1px solid rgba(224,82,82,0.2); color: var(--red); }

    .btn-submit {
      width: 100%; padding: 13px;
      background: var(--gold); color: var(--noir);
      font-family: system-ui, sans-serif; font-size: 0.92rem; font-weight: 700;
      border: none; border-radius: 8px; cursor: pointer; transition: all 0.15s;
    }
    .btn-submit:hover { background: var(--gold2); transform: translateY(-1px); box-shadow: 0 6px 22px rgba(201,168,76,0.22); }
    .btn-submit:active { transform: translateY(0); }

    .divider {
      display: flex; align-items: center; gap: 12px;
      margin: 22px 0; font-size: 0.72rem; color: var(--muted);
    }
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #1e1e1e; }

    .signup-link { text-align: center; font-size: 0.8rem; color: var(--muted); }
    .signup-link a { color: var(--gold); text-decoration: none; font-weight: 600; }
    .signup-link a:hover { text-decoration: underline; }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: var(--noir); }
    ::-webkit-scrollbar-thumb { background: #333; border-radius: 2px; }

    @media (max-width: 820px) { .left-panel { display: none; } }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <a class="nav-logo" href="#">
      <div class="nav-logo-icon">C</div>
      CoLoc
    </a>
    <div style="display:flex;gap:8px;">
      <a class="nav-btn-back" href="{{route('user.viewInscription')}}">← Retour</a>
      <a class="nav-btn-primary" href="{{route('user.viewInscription')}}">S'inscrire</a>
    </div>
  </nav>

  <div class="main">

    <!-- LEFT PANEL -->
    <div class="left-panel">
      <div class="panel-greeting">Bon retour parmi nous</div>
      <h2 class="panel-title">Reconnectez-vous à <span>colocn</span></h2>
      <p class="panel-sub">Accédez à vos dépenses, vos soldes et vos remboursements en un instant.</p>

      <div class="info-cards">
        <div class="info-card">
          <div class="info-icon">⇋</div>
          <div class="info-text">
            <div class="it">Soldes à jour</div>
            <div class="is">Vos balances sont recalculées automatiquement à chaque connexion.</div>
          </div>
        </div>
        <div class="info-card">
          <div class="info-icon">★</div>
          <div class="info-text">
            <div class="it">Remboursements en attente</div>
            <div class="is">Consultez qui vous doit de l'argent et marquez les paiements reçus.</div>
          </div>
        </div>
        <div class="info-card">
          <div class="info-icon">★</div>
          <div class="info-text">
            <div class="it">Votre réputation vous attend</div>
            <div class="is">Maintenez un bon score en réglant vos dettes à temps.</div>
          </div>
        </div>
      </div>

      <div class="panel-footer">© 2026 CoLoc · Tous droits réservés</div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
      <div class="form-box">

        <div class="form-box-title">Connexion</div>
        <div class="form-box-sub">Pas encore de compte ? <a href="{{route('user.viewInscription')}}">Inscrivez-vous ici</a></div>

        <!-- Banned alert (shown conditionally in Blade) -->
        <div class="alert error" style="display:none;">
          <span class="alert-icon">⛔</span>
          <span>Votre compte a été suspendu. Contactez l'administrateur.</span>
        </div>

        <form action="{{route('user.login')}}" method="POST">
        @csrf
          <div class="form-group">
            <label class="form-label">Adresse email</label>
            <div class="input-wrap">
              <span class="input-icon">✉</span>
              <input class="form-input" name="email" id="email" type="email" placeholder="jean.dupont@email.com" autocomplete="email" required>
            </div>
            @error('email') <p class="error-msg">email non valide</p> @enderror
          </div>

          <div class="form-group">
            <label class="form-label">
              Mot de passe
              <a href="#">Mot de passe oublié ?</a>
            </label>
            <div class="input-wrap">
              <span class="input-icon"></span>
              <input class="form-input" name="password" id="pwd" type="password" placeholder="••••••••" autocomplete="current-password" required>
                @error('password') <p class="error-msg">password non valide</p> @enderror
              <span class="pwd-toggle" onclick="togglePwd()">Afficher</span>
            </div>
            <div class="error-msg" id="pwd-err">Identifiants incorrects.</div>
          </div>

          <div class="remember-row">
            <label class="remember-check">
              <input type="checkbox" id="remember">
              Se souvenir de moi
            </label>
          </div>

          <button class="btn-submit" type="submit">Se connecter →</button>

        </form>

        <div class="divider">ou</div>

        <div class="signup-link">
          Pas encore de compte ? <a href="{{route('user.viewInscription')}}">Créer un compte gratuit</a>
        </div>

      </div>
    </div>

  </div>

<script>
  function togglePwd() {
    const input = document.getElementById('pwd');
    const btn = document.querySelector('.pwd-toggle');
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    btn.textContent = show ? 'Masquer' : 'Afficher';
  }
</script>
</body>
</html>