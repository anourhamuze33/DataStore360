<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CoLoc — Inscription</title>
  <style>
    :root {
      --noir: #0a0a0a;
      --noir2: #111111;
      --noir3: #1a1a1a;
      --gold: #c9a84c;
      --gold2: #e8c97a;
      --gold-dim: rgba(201, 168, 76, 0.07);
      --gold-border: rgba(201, 168, 76, 0.18);
      --muted: #6b6b6b;
      --text: #e8e8e8;
      --text2: #a0a0a0;
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
    }

    /* LEFT PANEL */
    .left-panel {
      width: 420px;
      flex-shrink: 0;
      background: var(--noir2);
      border-right: 1px solid #1e1e1e;
      display: flex;
      flex-direction: column;
      padding: 48px 44px;
      position: relative;
      overflow: hidden;
    }

    /* decorative background circles */
    .left-panel::before {
      content: '';
      position: absolute;
      width: 340px;
      height: 340px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(201, 168, 76, 0.06) 0%, transparent 70%);
      bottom: -80px;
      left: -80px;
      pointer-events: none;
    }

    .left-panel::after {
      content: '';
      position: absolute;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(201, 168, 76, 0.04) 0%, transparent 70%);
      top: 100px;
      right: -60px;
      pointer-events: none;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1.3rem;
      font-weight: 800;
      letter-spacing: -0.03em;
      color: var(--gold);
      margin-bottom: 56px;
    }

    .logo-icon {
      background: var(--gold);
      color: var(--noir);
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      font-weight: 800;
    }

    .panel-title {
      font-size: 1.7rem;
      font-weight: 800;
      letter-spacing: -0.03em;
      line-height: 1.2;
      margin-bottom: 14px;
    }

    .panel-title span {
      color: var(--gold);
    }

    .panel-sub {
      font-size: 0.88rem;
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 44px;
    }

    .feature-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .feature-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }

    .feature-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: var(--gold-dim);
      border: 1px solid var(--gold-border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .feature-text .ft {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--text);
    }

    .feature-text .fs {
      font-size: 0.75rem;
      color: var(--muted);
      margin-top: 2px;
    }

    .panel-footer {
      margin-top: auto;
      font-size: 0.72rem;
      color: var(--muted);
      border-top: 1px solid #1e1e1e;
      padding-top: 20px;
    }

    /* RIGHT PANEL */
    .right-panel {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 40px;
      overflow-y: auto;
    }

    .form-box {
      width: 100%;
      max-width: 460px;
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

    .form-box-title {
      font-size: 1.25rem;
      font-weight: 800;
      letter-spacing: -0.02em;
      margin-bottom: 4px;
    }

    .form-box-sub {
      font-size: 0.82rem;
      color: var(--muted);
      margin-bottom: 32px;
    }

    .form-box-sub a {
      color: var(--gold);
      text-decoration: none;
    }

    .form-box-sub a:hover {
      text-decoration: underline;
    }

    /* FORM ELEMENTS */
    .form-group {
      margin-bottom: 18px;
    }

    .form-label {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--text2);
      margin-bottom: 7px;
    }

    .form-label .req {
      color: var(--gold);
    }

    .form-label .hint {
      font-weight: 400;
      color: var(--muted);
      font-size: 0.68rem;
    }

    .input-wrap {
      position: relative;
    }

    .form-input {
      width: 100%;
      background: var(--noir3);
      border: 1px solid #252525;
      color: var(--text);
      font-family: system-ui, sans-serif;
      font-size: 0.9rem;
      padding: 11px 14px;
      border-radius: 8px;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }

    .form-input:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.08);
    }

    .form-input:hover:not(:focus) {
      border-color: #333;
    }

    .form-input::placeholder {
      color: #383838;
    }

    .form-input.error {
      border-color: var(--red);
    }

    .form-input.error:focus {
      box-shadow: 0 0 0 3px rgba(224, 82, 82, 0.08);
    }

    .form-input.success {
      border-color: var(--green);
    }

    /* with icon */
    .input-wrap .input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 0.9rem;
      pointer-events: none;
      opacity: 0.4;
    }

    .input-wrap.has-icon .form-input {
      padding-left: 36px;
    }

    /* password toggle */
    .pwd-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: var(--muted);
      font-size: 0.8rem;
      user-select: none;
      transition: color 0.15s;
    }

    .pwd-toggle:hover {
      color: var(--text2);
    }

    .helper-text {
      font-size: 0.68rem;
      color: var(--muted);
      margin-top: 5px;
    }

    .error-text {
      font-size: 0.68rem;
      color: var(--red);
      margin-top: 5px;
      display: none;
    }

    /* GRID */
    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    /* PASSWORD STRENGTH */
    .pwd-strength {
      margin-top: 8px;
    }

    .pwd-strength-bars {
      display: flex;
      gap: 4px;
      margin-bottom: 5px;
    }

    .pwd-bar {
      flex: 1;
      height: 3px;
      border-radius: 2px;
      background: #252525;
      transition: background 0.3s;
    }

    .pwd-bar.weak {
      background: var(--red);
    }

    .pwd-bar.medium {
      background: #f59e0b;
    }

    .pwd-bar.strong {
      background: var(--green);
    }

    .pwd-label {
      font-size: 0.65rem;
      color: var(--muted);
    }

    /* DIVIDER */
    .divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 24px 0;
      font-size: 0.72rem;
      color: var(--muted);
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: #1e1e1e;
    }

    /* CGU */
    .cgu-check {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 0.78rem;
      color: var(--text2);
      margin-bottom: 22px;
    }

    .cgu-check input[type=checkbox] {
      width: 16px;
      height: 16px;
      margin-top: 1px;
      accent-color: var(--gold);
      cursor: pointer;
      flex-shrink: 0;
    }

    .cgu-check a {
      color: var(--gold);
      text-decoration: none;
    }

    .cgu-check a:hover {
      text-decoration: underline;
    }

    /* SUBMIT */
    .btn-submit {
      width: 100%;
      padding: 13px;
      background: var(--gold);
      color: var(--noir);
      font-family: system-ui, sans-serif;
      font-size: 0.92rem;
      font-weight: 700;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.15s;
      letter-spacing: 0.01em;
    }

    .btn-submit:hover {
      background: var(--gold2);
      transform: translateY(-1px);
      box-shadow: 0 6px 22px rgba(201, 168, 76, 0.22);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    .login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 0.8rem;
      color: var(--muted);
    }

    .login-link a {
      color: var(--gold);
      text-decoration: none;
      font-weight: 600;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    /* SCROLLBAR */
    ::-webkit-scrollbar {
      width: 4px;
    }

    ::-webkit-scrollbar-track {
      background: var(--noir);
    }

    ::-webkit-scrollbar-thumb {
      background: #333;
      border-radius: 2px;
    }

    @media (max-width: 860px) {
      .left-panel {
        display: none;
      }
    }
  </style>
</head>

<body>

  <div class="left-panel">
    <div class="logo">
      <div class="logo-icon">C</div>
      CoLoc
    </div>

    <div class="panel-title">Gérez votre<br>colocation <span>facilement</span></div>
    <div class="panel-sub">Suivez les dépenses partagées, calculez les dettes et simplifiez la vie en communauté.</div>

    <div class="feature-list">
      <div class="feature-item">
        <div class="feature-icon"> D </div>
        <div class="feature-text">
          <div class="ft">Suivi des dépenses</div>
          <div class="fs">Ajoutez et catégorisez toutes vos dépenses communes</div>
        </div>
      </div>
      <div class="feature-item">
        <div class="feature-icon">⇋</div>
        <div class="feature-text">
          <div class="ft">Calcul automatique</div>
          <div class="fs">Soldes et remboursements calculés en temps réel</div>
        </div>
      </div>
      <div class="feature-item">
        <div class="feature-icon">✦</div>
        <div class="feature-text">
          <div class="ft">Invitations faciles</div>
          <div class="fs">Invitez vos colocataires par email en un clic</div>
        </div>
      </div>
      <div class="feature-item">
        <div class="feature-icon">★</div>
        <div class="feature-text">
          <div class="ft">Système de réputation</div>
          <div class="fs">Un score de confiance pour chaque membre</div>
        </div>
      </div>
    </div>

    <div class="panel-footer">
      © 2026 CoLoc · Tous droits réservés
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="right-panel">
    <div class="form-box">

      <div class="form-box-title">Créer un compte</div>
      <div class="form-box-sub">Déjà inscrit ? <a href="#">Connectez-vous ici</a></div>

      <form action="{{route('user.inscription')}}" method="POST">
        @csrf
        <div class="grid-2">
          <div class="form-group">
            <label class="form-label">Nom <span class="req">*</span></label>
            <div class="input-wrap has-icon">
              <input class="form-input" name="name" type="text" placeholder="Hamza">
            </div>
            @error('name') <span class="hint">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Adresse email <span class="req">*</span></label>
          <div class="input-wrap has-icon">
            <span class="input-icon">✉</span>
            <input class="form-input" name="email" id="email" type="email" placeholder="jean.dupont@email.com">
          </div>
          @error('email') <span class="hint">{{$message}}</span> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">
            Mot de passe <span class="req">*</span>
            <span class="hint">Min. 8 caractères</span>
          </label>
          <div class="input-wrap has-icon">
            <span class="input-icon">🔒</span>
            <input class="form-input" id="pwd" name="password" type="password" placeholder="••••••••">
            <span class="pwd-toggle" onclick="togglePwd('pwd', this)">Afficher</span>
          </div>
          <div class="pwd-strength">
            <div class="pwd-strength-bars">
              <div class="pwd-bar" id="bar1"></div>
              <div class="pwd-bar" id="bar2"></div>
              <div class="pwd-bar" id="bar3"></div>
              <div class="pwd-bar" id="bar4"></div>
            </div>
            <div class="pwd-label" id="pwd-label">Entrez un mot de passe</div>
          </div>
          @error('password') <span class="hint">{{ $message }}</span> @enderror
        </div>

        <!-- Confirmer mot de passe -->
        <div class="form-group">
          <label class="form-label">Confirmer le mot de passe <span class="req">*</span></label>
          <div class="input-wrap has-icon">
            <span class="input-icon">🔒</span>
            <input class="form-input" id="pwd2" name="password_confirmation" type="password" placeholder="••••••••">
            <span class="pwd-toggle" onclick="togglePwd('pwd2', this)">Afficher</span>
          </div>
        </div>

        <!-- CGU -->
        <div class="cgu-check">
          <input type="checkbox" id="cgu" required>
          <label for="cgu">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de
              confidentialité</a> de CoLoc.</label>
        </div>

        <!-- Submit -->
        <button class="btn-submit" type="submit">
          Créer mon compte
        </button>

      </form>

      <div class="login-link">
        Vous avez déjà un compte ? <a href="#">Se connecter</a>
      </div>

    </div>
  </div>

  <script>
    function togglePwd(inputId, el) {
    const input = document.getElementById(inputId);

    if (input.type === "password") {
      input.type = "text";
      el.textContent = "Masquer";
    } else {
      input.type = "password";
      el.textContent = "Afficher";
    }
  }

  const pwdInput = document.getElementById("pwd");
  const bars = [
    document.getElementById("bar1"),
    document.getElementById("bar2"),
    document.getElementById("bar3"),
    document.getElementById("bar4"),
  ];
  const label = document.getElementById("pwd-label");

  pwdInput.addEventListener("input", function () {
    const value = pwdInput.value;
    let score = 0;

    if (value.length >= 8) score++;
    if (/[A-Z]/.test(value)) score++;
    if (/[0-9]/.test(value)) score++;
    if (/[^A-Za-z0-9]/.test(value)) score++;

    bars.forEach(bar => {
      bar.className = "pwd-bar";
    });

    if (score === 0) {
      label.textContent = "Entrez un mot de passe";
    }

    if (score === 1) {
      bars[0].classList.add("weak");
      label.textContent = "Faible";
    }

    if (score === 2) {
      bars[0].classList.add("medium");
      bars[1].classList.add("medium");
      label.textContent = "Moyen";
    }

    if (score === 3) {
      bars[0].classList.add("medium");
      bars[1].classList.add("medium");
      bars[2].classList.add("medium");
      label.textContent = "Bon";
    }

    if (score === 4) {
      bars.forEach(bar => bar.classList.add("strong"));
      label.textContent = "Fort";
    }
  });
  </script>
</body>

</html>