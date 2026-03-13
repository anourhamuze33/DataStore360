<style>
.navbar {
  background: #111111;
  border-bottom: 1px solid #1e1e1e;
  padding: 0 32px;
  height: 54px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 200;
}

.nav-logo {
  display: flex;
  align-items: center;
  gap: 9px;
  font-size: 1.1rem;
  font-weight: 800;
  letter-spacing: -0.03em;
  color: #c9a84c;
  text-decoration: none;
}

.nav-logo-icon {
  background: #c9a84c;
  color: #0a0a0a;
  width: 26px;
  height: 26px;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: 800;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 6px;
}

.nav-link {
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 0.8rem;
  color: #a0a0a0;
  text-decoration: none;
  transition: all 0.13s;
}

.nav-link:hover {
  color: #e8e8e8;
  background: rgba(255, 255, 255, 0.04);
}

.nav-link.active {
  color: #c9a84c;
  background: rgba(201, 168, 76, 0.07);
}

.nav-btn-back {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 0.8rem;
  color: #a0a0a0;
  background: transparent;
  border: 1px solid #2a2a2a;
  cursor: pointer;
  transition: all 0.13s;
  text-decoration: none;
}

.nav-btn-back:hover {
  border-color: #444;
  color: #e8e8e8;
}

.nav-btn-primary {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 6px 16px;
  border-radius: 6px;
  font-size: 0.8rem;
  font-weight: 600;
  color: #0a0a0a;
  background: #c9a84c;
  border: none;
  cursor: pointer;
  transition: all 0.13s;
  text-decoration: none;
}

.nav-btn-primary:hover {
  background: #e8c97a;
}
</style>
  <nav class="navbar">
    <a class="nav-logo" href="#">
      <div class="nav-logo-icon">C</div>
      CoLoc
    </a>
    <div class="nav-links">
      <a class="nav-link" href="#">Accueil</a>
      <a class="nav-link active" href="#">Inscription</a>
      <a class="nav-link" href="#">Connexion</a>
    </div>
    <div style="display:flex;gap:8px;">
      <a class="nav-btn-back" href="#">← Retour</a>
      <a class="nav-btn-primary" href="#">Se connecter</a>
    </div>
  </nav>
