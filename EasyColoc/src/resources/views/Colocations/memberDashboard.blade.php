<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CoLoc — Dashboard</title>
  <style>
    :root {
      --noir:  #0a0a0a;
      --noir2: #111111;
      --noir3: #1a1a1a;
      --noir4: #222222;
      --gold:  #c9a84c;
      --gold2: #e8c97a;
      --gold-dim: rgba(201,168,76,0.07);
      --gold-border: rgba(201,168,76,0.16);
      --muted: #5a5a5a;
      --text:  #e8e8e8;
      --text2: #999;
      --red:   #e05252;
      --green: #52c97a;
      --blue:  #5b8af5;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--noir);
      color: var(--text);
      font-family: system-ui, -apple-system, sans-serif;
      min-height: 100vh;
      display: flex;
    }

    /* ── SIDEBAR ── */
    .sidebar {
      width: 250px; flex-shrink: 0;
      background: var(--noir2);
      border-right: 1px solid #1e1e1e;
      min-height: 100vh;
      position: fixed; left: 0; top: 0;
      display: flex; flex-direction: column;
      z-index: 100;
    }

    .logo {
      display: flex; align-items: center; gap: 10px;
      padding: 22px 20px 18px;
      border-bottom: 1px solid #1e1e1e;
      font-size: 1.15rem; font-weight: 800;
      letter-spacing: -0.03em; color: var(--gold);
      text-decoration: none;
    }
    .logo-icon {
      background: var(--gold); color: var(--noir);
      width: 28px; height: 28px; border-radius: 7px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.85rem; font-weight: 800; flex-shrink: 0;
    }

    /* coloc badge in sidebar */
    .coloc-chip {
      margin: 14px 14px 4px;
      background: var(--gold-dim); border: 1px solid var(--gold-border);
      border-radius: 9px; padding: 10px 13px;
      display: flex; align-items: center; gap: 9px;
    }
    .coloc-chip-dot { width: 7px; height: 7px; background: var(--green); border-radius: 50%; flex-shrink: 0; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
    .coloc-chip-name { font-size: 0.78rem; font-weight: 700; color: var(--gold); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .coloc-chip-role { font-size: 0.62rem; color: var(--muted); margin-top: 1px; }

    .nav-section { padding: 12px 0; border-bottom: 1px solid #1a1a1a; }
    .nav-label { font-size: 0.58rem; letter-spacing: 0.13em; text-transform: uppercase; color: var(--muted); padding: 0 20px 6px; }

    .nav-item {
      display: flex; align-items: center; gap: 9px;
      padding: 9px 20px; font-size: 0.82rem;
      color: var(--text2); text-decoration: none;
      transition: all 0.12s; border-left: 2px solid transparent;
      cursor: pointer;
    }
    .nav-item:hover { color: var(--text); background: rgba(255,255,255,0.025); }
    .nav-item.active { color: var(--gold); background: var(--gold-dim); border-left-color: var(--gold); }
    .nav-item .ni { width: 14px; text-align: center; font-size: 0.82rem; opacity: 0.6; }
    .nav-item.active .ni { opacity: 1; }

    .nav-badge {
      margin-left: auto; padding: 1px 7px; border-radius: 20px;
      font-size: 0.58rem; font-weight: 700;
    }
    .nb-gold { background: var(--gold); color: var(--noir); }
    .nb-red  { background: var(--red);  color: #fff; }
    .nb-gray { background: #222; color: var(--muted); border: 1px solid #2a2a2a; }

    .sidebar-footer {
      margin-top: auto; padding: 16px 18px;
      border-top: 1px solid #1a1a1a;
      display: flex; align-items: center; gap: 10px;
    }
    .avatar {
      width: 36px; height: 36px; border-radius: 9px;
      background: linear-gradient(135deg, #c9a84c, #7a5c1a);
      display: flex; align-items: center; justify-content: center;
      font-weight: 800; font-size: 0.75rem; color: var(--noir); flex-shrink: 0;
    }
    .av-b { background: linear-gradient(135deg, #5b8af5, #2a4fa0); color: #fff; }
    .av-c { background: linear-gradient(135deg, #c952e0, #7a1a9a); color: #fff; }
    .av-d { background: linear-gradient(135deg, #52c97a, #1a7a42); color: #fff; }
    .user-name { font-size: 0.8rem; font-weight: 700; }
    .user-sub  { font-size: 0.62rem; color: var(--muted); margin-top: 1px; }

    .dropdown { position: relative; }
    .dropdown-menu {
      position: absolute; right: 0; bottom: calc(100% + 6px);
      background: var(--noir2); border: 1px solid #252525;
      border-radius: 9px; min-width: 150px;
      box-shadow: 0 -16px 40px rgba(0,0,0,0.5); z-index: 300; display: none;
    }
    .dropdown:hover .dropdown-menu { display: block; }
    .drop-item { display: block; padding: 9px 14px; font-size: 0.75rem; color: var(--text2); cursor: pointer; transition: all 0.1s; text-decoration: none; }
    .drop-item:hover { background: rgba(255,255,255,0.04); color: var(--text); }
    .drop-item:not(:last-child) { border-bottom: 1px solid #1a1a1a; }
    .drop-item.danger { color: var(--red); }
    .drop-item.danger:hover { background: rgba(224,82,82,0.05); }

    .icon-btn {
      background: transparent; border: none; color: var(--muted);
      cursor: pointer; font-size: 0.9rem; padding: 4px 6px;
      transition: color 0.13s; border-radius: 5px;
    }
    .icon-btn:hover { color: var(--text2); background: rgba(255,255,255,0.04); }

    /* ── MAIN ── */
    .main { margin-left: 250px; flex: 1; min-height: 100vh; display: flex; flex-direction: column; }

    /* ── TOPBAR ── */
    .topbar {
      background: var(--noir2); border-bottom: 1px solid #1e1e1e;
      padding: 0 28px; height: 54px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 50; flex-shrink: 0;
    }

    .topbar-left { display: flex; align-items: center; gap: 16px; }
    .topbar-title { font-size: 0.95rem; font-weight: 700; }
    .topbar-sub { font-size: 0.72rem; color: var(--muted); }

    .topbar-right { display: flex; align-items: center; gap: 8px; }

    .btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 7px 16px; border-radius: 7px;
      font-family: system-ui, sans-serif; font-size: 0.8rem;
      cursor: pointer; transition: all 0.14s;
      text-decoration: none; border: none; outline: none; font-weight: 600;
    }
    .btn-gold { background: var(--gold); color: var(--noir); }
    .btn-gold:hover { background: var(--gold2); transform: translateY(-1px); }
    .btn-outline { background: transparent; color: var(--text2); border: 1px solid #2a2a2a; font-weight: 400; }
    .btn-outline:hover { border-color: #3a3a3a; color: var(--text); }
    .btn-ghost { background: transparent; color: var(--muted); font-weight: 400; }
    .btn-ghost:hover { color: var(--text2); }
    .btn-danger { background: transparent; color: var(--red); border: 1px solid rgba(224,82,82,0.2); font-weight: 400; }
    .btn-danger:hover { background: rgba(224,82,82,0.06); }

    /* ── CONTENT ── */
    .content { padding: 26px 28px; flex: 1; }

    /* WELCOME BANNER */
    .welcome-banner {
      background: linear-gradient(120deg, #141108 0%, #0f0d05 100%);
      border: 1px solid #2a2415;
      border-radius: 12px; padding: 20px 24px;
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 22px;
      animation: fadeUp 0.3s 0.05s both;
    }
    @keyframes fadeUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }

    .wb-left {}
    .wb-greeting { font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--gold); opacity: 0.7; margin-bottom: 4px; }
    .wb-title { font-size: 1.25rem; font-weight: 800; letter-spacing: -0.02em; }
    .wb-sub { font-size: 0.75rem; color: var(--muted); margin-top: 3px; }
    .wb-right { display: flex; gap: 8px; }

    /* STAT CARDS */
    .stats-row {
      display: grid; grid-template-columns: repeat(4, 1fr);
      gap: 12px; margin-bottom: 20px;
      animation: fadeUp 0.3s 0.1s both;
    }
    .stat-card {
      background: var(--noir2); border: 1px solid #1e1e1e;
      border-radius: 10px; padding: 16px 18px;
      position: relative; overflow: hidden; transition: border-color 0.2s;
    }
    .stat-card:hover { border-color: var(--gold-border); }
    .stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; }
    .sc-gold::before { background: var(--gold); }
    .sc-green::before { background: var(--green); }
    .sc-red::before { background: var(--red); }
    .sc-blue::before { background: var(--blue); }
    .sc-dim::before { opacity: 0.3; }

    .sc-label { font-size: 0.6rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); margin-bottom: 8px; }
    .sc-value { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.04em; }
    .sc-value.green { color: var(--green); }
    .sc-value.red   { color: var(--red); }
    .sc-value.gold  { color: var(--gold); font-size: 1.2rem; }
    .sc-sub { font-size: 0.65rem; color: var(--muted); margin-top: 5px; }
    .sc-icon { position:absolute; right:14px; top:14px; font-size:1.2rem; opacity:0.07; }

    /* GRID LAYOUT */
    .grid-main {
      display: grid; grid-template-columns: 1.55fr 1fr;
      gap: 14px; margin-bottom: 14px;
      animation: fadeUp 0.3s 0.15s both;
    }
    .grid-bottom {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 14px;
      animation: fadeUp 0.3s 0.2s both;
    }

    /* CARD */
    .card { background: var(--noir2); border: 1px solid #1e1e1e; border-radius: 11px; overflow: hidden; }
    .card-header {
      padding: 16px 20px 12px; border-bottom: 1px solid #1a1a1a;
      display: flex; align-items: center; justify-content: space-between;
    }
    .card-title { font-size: 0.82rem; font-weight: 700; }
    .card-body  { padding: 16px 20px; }

    /* TAG */
    .tag { display:inline-flex; align-items:center; padding:2px 7px; border-radius:4px; font-size:0.6rem; font-weight:500; letter-spacing:0.04em; }
    .tg-gold  { background: var(--gold-dim); color: var(--gold); border: 1px solid var(--gold-border); }
    .tg-green { background: rgba(82,201,122,0.08); color: var(--green); border: 1px solid rgba(82,201,122,0.2); }
    .tg-red   { background: rgba(224,82,82,0.08); color: var(--red); }
    .tg-gray  { background: rgba(255,255,255,0.05); color: var(--muted); }
    .tg-blue  { background: rgba(91,138,245,0.08); color: var(--blue); }

    /* TABLE */
    .table { width:100%; border-collapse:collapse; }
    .table th { font-size:0.6rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); text-align:left; padding:8px 12px; border-bottom:1px solid #181818; font-weight:400; }
    .table td { padding:11px 12px; font-size:0.78rem; color:var(--text2); border-bottom:1px solid #111; }
    .table tr:last-child td { border-bottom:none; }
    .table tr:hover td { background:rgba(255,255,255,0.015); color:var(--text); }

    .pos { color:var(--green); font-weight:700; }
    .neg { color:var(--red);   font-weight:700; }

    /* MINI AVATAR */
    .mini-av {
      width: 22px; height: 22px; border-radius: 5px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.55rem; font-weight: 800;
    }

    /* DEBT ROWS */
    .debt-row { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid #141414; }
    .debt-row:last-child { border-bottom:none; }
    .debt-info { flex:1; }
    .debt-names { font-size:0.75rem; color:var(--text); }
    .debt-names span { color:var(--muted); font-size:0.7rem; }
    .debt-sub { font-size:0.62rem; color:var(--muted); margin-top:1px; }
    .debt-right { text-align:right; }
    .debt-amt { font-weight:700; font-size:0.85rem; }

    /* PROGRESS */
    .progress { background:#1a1a1a; border-radius:3px; height:3px; overflow:hidden; margin-top:8px; }
    .progress-fill { height:100%; background:var(--gold); border-radius:3px; }

    /* MEMBER ROW */
    .member-row { display:flex; align-items:center; gap:10px; padding:9px 0; border-bottom:1px solid #141414; }
    .member-row:last-child { border-bottom:none; }
    .member-info { flex:1; }
    .member-name { font-size:0.78rem; font-weight:600; color:var(--text); }
    .member-role { font-size:0.62rem; color:var(--muted); margin-top:1px; }
    .member-rep { font-size:0.68rem; color:var(--gold); }
    .member-rep.low { color:var(--red); }

    /* ACTIVITY */
    .activity-row { display:flex; align-items:flex-start; gap:10px; padding:9px 0; border-bottom:1px solid #141414; }
    .activity-row:last-child { border-bottom:none; }
    .act-icon { width:28px; height:28px; border-radius:7px; display:flex; align-items:center; justify-content:center; font-size:0.8rem; flex-shrink:0; margin-top:1px; }
    .act-gold { background:var(--gold-dim); border:1px solid var(--gold-border); }
    .act-green { background:rgba(82,201,122,0.08); border:1px solid rgba(82,201,122,0.15); }
    .act-red { background:rgba(224,82,82,0.08); border:1px solid rgba(224,82,82,0.15); }
    .act-text { font-size:0.76rem; color:var(--text2); flex:1; line-height:1.4; }
    .act-text strong { color:var(--text); font-weight:600; }
    .act-time { font-size:0.62rem; color:var(--muted); margin-top:3px; }
    .act-amount { font-size:0.78rem; font-weight:700; flex-shrink:0; align-self:center; }

    /* DIVIDER */
    .hr { border:none; border-top:1px solid #181818; margin:14px 0; }

    /* MODAL */
    .modal-overlay { position:fixed; inset:0; background:rgba(0,0,0,0.78); backdrop-filter:blur(4px); z-index:200; display:flex; align-items:center; justify-content:center; }
    .modal { background:var(--noir2); border:1px solid #252525; border-radius:13px; width:440px; max-width:95vw; box-shadow:0 40px 80px rgba(0,0,0,0.7); }
    .modal-header { padding:20px 24px 16px; border-bottom:1px solid #1a1a1a; display:flex; align-items:center; justify-content:space-between; }
    .modal-title { font-size:0.95rem; font-weight:700; }
    .modal-body { padding:20px 24px; display:grid; gap:14px; }
    .modal-footer { padding:14px 24px; border-top:1px solid #1a1a1a; display:flex; gap:8px; justify-content:flex-end; }
    .form-label-m { font-size:0.68rem; font-weight:600; color:var(--text2); margin-bottom:5px; display:block; text-transform:uppercase; letter-spacing:0.06em; }
    .form-input-m { width:100%; background:var(--noir3); border:1px solid #222; color:var(--text); font-family:system-ui,sans-serif; font-size:0.85rem; padding:9px 12px; border-radius:7px; outline:none; transition:border-color 0.15s; }
    .form-input-m:focus { border-color:var(--gold); }
    .form-input-m::placeholder { color:#2e2e2e; }
    select.form-input-m { cursor:pointer; }

    ::-webkit-scrollbar { width:4px; }
    ::-webkit-scrollbar-track { background:var(--noir); }
    ::-webkit-scrollbar-thumb { background:#282828; border-radius:2px; }

    /* NOTIFICATION DOT */
    .notif { position:relative; }
    .notif-dot { width:7px; height:7px; background:var(--red); border-radius:50%; position:absolute; top:0; right:0; }

    /* QUICK ACTIONS */
    .quick-actions {
      display:grid; grid-template-columns:repeat(4,1fr);
      gap:10px; margin-bottom:20px;
      animation: fadeUp 0.3s 0.08s both;
    }
    .qa-card {
      background:var(--noir2); border:1px solid #1e1e1e;
      border-radius:9px; padding:14px 12px; text-align:center;
      cursor:pointer; transition:all 0.14s;
    }
    .qa-card:hover { border-color:var(--gold-border); transform:translateY(-2px); }
    .qa-icon { font-size:1.3rem; margin-bottom:7px; }
    .qa-label { font-size:0.72rem; font-weight:600; color:var(--text2); }
    .qa-card:hover .qa-label { color:var(--gold); }

    @media (max-width:900px) { .stats-row { grid-template-columns:repeat(2,1fr); } .grid-main,.grid-bottom { grid-template-columns:1fr; } .quick-actions { grid-template-columns:repeat(2,1fr); } }
  </style>
</head>
<body>

<!-- ══════════════ SIDEBAR ══════════════ -->
<aside class="sidebar">
  <a class="logo" href="#">
    <div class="logo-icon">C</div>
    CoLoc
  </a>

  <!-- Active coloc chip -->
  <div class="coloc-chip">
    <div class="coloc-chip-dot"></div>
    <div>
      <div class="coloc-chip-name">Les Appartés du 12ème</div>
      <div class="coloc-chip-role">Owner · 4 membres</div>
    </div>
  </div>

  <nav>
    <div class="nav-section">
      <div class="nav-label">Principal</div>
      <a class="nav-item active" href="#"><span class="ni">⬡</span> Dashboard</a>
      <a class="nav-item" href="#"><span class="ni">⌂</span> Ma Colocation <span class="nav-badge nb-gold">Active</span></a>
      <a class="nav-item" href="#"><span class="ni">◈</span> Dépenses</a>
      <a class="nav-item" href="#"><span class="ni">⇋</span> Balances <span class="nav-badge nb-red">3</span></a>
      <a class="nav-item" href="#"><span class="ni">◎</span> Membres</a>
    </div>
    <div class="nav-section">
      <div class="nav-label">Gestion</div>
      <a class="nav-item" href="#"><span class="ni">◻</span> Catégories</a>
      <a class="nav-item" href="#"><span class="ni">✦</span> Invitations <span class="nav-badge nb-gray">1</span></a>
      <a class="nav-item" href="#"><span class="ni">👤</span> Mon profil</a>
    </div>
    <div class="nav-section">
      <div class="nav-label">Admin Global</div>
      <a class="nav-item" href="#"><span class="ni">⬡</span> Statistiques</a>
      <a class="nav-item" href="#"><span class="ni">🛡</span> Utilisateurs</a>
    </div>
  </nav>

  <div class="sidebar-footer">
    <div class="avatar">JD</div>
    <div style="flex:1;overflow:hidden;">
      <div class="user-name">Jean Dupont</div>
      <div class="user-sub">Owner · ★★★★☆</div>
    </div>
    <div class="dropdown">
      <button class="icon-btn">⋮</button>
      <div class="dropdown-menu">
        <a class="drop-item" href="#">Mon profil</a>
        <a class="drop-item" href="#">Paramètres</a>
        <a class="drop-item danger" href="#">Déconnexion</a>
      </div>
    </div>
  </div>
</aside>

<!-- ══════════════ MAIN ══════════════ -->
<main class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-left">
      <div>
        <div class="topbar-title">Tableau de bord</div>
      </div>
    </div>
    <div class="topbar-right">
      <div class="notif">
        <button class="icon-btn" style="font-size:1rem;">🔔</button>
        <span class="notif-dot"></span>
      </div>
      <button class="btn btn-outline" onclick="document.getElementById('m-invite').style.display='flex'">+ Inviter</button>
      <button class="btn btn-gold" onclick="document.getElementById('m-dep').style.display='flex'">+ Dépense</button>
    </div>
  </div>

  <div class="content">

    <!-- WELCOME BANNER -->
    <div class="welcome-banner">
      <div class="wb-left">
        <div class="wb-greeting">Bienvenue de retour 👋</div>
        <div class="wb-title">Bonjour, Jean !</div>
        <div class="wb-sub">Les Appartés du 12ème · Paris 12e · depuis janv. 2025 · 4 membres actifs</div>
      </div>
      <div class="wb-right">
        <button class="btn btn-outline">Gérer la coloc</button>
        <button class="btn btn-danger" style="font-size:0.75rem;">Quitter</button>
      </div>
    </div>

    <!-- QUICK ACTIONS -->
    <div class="quick-actions">
      <div class="qa-card" onclick="document.getElementById('m-dep').style.display='flex'">
        <div class="qa-icon">💸</div>
        <div class="qa-label">Ajouter une dépense</div>
      </div>
      <div class="qa-card">
        <div class="qa-icon">✓</div>
        <div class="qa-label">Marquer payé</div>
      </div>
      <div class="qa-card" onclick="document.getElementById('m-invite').style.display='flex'">
        <div class="qa-icon">✦</div>
        <div class="qa-label">Inviter un membre</div>
      </div>
      <div class="qa-card">
        <div class="qa-icon">⇋</div>
        <div class="qa-label">Voir les balances</div>
      </div>
    </div>

    <!-- STATS -->
    <div class="stats-row">
      <div class="stat-card sc-gold">
        <div class="sc-icon">€</div>
        <div class="sc-label">Total dépenses</div>
        <div class="sc-value">3 240€</div>
        <div class="sc-sub">+420€ ce mois-ci</div>
      </div>
      <div class="stat-card sc-green">
        <div class="sc-icon">↑</div>
        <div class="sc-label">Mon solde</div>
        <div class="sc-value green">+185€</div>
        <div class="sc-sub">On vous doit de l'argent</div>
      </div>
      <div class="stat-card sc-red sc-dim">
        <div class="sc-icon">⚠</div>
        <div class="sc-label">Remboursements</div>
        <div class="sc-value red">3</div>
        <div class="sc-sub">En attente de paiement</div>
      </div>
      <div class="stat-card sc-blue sc-dim">
        <div class="sc-icon">★</div>
        <div class="sc-label">Réputation</div>
        <div class="sc-value gold">★★★★☆</div>
        <div class="sc-sub">Score : 4/5 — Très bon</div>
      </div>
    </div>

    <!-- MAIN GRID -->
    <div class="grid-main">

      <!-- Dépenses récentes -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">Dépenses récentes</div>
          <div style="display:flex;gap:8px;align-items:center;">
            <select style="background:var(--noir3);border:1px solid #222;color:var(--text2);font-family:system-ui;font-size:0.68rem;padding:4px 8px;border-radius:5px;outline:none;cursor:pointer;">
              <option>Tous les mois</option>
              <option selected>Février 2026</option>
              <option>Janvier 2026</option>
            </select>
            <button class="btn btn-ghost" style="padding:4px 8px;font-size:0.7rem;">Tout voir →</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Description</th>
              <th>Catégorie</th>
              <th>Payeur</th>
              <th>Montant</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span style="color:var(--text);font-size:0.78rem;">Courses Carrefour</span><br><span style="font-size:0.62rem;opacity:0.4;">20 fév. 2026</span></td>
              <td><span class="tag tg-green">Alimentation</span></td>
              <td><div style="display:flex;align-items:center;gap:6px;"><div class="mini-av" style="background:linear-gradient(135deg,#c9a84c,#7a5c1a);color:#0a0a0a;">JD</div> Jean</div></td>
              <td><span class="pos">120€</span></td>
              <td><button class="btn btn-ghost" style="padding:2px 7px;font-size:0.65rem;">⋯</button></td>
            </tr>
            <tr>
              <td><span style="color:var(--text);font-size:0.78rem;">EDF Électricité</span><br><span style="font-size:0.62rem;opacity:0.4;">18 fév. 2026</span></td>
              <td><span class="tag tg-blue">Énergie</span></td>
              <td><div style="display:flex;align-items:center;gap:6px;"><div class="mini-av av-b">ML</div> Marie</div></td>
              <td><span style="color:var(--text);font-weight:700;">89€</span></td>
              <td><button class="btn btn-ghost" style="padding:2px 7px;font-size:0.65rem;">⋯</button></td>
            </tr>
            <tr>
              <td><span style="color:var(--text);font-size:0.78rem;">Netflix</span><br><span style="font-size:0.62rem;opacity:0.4;">15 fév. 2026</span></td>
              <td><span class="tag tg-gray">Loisirs</span></td>
              <td><div style="display:flex;align-items:center;gap:6px;"><div class="mini-av av-c">AR</div> Alex</div></td>
              <td><span style="color:var(--text);font-weight:700;">17€</span></td>
              <td><button class="btn btn-ghost" style="padding:2px 7px;font-size:0.65rem;">⋯</button></td>
            </tr>
            <tr>
              <td><span style="color:var(--text);font-size:0.78rem;">Loyer Février</span><br><span style="font-size:0.62rem;opacity:0.4;">01 fév. 2026</span></td>
              <td><span class="tag tg-gold">Loyer</span></td>
              <td><div style="display:flex;align-items:center;gap:6px;"><div class="mini-av" style="background:linear-gradient(135deg,#c9a84c,#7a5c1a);color:#0a0a0a;">JD</div> Jean</div></td>
              <td><span class="pos">2 400€</span></td>
              <td><button class="btn btn-ghost" style="padding:2px 7px;font-size:0.65rem;">⋯</button></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Remboursements -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">Qui doit à qui ?</div>
          <span class="tag tg-red">3 en attente</span>
        </div>
        <div class="card-body">
          <div class="debt-row">
            <div class="avatar av-b" style="width:30px;height:30px;font-size:0.6rem;border-radius:7px;flex-shrink:0;">ML</div>
            <div class="debt-info">
              <div class="debt-names">Marie <span>doit à</span> Jean</div>
              <div class="debt-sub">Loyer + Courses</div>
            </div>
            <div class="debt-right">
              <div class="debt-amt neg">−74€</div>
              <button class="btn btn-gold" style="padding:3px 9px;font-size:0.62rem;margin-top:4px;">✓ Payé</button>
            </div>
          </div>
          <div class="debt-row">
            <div class="avatar av-c" style="width:30px;height:30px;font-size:0.6rem;border-radius:7px;flex-shrink:0;">AR</div>
            <div class="debt-info">
              <div class="debt-names">Alex <span>doit à</span> Jean</div>
              <div class="debt-sub">EDF + Courses</div>
            </div>
            <div class="debt-right">
              <div class="debt-amt neg">−52€</div>
              <button class="btn btn-gold" style="padding:3px 9px;font-size:0.62rem;margin-top:4px;">✓ Payé</button>
            </div>
          </div>
          <div class="debt-row">
            <div class="avatar av-d" style="width:30px;height:30px;font-size:0.6rem;border-radius:7px;flex-shrink:0;">TR</div>
            <div class="debt-info">
              <div class="debt-names">Tom <span>doit à</span> Marie</div>
              <div class="debt-sub">Netflix</div>
            </div>
            <div class="debt-right">
              <div class="debt-amt neg">−59€</div>
              <button class="btn btn-gold" style="padding:3px 9px;font-size:0.62rem;margin-top:4px;">✓ Payé</button>
            </div>
          </div>

          <hr class="hr">

          <div style="font-size:0.6rem;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:10px;">Ma balance globale</div>
          <div style="background:rgba(82,201,122,0.05);border:1px solid rgba(82,201,122,0.14);border-radius:8px;padding:11px 14px;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:0.74rem;color:var(--text2);">Vous avez payé plus que votre part</span>
            <span class="pos" style="font-size:1rem;">+185€</span>
          </div>
          <div class="progress"><div class="progress-fill" style="width:72%;"></div></div>
          <div style="font-size:0.6rem;color:var(--muted);margin-top:5px;text-align:right;">72% des dettes régularisées ce mois</div>
        </div>
      </div>
    </div>


      <!-- Activité récente -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">Activité récente</div>
          <button class="btn btn-ghost" style="font-size:0.7rem;padding:4px 8px;">Voir tout →</button>
        </div>
        <div class="card-body">
          <div class="activity-row">
            <div class="act-icon act-gold">💸</div>
            <div class="act-text">
              <strong>Jean</strong> a ajouté une dépense <strong>Courses Carrefour</strong>
              <div class="act-time">Il y a 2 heures</div>
            </div>
            <div class="act-amount pos">+120€</div>
          </div>
          <div class="activity-row">
            <div class="act-icon act-green">✓</div>
            <div class="act-text">
              <strong>Marie</strong> a marqué un paiement comme effectué
              <div class="act-time">Il y a 5 heures</div>
            </div>
            <div class="act-amount pos">+30€</div>
          </div>
          <div class="activity-row">
            <div class="act-icon act-gold">💸</div>
            <div class="act-text">
              <strong>Marie</strong> a ajouté une dépense <strong>EDF Électricité</strong>
              <div class="act-time">Hier, 18h14</div>
            </div>
            <div class="act-amount" style="color:var(--text);font-weight:700;">+89€</div>
          </div>
          <div class="activity-row">
            <div class="act-icon act-gold">✦</div>
            <div class="act-text">
              <strong>Jean</strong> a invité <strong>tom.renard@email.com</strong>
              <div class="act-time">Il y a 3 jours</div>
            </div>
          </div>
          <div class="activity-row">
            <div class="act-icon act-green">◎</div>
            <div class="act-text">
              <strong>Tom Renard</strong> a rejoint la colocation
              <div class="act-time">Il y a 3 jours</div>
            </div>
          </div>
        </div>
      </div>

  <div class="card a4">
      <div class="card-header">
        <div class="card-title">Membres de la colocation</div>
        <button class="btn btn-outline" onclick="document.getElementById('modal-invite').style.display='flex'">+ Inviter un membre</button>
      </div>
      <div class="card-body" style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;">
        <div class="member-chip">
          <div class="avatar">JD</div>
          <div>
            <div class="member-name">Jean Dupont</div>
            <div style="margin-top:2px;"><span class="tag tag-gold">Owner</span></div>
            <div class="member-rep">★★★★☆ 4/5</div>
          </div>
        </div>
        <div class="member-chip">
          <div class="avatar b">ML</div>
          <div>
            <div class="member-name">Marie Lefèvre</div>
            <div style="margin-top:2px;"><span class="tag tag-gray">Member</span></div>
            <div class="member-rep">★★★☆☆ 3/5</div>
          </div>
        </div>
        <div class="member-chip">
          <div class="avatar c">AR</div>
          <div>
            <div class="member-name">Alex Robin</div>
            <div style="margin-top:2px;"><span class="tag tag-gray">Member</span></div>
            <div class="member-rep">★★★★★ 5/5</div>
          </div>
        </div>
        <div class="member-chip">
          <div class="avatar d">TR</div>
          <div>
            <div class="member-name">Tom Renard</div>
            <div style="margin-top:2px;"><span class="tag tag-gray">Member</span></div>
            <div class="member-rep low">★★☆☆☆ 2/5</div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<!-- MODAL Dépense -->
<div id="m-dep" class="modal-overlay" style="display:none;" onclick="if(event.target===this)this.style.display='none'">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Nouvelle dépense</div>
      <button class="btn btn-ghost" style="padding:4px 8px;" onclick="document.getElementById('m-dep').style.display='none'">✕</button>
    </div>
    <div class="modal-body">
      <div><label class="form-label-m">Titre <span style="color:var(--gold);">*</span></label><input class="form-input-m" type="text" placeholder="Ex: Courses Carrefour"></div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div><label class="form-label-m">Montant (€) <span style="color:var(--gold);">*</span></label><input class="form-input-m" type="number" placeholder="0.00"></div>
        <div><label class="form-label-m">Date <span style="color:var(--gold);">*</span></label><input class="form-input-m" type="date"></div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div><label class="form-label-m">Catégorie</label>
          <select class="form-input-m"><option>Alimentation</option><option>Loyer</option><option>Énergie</option><option>Loisirs</option><option>Transport</option><option>Autre</option></select>
        </div>
        <div><label class="form-label-m">Payeur</label>
          <select class="form-input-m"><option>Jean Dupont (moi)</option><option>Marie Lefèvre</option><option>Alex Robin</option><option>Tom Renard</option></select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('m-dep').style.display='none'">Annuler</button>
      <button class="btn btn-gold">Ajouter</button>
    </div>
  </div>
</div>

<!-- MODAL Invitation -->
<div id="m-invite" class="modal-overlay" style="display:none;" onclick="if(event.target===this)this.style.display='none'">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Inviter un membre</div>
      <button class="btn btn-ghost" style="padding:4px 8px;" onclick="document.getElementById('m-invite').style.display='none'">✕</button>
    </div>
    <div class="modal-body">
      <div><label class="form-label-m">Adresse email</label><input class="form-input-m" type="email" placeholder="exemple@email.com"></div>
      <div style="background:var(--gold-dim);border:1px solid var(--gold-border);border-radius:8px;padding:13px;">
        <div style="font-size:0.66rem;color:var(--gold);margin-bottom:5px;font-weight:600;">Lien d'invitation</div>
        <div style="font-size:0.64rem;color:var(--muted);word-break:break-all;line-height:1.5;">https://coloc.app/invite/eyJhbGciOiJIUzI1...</div>
        <button class="btn btn-outline" style="margin-top:9px;font-size:0.62rem;padding:4px 10px;">Copier</button>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('m-invite').style.display='none'">Annuler</button>
      <button class="btn btn-gold">Envoyer</button>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.nav-item').forEach(t => {
    t.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelectorAll('.nav-item').forEach(x => x.classList.remove('active'));
      this.classList.add('active');
    });
  });

  document.querySelectorAll('.qa-card').forEach(c => {
    c.addEventListener('mousedown', function() { this.style.transform = 'scale(0.97)'; });
    c.addEventListener('mouseup',   function() { this.style.transform = ''; });
  });
</script>
</body>
</html>