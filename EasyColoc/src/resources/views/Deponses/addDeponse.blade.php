<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CoLoc — Ajouter une dépense</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --noir: #0a0a0a;
      --noir2: #111111;
      --noir3: #1a1a1a;
      --noir4: #242424;
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
    }

    /* SIDEBAR */
    .sidebar {
      background: var(--noir2);
      border-right: 1px solid #1e1e1e;
      width: 260px;
      min-height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      display: flex;
      flex-direction: column;
      z-index: 100;
    }

    .logo-mark {
      font-weight: 800;
      font-size: 1.3rem;
      letter-spacing: -0.03em;
      color: var(--gold);
      padding: 26px 24px 22px;
      border-bottom: 1px solid #1e1e1e;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo-icon {
      background: var(--gold);
      color: var(--noir);
      width: 30px;
      height: 30px;
      border-radius: 7px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.95rem;
      font-weight: 800;
      flex-shrink: 0;
    }

    .nav-section {
      padding: 16px 0;
      border-bottom: 1px solid #1e1e1e;
    }

    .nav-label {
      font-size: 0.65rem;
      letter-spacing: 0.13em;
      text-transform: uppercase;
      color: var(--muted);
      padding: 0 22px 8px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 22px;
      font-size: 0.82rem;
      color: var(--text2);
      cursor: pointer;
      transition: all 0.12s;
      text-decoration: none;
      border-left: 2px solid transparent;
    }

    .nav-item:hover {
      color: var(--text);
      background: rgba(255, 255, 255, 0.03);
    }

    .nav-item.active {
      color: var(--gold);
      background: var(--gold-dim);
      border-left-color: var(--gold);
    }

    .badge {
      margin-left: auto;
      background: var(--gold);
      color: var(--noir);
      font-size: 0.62rem;
      font-weight: 700;
      padding: 1px 7px;
      border-radius: 20px;
    }

    .badge.red {
      background: var(--red);
      color: #fff;
    }

    .sidebar-footer {
      margin-top: auto;
      padding: 20px 22px;
      border-top: 1px solid #1e1e1e;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .avatar {
      width: 38px;
      height: 38px;
      border-radius: 9px;
      background: linear-gradient(135deg, #c9a84c, #7a5c1a);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 0.8rem;
      color: var(--noir);
      flex-shrink: 0;
    }

    .user-name {
      font-size: 0.85rem;
      font-weight: 700;
    }

    .user-role {
      font-size: 0.68rem;
      color: var(--muted);
      margin-top: 1px;
    }

    /* MAIN */
    .main {
      margin-left: 260px;
      min-height: 100vh;
    }

    .topbar {
      background: var(--noir2);
      border-bottom: 1px solid #1e1e1e;
      padding: 16px 36px;
      display: flex;
      align-items: center;
      gap: 14px;
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .back-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--muted);
      font-size: 0.82rem;
      cursor: pointer;
      transition: color 0.15s;
      text-decoration: none;
    }

    .back-btn:hover {
      color: var(--text);
    }

    .breadcrumb-sep {
      color: #333;
    }

    .page-title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
    }

    /* CONTENT */
    .content {
      padding: 40px 36px;
      display: flex;
      justify-content: center;
      min-height: calc(100vh - 57px);
    }

    .content-inner {
      width: 100%;
      max-width: 780px;
    }

    /* FORM CARD */
    .form-card {
      background: var(--noir2);
      border: 1px solid #1e1e1e;
      border-radius: 14px;
      overflow: hidden;
    }

    .form-card-header {
      padding: 24px 30px 20px;
      border-bottom: 1px solid #1e1e1e;
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .form-card-icon {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      background: var(--gold-dim);
      border: 1px solid var(--gold-border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      flex-shrink: 0;
    }

    .form-card-title {
      font-size: 1.05rem;
      font-weight: 700;
    }

    .form-card-sub {
      font-size: 0.75rem;
      color: var(--muted);
      margin-top: 3px;
    }

    .form-body {
      padding: 30px;
    }

    /* SECTION DIVIDER */
    .section-title {
      font-size: 0.68rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 16px;
      padding-bottom: 10px;
      border-bottom: 1px solid #1e1e1e;
    }

    /* GRID */
    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 18px;
    }

    .grid-3 {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 18px;
    }

    .gap {
      margin-bottom: 22px;
    }

    /* FORM ELEMENTS */
    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-label {
      font-size: 0.72rem;
      font-weight: 600;
      color: var(--text2);
      margin-bottom: 7px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .form-label .req {
      color: var(--gold);
      font-size: 0.8rem;
    }

    .form-input {
      background: var(--noir3);
      border: 1px solid #252525;
      color: var(--text);
      font-family: system-ui, sans-serif;
      font-size: 0.88rem;
      padding: 11px 14px;
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
      color: #383838;
    }

    .form-input:hover:not(:focus) {
      border-color: #333;
    }

    select.form-input {
      cursor: pointer;
    }

    textarea.form-input {
      resize: vertical;
      min-height: 90px;
      line-height: 1.5;
    }

    /* INPUT WITH PREFIX */
    .input-group {
      position: relative;
    }

    .input-prefix {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gold);
      font-weight: 700;
      font-size: 0.95rem;
      pointer-events: none;
    }

    .input-group .form-input {
      padding-left: 30px;
    }

    /* PAYER SELECTOR */
    .payer-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }

    .payer-card {
      border: 1px solid #252525;
      border-radius: 9px;
      padding: 12px 10px;
      text-align: center;
      cursor: pointer;
      transition: all 0.15s;
      background: var(--noir3);
    }

    .payer-card:hover {
      border-color: #444;
    }

    .payer-card.selected {
      border-color: var(--gold);
      background: var(--gold-dim);
      box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.08);
    }

    .payer-avatar {
      width: 40px;
      height: 40px;
      border-radius: 9px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 0.8rem;
      margin: 0 auto 8px;
    }

    .pa-gold {
      background: linear-gradient(135deg, #c9a84c, #7a5c1a);
      color: var(--noir);
    }

    .pa-blue {
      background: linear-gradient(135deg, #5b8af5, #2a4fa0);
      color: #fff;
    }

    .pa-purple {
      background: linear-gradient(135deg, #c952e0, #7a1a9a);
      color: #fff;
    }

    .pa-green {
      background: linear-gradient(135deg, #52c97a, #1a7a42);
      color: #fff;
    }

    .payer-name {
      font-size: 0.72rem;
      font-weight: 600;
      color: var(--text);
    }

    .payer-you {
      font-size: 0.62rem;
      color: var(--gold);
      margin-top: 2px;
    }

    .payer-check {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      border: 2px solid #333;
      margin: 6px auto 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.15s;
    }

    .payer-card.selected .payer-check {
      background: var(--gold);
      border-color: var(--gold);
    }

    .payer-card.selected .payer-check::after {
      content: '✓';
      font-size: 0.6rem;
      color: var(--noir);
      font-weight: 800;
    }

    /* CATEGORY PILLS */
    .category-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .cat-pill {
      display: flex;
      align-items: center;
      gap: 7px;
      padding: 8px 14px;
      border-radius: 8px;
      border: 1px solid #252525;
      background: var(--noir3);
      cursor: pointer;
      transition: all 0.15s;
      font-size: 0.8rem;
      color: var(--text2);
    }

    .cat-pill:hover {
      border-color: #444;
      color: var(--text);
    }

    .cat-pill.selected {
      border-color: var(--gold);
      color: var(--gold);
      background: var(--gold-dim);
    }

    .cat-icon {
      font-size: 1rem;
    }

    /* SPLIT METHOD */
    .split-options {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
    }

    .split-card {
      border: 1px solid #252525;
      border-radius: 9px;
      padding: 14px 12px;
      cursor: pointer;
      transition: all 0.15s;
      background: var(--noir3);
      text-align: center;
    }

    .split-card:hover {
      border-color: #444;
    }

    .split-card.selected {
      border-color: var(--gold);
      background: var(--gold-dim);
    }

    .split-icon {
      font-size: 1.4rem;
      margin-bottom: 6px;
    }

    .split-label {
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--text);
    }

    .split-desc {
      font-size: 0.66rem;
      color: var(--muted);
      margin-top: 3px;
    }

    .split-card.selected .split-label {
      color: var(--gold);
    }

    /* AMOUNT PREVIEW */
    .amount-preview {
      background: var(--noir3);
      border: 1px solid #1e1e1e;
      border-radius: 10px;
      padding: 16px 20px;
      margin-top: 16px;
    }

    .preview-title {
      font-size: 0.68rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 12px;
    }

    .preview-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 7px 0;
      border-bottom: 1px solid #1e1e1e;
      font-size: 0.82rem;
    }

    .preview-row:last-child {
      border-bottom: none;
    }

    .preview-name {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--text2);
    }

    .preview-mini-av {
      width: 24px;
      height: 24px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.6rem;
      font-weight: 800;
    }

    .preview-amount {
      font-weight: 700;
      color: var(--text);
    }

    /* FOOTER */
    .form-footer {
      padding: 22px 30px;
      border-top: 1px solid #1e1e1e;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #0d0d0d;
    }

    .form-footer-info {
      font-size: 0.72rem;
      color: var(--muted);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 10px 20px;
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

    .btn-outline {
      background: transparent;
      color: var(--text2);
      border: 1px solid #333;
    }

    .btn-outline:hover {
      border-color: #555;
      color: var(--text);
    }

    .btn-ghost {
      background: transparent;
      color: var(--muted);
    }

    .btn-ghost:hover {
      color: var(--text2);
    }

    /* HELPER TEXT */
    .helper {
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

    /* DIVIDER */
    .section-gap {
      margin-bottom: 28px;
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

    @keyframes up {
      from {
        opacity: 0;
        transform: translateY(8px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    .form-card {
      animation: up 0.3s 0.05s both;
    }
  </style>
</head>

<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="logo-mark">
      <div class="logo-icon">C</div>
      CoLoc
    </div>
    <nav>
      <div class="nav-section">
        <div class="nav-label">Navigation</div>
        <a class="nav-item" href="#">⬡ Dashboard</a>
        <a class="nav-item" href="#">⌂ Ma Colocation <span class="badge">Active</span></a>
        <a class="nav-item active" href="#">◈ Dépenses</a>
        <a class="nav-item" href="#">⇋ Balances <span class="badge red">3</span></a>
        <a class="nav-item" href="#">◎ Membres</a>
      </div>
      <div class="nav-section">
        <div class="nav-label">Paramètres</div>
        <a class="nav-item" href="#">◻ Catégories</a>
        <a class="nav-item" href="#">✦ Invitations</a>
      </div>
    </nav>
    <div class="sidebar-footer">
      <div class="avatar">JD</div>
      <div>
        <div class="user-name">Jean Dupont</div>
        <div class="user-role">Owner · ★★★★☆</div>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- Topbar -->
    <div class="topbar">
      <a class="back-btn" href="{{route('colocation.index')}}">Retour</a>
      <span class="breadcrumb-sep">/</span>
      <span style="color:var(--text2);font-size:0.82rem;">Dépenses</span>
      <span class="breadcrumb-sep">/</span>
      <span class="page-title">Ajouter une dépense</span>
    </div>

    <div class="content">
      <form action="{{route('colocation.store')}}" method="POST" class="content-inner">
        @csrf
        <div class="form-card">

          <!-- Header -->
          <div class="form-card-header">
            <div class="form-card-icon">D</div>
            <div>
              <div class="form-card-title">Nouvelle dépense</div>
              <div class="form-card-sub">Ajoutez une dépense partagée entre les membres de votre colocation</div>
            </div>
          </div>

          <div class="form-body">

            <!-- Section 1: Infos générales -->
            <div class="section-gap">
              <div class="section-title">Informations générales</div>

              <div class="gap">
                <div class="form-group">
                  <label class="form-label">Titre de la dépense <span class="req">*</span></label>
                  <input class="form-input" name="title" type="text" placeholder="Ex: Courses Carrefour, Facture EDF..."
                    maxlength="100">
                  <span class="helper">Soyez précis pour que vos colocataires comprennent facilement</span>
                </div>
              </div>

              <div class="grid-2 gap">
                <div class="form-group">
                  <label class="form-label">Montant <span class="req">*</span></label>
                  <div class="input-group">
                    <span class="input-prefix">€</span>
                    <input class="form-input" name="amount" id="amount" type="number" placeholder="0.00" min="0.01" step="0.01" oninput="settleRemboursement(this)">
                  </div>
                  <span class="helper">Montant total de la dépense</span>
                </div>
                <div class="form-group">
                  <label class="form-label">Date <span class="req">*</span></label>
                  <input class="form-input" name="date" type="date" value="2026-02-23">
                </div>
              </div>
            </div>

            <!-- Section 2: Catégorie -->
            <div class="section-gap">
              <div class="section-title">Catégorie <span style="color:var(--gold);">*</span></div>
                <input type="hidden" name="category" id="categoryInput" value="Alimentation">
              <div class="category-grid">
                <div class="cat- sepilllected" onclick="selectCat(this)">Alimentation</div>
                <div class="cat-pill" onclick="selectCat(this)">Loyer</div>
                <div class="cat-pill" onclick="selectCat(this)">Énergie</div>
                <div class="cat-pill" onclick="selectCat(this)">Loisirs</div>
                <div class="cat-pill" onclick="selectCat(this)">Transport</div>
                <div class="cat-pill" onclick="selectCat(this)">Entretien</div>
                <div class="cat-pill" onclick="selectCat(this)">Santé</div>
                <div class="cat-pill" onclick="selectCat(this)">Autre</div>
              </div>
            </div>

            <!-- Preview -->
            <div class="amount-preview">
              <div class="preview-title">Aperçu de la répartition — montant saisi : <span
                  style="color:var(--gold);">120,00€</span></div>
              <div class="preview-row">
                <div class="preview-name">
                  <div class="preview-mini-av pa-gold"
                    style="background:linear-gradient(135deg,#c9a84c,#7a5c1a);color:#0a0a0a;">JD</div>
                  Jean Dupont <span style="font-size:0.65rem;color:var(--gold);margin-left:4px;">Payeur</span>
                </div>
                <div class="preview-amount" style="color:var(--green);">+90,00€</div>
              </div>
              <div class="preview-row">
                <div class="preview-name">
                  <div class="preview-mini-av" style="background:linear-gradient(135deg,#5b8af5,#2a4fa0);color:#fff;">ML
                  </div>
                  Marie Lefèvre
                </div>
                <div class="preview-amount" style="color:var(--red);">−30,00€</div>
              </div>
              <div class="preview-row">
                <div class="preview-name">
                  <div class="preview-mini-av" style="background:linear-gradient(135deg,#c952e0,#7a1a9a);color:#fff;">AR
                  </div>
                  Alex Robin
                </div>
                <div class="preview-amount" style="color:var(--red);">−30,00€</div>
              </div>
              <div class="preview-row">
                <div class="preview-name">
                  <div class="preview-mini-av" style="background:linear-gradient(135deg,#52c97a,#1a7a42);color:#fff;">TR
                  </div>
                  Tom Renard
                </div>
                <div class="preview-amount" style="color:var(--red);">−30,00€</div>
              </div>
            </div>
          </div>

        </div><!-- /form-body -->

        <!-- Footer -->
        <div class="form-footer">
          <div class="form-footer-info">Les champs marqués <span style="color:var(--gold);">*</span> sont obligatoires
          </div>
          <div style="display:flex;gap:10px;">
            <button class="btn btn-outline">Annuler</button>
            <button class="btn btn-gold">D Ajouter la dépense</button>
          </div>
        </div>

      </form>
    </div>
    </div>
  </main>

 <script>

  function settleRemboursement(el) {

    let elValue = parseFloat(el.value);
    if (isNaN(elValue) || elValue < 0) return;
    const Amounts = document.querySelectorAll('.preview-amount');
    let nbrChaqueOne = (elValue / 3).toFixed(2);
    Amounts[0].innerText = '+' + elValue.toFixed(2) + '€';
    Amounts.forEach((amount, index) => {
      if (index === 0) return;
      amount.innerText = '-' + nbrChaqueOne + '€';
    });
  }

  function selectCat(el) {
    document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('selected'));
    el.classList.add('selected');
    const categoryInput = document.getElementById('categoryInput').value = el.innerText.trim();
    console.log(categoryInput);
  }

  document.querySelectorAll('.nav-item').forEach(t => {
    t.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelectorAll('.nav-item').forEach(x => x.classList.remove('active'));
      this.classList.add('active');
    });
  });

</script>
</body>

</html>