<div class="topbar">
  <div class="topbar-left">
    <button class="mobile-menu-button" aria-label="Toggle menu" id="btnToggleSidebar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12" />
        <line x1="3" y1="6" x2="21" y2="6" />
        <line x1="3" y1="18" x2="21" y2="18" />
      </svg>
    </button>
    <div class="app-name">SIAKA</div>
  </div>

  <div class="topbar-right" id="profileArea" tabindex="0" aria-haspopup="true" aria-expanded="false" aria-label="Profile menu">
    <span>Dasha Taran</span>
    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" />
    <div class="profile-dropdown" id="profileDropdown" role="menu" aria-hidden="true">
      <div class="profile-name">Dasha Taran</div>
      <a href="<?= base_url("/action/login/logout.php"); ?>" class="btn btn-danger" role="menuitem" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
      <!-- <button id="logoutBtn" role="menuitem">Logout</button> -->
    </div>
  </div>
</div>