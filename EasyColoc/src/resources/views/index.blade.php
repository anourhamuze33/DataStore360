<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CoLoc — Gérez votre colocation simplement</title>
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
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
      background: var(--noir);
      color: var(--text);
      font-family: system-ui, -apple-system, sans-serif;
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* ── NAVBAR ── */
    .navbar {
      background: rgba(10,10,10,0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid #1a1a1a;
      padding: 0 48px;
      height: 60px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 200;
    }

    .nav-logo {
      display: flex; align-items: center; gap: 10px;
      font-size: 1.2rem; font-weight: 800;
      letter-spacing: -0.03em; color: var(--gold);
      text-decoration: none;
    }
    .nav-logo-icon {
      background: var(--gold); color: var(--noir);
      width: 30px; height: 30px; border-radius: 7px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.88rem; font-weight: 800;
    }

    .nav-links {
      display: flex; align-items: center; gap: 4px;
    }
    .nav-link {
      padding: 7px 16px; border-radius: 7px;
      font-size: 0.85rem; color: var(--text2);
      text-decoration: none; transition: all 0.13s;
    }
    .nav-link:hover { color: var(--text); background: rgba(255,255,255,0.04); }

    .nav-actions { display: flex; gap: 8px; }

    .btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 8px 20px; border-radius: 8px;
      font-family: system-ui, sans-serif; font-size: 0.85rem;
      cursor: pointer; transition: all 0.15s;
      text-decoration: none; border: none; outline: none; font-weight: 600;
    }
    .btn-outline {
      background: transparent; color: var(--text2);
      border: 1px solid #2a2a2a;
    }
    .btn-outline:hover { border-color: #444; color: var(--text); }
    .btn-gold {
      background: var(--gold); color: var(--noir);
    }
    .btn-gold:hover { background: var(--gold2); transform: translateY(-1px); box-shadow: 0 6px 22px rgba(201,168,76,0.22); }
    .btn-lg { padding: 13px 30px; font-size: 0.95rem; border-radius: 10px; }
    .btn-ghost { background: transparent; color: var(--text2); border: 1px solid #252525; }
    .btn-ghost:hover { border-color: #3a3a3a; color: var(--text); }

    /* ── HERO ── */
    .hero {
      position: relative;
      padding: 100px 48px 90px;
      text-align: center;
      overflow: hidden;
    }

    /* glow bg */
    .hero::before {
      content: '';
      position: absolute;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(201,168,76,0.07) 0%, transparent 65%);
      top: -100px; left: 50%; transform: translateX(-50%);
      pointer-events: none;
    }

    .hero-badge {
      display: inline-flex; align-items: center; gap: 7px;
      background: var(--gold-dim); border: 1px solid var(--gold-border);
      color: var(--gold); padding: 5px 14px; border-radius: 20px;
      font-size: 0.75rem; font-weight: 600; margin-bottom: 28px;
      letter-spacing: 0.03em;
    }
    .hero-badge-dot { width: 6px; height: 6px; background: var(--gold); border-radius: 50%; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

    .hero-title {
      font-size: clamp(2.4rem, 5vw, 3.8rem);
      font-weight: 800; letter-spacing: -0.04em;
      line-height: 1.1; margin-bottom: 22px;
      max-width: 800px; margin-left: auto; margin-right: auto;
    }
    .hero-title .highlight { color: var(--gold); }

    .hero-sub {
      font-size: 1.05rem; color: var(--text2);
      max-width: 540px; margin: 0 auto 40px;
      line-height: 1.7;
    }

    .hero-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-bottom: 60px; }

    /* mock dashboard preview */
    .hero-preview {
      max-width: 880px; margin: 0 auto;
      background: var(--noir2);
      border: 1px solid #1e1e1e;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 40px 80px rgba(0,0,0,0.5);
    }

    .preview-bar {
      background: var(--noir3);
      border-bottom: 1px solid #1e1e1e;
      padding: 10px 18px;
      display: flex; align-items: center; gap: 6px;
    }
    .dot { width: 10px; height: 10px; border-radius: 50%; }
    .dot.r { background: #e05252; }
    .dot.y { background: #f59e0b; }
    .dot.g { background: #52c97a; }
    .preview-url {
      margin-left: 12px; flex: 1;
      background: var(--noir2); border: 1px solid #222;
      border-radius: 5px; padding: 3px 12px;
      font-size: 0.7rem; color: var(--muted);
      max-width: 300px;
    }

    .preview-body {
      display: grid; grid-template-columns: 180px 1fr;
      height: 320px;
    }

    .preview-sidebar {
      background: var(--noir2);
      border-right: 1px solid #1a1a1a;
      padding: 16px 0;
    }
    .ps-logo {
      padding: 0 16px 14px;
      font-size: 0.9rem; font-weight: 800; color: var(--gold);
      border-bottom: 1px solid #1a1a1a; margin-bottom: 10px;
      display: flex; align-items: center; gap: 7px;
    }
    .ps-li {
      padding: 7px 16px; font-size: 0.7rem; color: var(--text2);
      display: flex; align-items: center; gap: 7px;
      border-left: 2px solid transparent;
    }
    .ps-li.a { color: var(--gold); background: var(--gold-dim); border-left-color: var(--gold); }

    .preview-main { padding: 18px; background: var(--noir); overflow: hidden; }

    .pm-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 8px; margin-bottom: 12px; }
    .pm-stat {
      background: var(--noir2); border: 1px solid #1a1a1a;
      border-radius: 7px; padding: 10px 12px;
      border-top: 2px solid var(--gold);
    }
    .pm-stat-label { font-size: 0.55rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px; }
    .pm-stat-val { font-size: 1.1rem; font-weight: 800; color: var(--text); }
    .pm-stat-val.g { color: var(--green); }

    .pm-row { display: grid; grid-template-columns: 1.4fr 1fr; gap: 8px; }

    .pm-card { background: var(--noir2); border: 1px solid #1a1a1a; border-radius: 7px; padding: 10px 12px; }
    .pm-card-title { font-size: 0.6rem; font-weight: 600; color: var(--text2); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.06em; }
    .pm-line {
      display: flex; align-items: center; justify-content: space-between;
      padding: 4px 0; border-bottom: 1px solid #111;
      font-size: 0.62rem; color: var(--text2);
    }
    .pm-line:last-child { border-bottom: none; }
    .pm-line .amt { font-weight: 700; color: var(--text); }
    .pm-line .neg { color: var(--red); font-weight: 700; }
    .pm-line .pos { color: var(--green); font-weight: 700; }

    .pm-tag { display: inline-block; padding: 1px 5px; border-radius: 3px; font-size: 0.55rem; background: var(--gold-dim); color: var(--gold); }

    /* ── STATS BAND ── */
    .stats-band {
      border-top: 1px solid #1a1a1a;
      border-bottom: 1px solid #1a1a1a;
      padding: 40px 48px;
      display: grid; grid-template-columns: repeat(4,1fr);
      text-align: center; gap: 20px;
    }
    .stat-num { font-size: 2.2rem; font-weight: 800; letter-spacing: -0.04em; color: var(--gold); }
    .stat-desc { font-size: 0.82rem; color: var(--muted); margin-top: 4px; }

    /* ── FEATURES ── */
    .section { padding: 90px 48px; }
    .section-label {
      font-size: 0.68rem; letter-spacing: 0.14em; text-transform: uppercase;
      color: var(--gold); margin-bottom: 12px; text-align: center;
    }
    .section-title {
      font-size: clamp(1.7rem, 3vw, 2.4rem); font-weight: 800;
      letter-spacing: -0.03em; text-align: center;
      margin-bottom: 14px;
    }
    .section-sub {
      font-size: 0.92rem; color: var(--text2);
      text-align: center; max-width: 520px;
      margin: 0 auto 56px; line-height: 1.7;
    }

    .features-grid {
      display: grid; grid-template-columns: repeat(3,1fr);
      gap: 18px; max-width: 1100px; margin: 0 auto;
    }

    .feature-card {
      background: var(--noir2); border: 1px solid #1a1a1a;
      border-radius: 12px; padding: 28px 26px;
      transition: border-color 0.2s, transform 0.2s;
      position: relative; overflow: hidden;
    }
    .feature-card:hover { border-color: var(--gold-border); transform: translateY(-3px); }
    .feature-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: var(--gold); opacity: 0;
      transition: opacity 0.2s;
    }
    .feature-card:hover::before { opacity: 1; }

    .feature-icon-wrap {
      width: 48px; height: 48px; border-radius: 11px;
      background: var(--gold-dim); border: 1px solid var(--gold-border);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem; margin-bottom: 18px;
    }
    .feature-title { font-size: 1rem; font-weight: 700; margin-bottom: 8px; }
    .feature-desc { font-size: 0.82rem; color: var(--text2); line-height: 1.65; }

    .feature-tag {
      display: inline-block; margin-top: 14px;
      padding: 3px 9px; border-radius: 5px;
      font-size: 0.65rem; font-weight: 600;
      background: var(--gold-dim); color: var(--gold);
      border: 1px solid var(--gold-border);
    }
    .feature-tag.green { background: rgba(82,201,122,0.08); color: var(--green); border-color: rgba(82,201,122,0.2); }

    /* ── HOW IT WORKS ── */
    .how-section { padding: 90px 48px; background: var(--noir2); border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; }

    .steps { display: grid; grid-template-columns: repeat(4,1fr); gap: 0; max-width: 1000px; margin: 0 auto; position: relative; }
    .steps::before {
      content: '';
      position: absolute; top: 28px; left: 12%; right: 12%;
      height: 1px; background: linear-gradient(to right, transparent, var(--gold-border), transparent);
    }

    .step { text-align: center; padding: 0 16px; }
    .step-num {
      width: 56px; height: 56px; border-radius: 50%;
      background: var(--noir); border: 1px solid var(--gold-border);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.1rem; font-weight: 800; color: var(--gold);
      margin: 0 auto 18px; position: relative; z-index: 1;
    }
    .step-title { font-size: 0.92rem; font-weight: 700; margin-bottom: 8px; }
    .step-desc { font-size: 0.78rem; color: var(--text2); line-height: 1.6; }

    /* ── ROLES ── */
    .roles-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; max-width: 900px; margin: 0 auto; }

    .role-card {
      background: var(--noir2); border: 1px solid #1a1a1a;
      border-radius: 12px; padding: 26px 24px;
    }
    .role-header { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
    .role-avatar {
      width: 42px; height: 42px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem;
    }
    .ra-gold { background: linear-gradient(135deg, #c9a84c, #7a5c1a); }
    .ra-blue { background: linear-gradient(135deg, #5b8af5, #2a4fa0); }
    .ra-purple { background: linear-gradient(135deg, #a855f7, #7c3aed); }

    .role-name { font-size: 0.95rem; font-weight: 700; }
    .role-badge { font-size: 0.62rem; color: var(--muted); margin-top: 2px; }

    .role-perms { list-style: none; display: flex; flex-direction: column; gap: 8px; }
    .role-perm {
      display: flex; align-items: flex-start; gap: 8px;
      font-size: 0.78rem; color: var(--text2);
    }
    .perm-check { color: var(--gold); font-size: 0.72rem; margin-top: 2px; flex-shrink: 0; }

    /* ── CTA ── */
    .cta-section {
      padding: 100px 48px; text-align: center;
      position: relative; overflow: hidden;
    }
    .cta-section::before {
      content: '';
      position: absolute; width: 700px; height: 700px;
      background: radial-gradient(circle, rgba(201,168,76,0.05) 0%, transparent 65%);
      top: 50%; left: 50%; transform: translate(-50%,-50%);
      pointer-events: none;
    }
    .cta-title { font-size: clamp(1.8rem, 3.5vw, 2.8rem); font-weight: 800; letter-spacing: -0.03em; margin-bottom: 16px; }
    .cta-sub { font-size: 0.95rem; color: var(--text2); margin-bottom: 36px; max-width: 460px; margin-left: auto; margin-right: auto; }
    .cta-note { font-size: 0.72rem; color: var(--muted); margin-top: 16px; }

    /* ── FOOTER ── */
    .footer {
      background: var(--noir2); border-top: 1px solid #1a1a1a;
      padding: 40px 48px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .footer-logo { font-size: 1rem; font-weight: 800; color: var(--gold); display: flex; align-items: center; gap: 8px; }
    .footer-logo-icon { background: var(--gold); color: var(--noir); width: 24px; height: 24px; border-radius: 5px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; }
    .footer-links { display: flex; gap: 24px; }
    .footer-link { font-size: 0.78rem; color: var(--muted); text-decoration: none; transition: color 0.13s; }
    .footer-link:hover { color: var(--text2); }
    .footer-copy { font-size: 0.72rem; color: var(--muted); }

    /* scrollbar */
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: var(--noir); }
    ::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 2px; }

    /* animations */
    @keyframes fadeUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
    .hero-badge { animation: fadeUp 0.4s 0.05s both; }
    .hero-title  { animation: fadeUp 0.4s 0.12s both; }
    .hero-sub    { animation: fadeUp 0.4s 0.18s both; }
    .hero-actions{ animation: fadeUp 0.4s 0.24s both; }
    .hero-preview{ animation: fadeUp 0.5s 0.32s both; }
  </style>
</head>
<body>

<!-- ══════════ NAVBAR ══════════ -->
<nav class="navbar">
  <a class="nav-logo" href="#">
    <div class="nav-logo-icon">C</div>
    CoLoc
  </a>
  <div class="nav-links">
    <a class="nav-link" href="#features">Fonctionnalités</a>
    <a class="nav-link" href="#how">Comment ça marche</a>
    <a class="nav-link" href="#roles">Rôles</a>
  </div>
  <div class="nav-actions">
    <a class="btn btn-outline" href="{{route('user.viewLogin')}}">Se connecter</a>
    <a class="btn btn-gold" href="{{route('user.viewInscription')}}">Commencer gratuitement</a>
  </div>
</nav>

<!-- ══════════ HERO ══════════ -->
<section class="hero">
  <div class="hero-badge">
    <span class="hero-badge-dot"></span>
    Gestion de colocation simplifiée
  </div>

  <h1 class="hero-title">
    Finies les disputes<br>d'argent en <span class="highlight">colocation</span>
  </h1>

  <p class="hero-sub">
    CoLoc centralise vos dépenses communes, calcule automatiquement les soldes et simplifie les remboursements entre colocataires.
  </p>

  <div class="hero-actions">
    <a class="btn btn-gold btn-lg" href="{{route('user.viewInscription')}}">Créer mon compte</a>
    <a class="btn btn-ghost btn-lg" href="#features">Voir les fonctionnalités</a>
  </div>

  <!-- Mock preview -->
  <div class="hero-preview">
    <div class="preview-bar">
      <div class="dot r"></div>
      <div class="dot y"></div>
      <div class="dot g"></div>
      <div class="preview-url">coloc.app/dashboard</div>
    </div>
    <div class="preview-body">
      <div class="preview-sidebar">
        <div class="ps-logo">
          <div style="background:var(--gold);color:var(--noir);width:18px;height:18px;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:0.6rem;font-weight:800;">C</div>
          CoLoc
        </div>
        <div class="ps-li a">⬡ Dashboard</div>
        <div class="ps-li">⌂ Colocation</div>
        <div class="ps-li">◈ Dépenses</div>
        <div class="ps-li">⇋ Balances</div>
        <div class="ps-li">◎ Membres</div>
        <div style="border-top:1px solid #1a1a1a;margin:10px 0;"></div>
        <div class="ps-li">◻ Catégories</div>
        <div class="ps-li">✦ Invitations</div>
      </div>
      <div class="preview-main">
        <div class="pm-stats">
          <div class="pm-stat">
            <div class="pm-stat-label">Total dépenses</div>
            <div class="pm-stat-val">3 240€</div>
          </div>
          <div class="pm-stat">
            <div class="pm-stat-label">Mon solde</div>
            <div class="pm-stat-val g">+185€</div>
          </div>
          <div class="pm-stat">
            <div class="pm-stat-label">Réputation</div>
            <div class="pm-stat-val" style="color:var(--gold);font-size:0.9rem;">★★★★☆</div>
          </div>
        </div>
        <div class="pm-row">
          <div class="pm-card">
            <div class="pm-card-title">Dépenses récentes</div>
            <div class="pm-line"><span>Courses Carrefour <span class="pm-tag">Alimentation</span></span><span class="amt">120€</span></div>
            <div class="pm-line"><span>EDF Électricité</span><span class="amt">89€</span></div>
            <div class="pm-line"><span>Netflix</span><span class="amt">17€</span></div>
            <div class="pm-line"><span>Loyer Février</span><span class="pos">2 400€</span></div>
          </div>
          <div class="pm-card">
            <div class="pm-card-title">Remboursements</div>
            <div class="pm-line"><span>Marie → Jean</span><span class="neg">−74€</span></div>
            <div class="pm-line"><span>Alex → Jean</span><span class="neg">−52€</span></div>
            <div class="pm-line"><span>Tom → Marie</span><span class="neg">−59€</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ STATS ══════════ -->
<div class="stats-band">
  <div>
    <div class="stat-num">100%</div>
    <div class="stat-desc">Calcul automatique des soldes</div>
  </div>
  <div>
    <div class="stat-num">0€</div>
    <div class="stat-desc">Gratuit, sans frais cachés</div>
  </div>
  <div>
    <div class="stat-num">3 rôles</div>
    <div class="stat-desc">Member, Owner, Admin</div>
  </div>
  <div>
    <div class="stat-num">∞</div>
    <div class="stat-desc">Dépenses et membres gérables</div>
  </div>
</div>

<!-- ══════════ FEATURES ══════════ -->
<section class="section" id="features">
  <div class="section-label">Fonctionnalités</div>
  <h2 class="section-title">Tout ce qu'il vous faut</h2>
  <p class="section-sub">Une plateforme complète pour gérer votre colocation sans prise de tête.</p>

  <div class="features-grid">

    <div class="feature-card">
      <div class="feature-icon-wrap">D</div>
      <div class="feature-title">Gestion des dépenses</div>
      <div class="feature-desc">Ajoutez vos dépenses avec titre, montant, date, catégorie et payeur. Historique complet avec filtrage par mois.</div>
      <span class="feature-tag">Catégories personnalisées</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">⇋</div>
      <div class="feature-title">Calcul automatique</div>
      <div class="feature-desc">Les soldes de chaque membre sont recalculés en temps réel à chaque dépense. Zéro calcul manuel.</div>
      <span class="feature-tag green">Temps réel</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">✦</div>
      <div class="feature-title">Invitations par lien</div>
      <div class="feature-desc">Invitez vos colocataires par emai. Ils acceptent ou refusent depuis l'interface.</div>
      <span class="feature-tag">sécurisé</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">👁</div>
      <div class="feature-title">Vue les remboursements</div>
      <div class="feature-desc">Un aperçu synthétique et clair des remboursements simplifiés entre tous les membres de la colocation.</div>
      <span class="feature-tag green">Vue simplifiée</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">★</div>
      <div class="feature-title">Système de réputation</div>
      <div class="feature-desc">Chaque membre accumule un score de confiance selon son comportement financier. +1 sans dette, −1 avec dette.</div>
      <span class="feature-tag">Score de confiance</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">⬡</div>
      <div class="feature-title">Administration globale</div>
      <div class="feature-desc">L'admin accède aux statistiques globales et peut bannir des utilisateurs problématiques.</div>
      <span class="feature-tag">Rôle admin</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">✓</div>
      <div class="feature-title">Marquer comme payé</div>
      <div class="feature-desc">Enregistrez les paiements en un clic depuis la liste des remboursements. Les soldes se mettent à jour automatiquement.</div>
      <span class="feature-tag green">Simple et rapide</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">C</div>
      <div class="feature-title">Gestion de la colocation</div>
      <div class="feature-desc">Créez une colocation, gérez les membres, retirez un colocataire ou annulez la colocation en toute simplicité.</div>
      <span class="feature-tag">Owner & Member</span>
    </div>

    <div class="feature-card">
      <div class="feature-icon-wrap">S</div>
      <div class="feature-title">Sécurité </div>
      <div class="feature-desc">Authentification sécurisée, protection CSRF, validation serveur et blocage automatique des utilisateurs bannis.</div>
      <span class="feature-tag">Données privées</span>
    </div>

  </div>
</section>

<!-- ══════════ HOW IT WORKS ══════════ -->
<section class="how-section" id="how">
  <div class="section-label">Comment ça marche</div>
  <h2 class="section-title">En 4 étapes simples</h2>
  <p class="section-sub" style="margin-bottom:52px;">Démarrez en quelques minutes et gérez votre colocation efficacement.</p>

  <div class="steps">
    <div class="step">
      <div class="step-num">1</div>
      <div class="step-title">Créez un compte</div>
      <div class="step-desc">Inscrivez-vous gratuitement. Le premier inscrit devient automatiquement admin global.</div>
    </div>
    <div class="step">
      <div class="step-num">2</div>
      <div class="step-title">Créez votre colocation</div>
      <div class="step-desc">Donnez un nom à votre colocation et devenez automatiquement son Owner.</div>
    </div>
    <div class="step">
      <div class="step-num">3</div>
      <div class="step-title">Invitez vos colocs</div>
      <div class="step-desc">Envoyez des invitations par email. Vos colocataires acceptent en un clic.</div>
    </div>
    <div class="step">
      <div class="step-num">4</div>
      <div class="step-title">Gérez les dépenses</div>
      <div class="step-desc">Ajoutez vos dépenses et laissez CoLoc calculer automatiquement qui doit quoi à qui.</div>
    </div>
  </div>
</section>

<!-- ══════════ ROLES ══════════ -->
<section class="section" id="roles">
  <div class="section-label">Rôles & Permissions</div>
  <h2 class="section-title">Un rôle pour chacun</h2>
  <p class="section-sub">Trois niveaux d'accès clairement définis pour une gestion équitable.</p>

  <div class="roles-grid">

    <div class="role-card">
      <div class="role-header">
        <div class="role-avatar ra-blue" style="font-size:1.2rem;display:flex;align-items:center;justify-content:center;">M</div>
        <div>
          <div class="role-name">Member</div>
          <div class="role-badge">Membre standard</div>
        </div>
      </div>
      <ul class="role-perms">
        <li class="role-perm"><span class="perm-check">✓</span> S'inscrire et se connecter</li>
        <li class="role-perm"><span class="perm-check">✓</span> Rejoindre une colocation via invitation</li>
        <li class="role-perm"><span class="perm-check">✓</span> Ajouter et voir les dépenses</li>
        <li class="role-perm"><span class="perm-check">✓</span> Voir son solde et les remboursements</li>
        <li class="role-perm"><span class="perm-check">✓</span> Marquer un paiement</li>
        <li class="role-perm"><span class="perm-check">✓</span> créer une catégorie</li>
        <li class="role-perm"><span class="perm-check">✓</span> Quitter la colocation</li>
      </ul>
    </div>

    <div class="role-card" style="border-color:var(--gold-border);">
      <div class="role-header">
        <div class="role-avatar ra-gold" style="font-size:1.2rem;display:flex;align-items:center;justify-content:center;">O</div>
        <div>
          <div class="role-name">Owner</div>
          <div class="role-badge" style="color:var(--gold);">Administrateur de colocation</div>
        </div>
      </div>
      <ul class="role-perms">
        <li class="role-perm"><span class="perm-check">✓</span> Tout ce qu'un Member peut faire</li>
        <li class="role-perm"><span class="perm-check">✓</span> Créer et gérer sa colocation</li>
        <li class="role-perm"><span class="perm-check">✓</span> Inviter des membres par email/lien</li>
        <li class="role-perm"><span class="perm-check">✓</span> Retirer un membre (avec règle de dette)</li>
        <li class="role-perm"><span class="perm-check">✓</span> Gérer les catégories de dépenses</li>
        <li class="role-perm"><span class="perm-check">✓</span> Annuler la colocation</li>
      </ul>
    </div>

    <div class="role-card">
      <div class="role-header">
        <div class="role-avatar ra-purple" style="font-size:1.2rem;display:flex;align-items:center;justify-content:center;">A</div>
        <div>
          <div class="role-name">Global Admin</div>
          <div class="role-badge">Administrateur plateforme</div>
        </div>
      </div>
      <ul class="role-perms">
        <li class="role-perm"><span class="perm-check">✓</span> Accès aux statistiques globales</li>
        <li class="role-perm"><span class="perm-check">✓</span> Voir tous les utilisateurs</li>
        <li class="role-perm"><span class="perm-check">✓</span> Bannir / débannir des utilisateurs</li>
        <li class="role-perm"><span class="perm-check">✓</span> Automatiquement le 1er inscrit</li>
        <li class="role-perm"><span class="perm-check">✓</span> Peut aussi être Owner ou Member</li>
      </ul>
    </div>

  </div>
</section>

<!-- ══════════ CTA ══════════ -->
<section class="cta-section">
  <h2 class="cta-title">Prêt à simplifier votre<br><span style="color:var(--gold);">vie en colocation ?</span></h2>
  <p class="cta-sub">Rejoignez CoLoc dès aujourd'hui. Gratuit, simple et efficace.</p>
  <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
    <a class="btn btn-gold btn-lg" href="{{route('user.viewInscription')}}">Créer mon compte gratuitement</a>
    <a class="btn btn-ghost btn-lg" href="{{route('user.viewLogin')}}">Se connecter</a>
  </div>
  <div class="cta-note">Aucune carte bancaire requise · Aucun abonnement</div>
</section>

<!-- ══════════ FOOTER ══════════ -->
<footer class="footer">
  <div class="footer-logo">
    <div class="footer-logo-icon">C</div>
    CoLoc
  </div>
  <div class="footer-links">
    <a class="footer-link" href="#">Fonctionnalités</a>
    <a class="footer-link" href="#">Comment ça marche</a>
    <a class="footer-link" href="#">Rôles</a>
    <a class="footer-link" href="{{route('user.viewLogin')}}">Connexion</a>
    <a class="footer-link" href="{{route('user.viewInscription')}}">Inscription</a>
  </div>
  <div class="footer-copy">© 2026 CoLoc · Tous droits réservés</div>
</footer>

</body>
</html>