</main>
</div>
<script>
  const sidebar = document.getElementById('sidebar');
  const btnToggleSidebar = document.getElementById('btnToggleSidebar');
  const profileArea = document.getElementById('profileArea');
  const profileDropdown = document.getElementById('profileDropdown');
  const tabs = document.querySelectorAll('.tab');
  const dosenContent = document.getElementById('dosen-content');
  const mahasiswaContent = document.getElementById('mahasiswa-content');

  // Toggle sidebar on click hamburger - works desktop & mobile
  btnToggleSidebar.addEventListener('click', () => {
    sidebar.classList.toggle('hide');

    // Adjust container margin on desktop
    if (window.innerWidth <= 1024) {
      // Mobile: toggle class 'show' untuk sidebar
      sidebar.classList.toggle('show');
    } else if (window.innerWidth > 1024) {
      if (sidebar.classList.contains('hide')) {
        document.querySelector('.container').style.marginLeft = '0';
      } else {
        document.querySelector('.container').style.marginLeft = '240px';
      }
    }
  });
  // Profile dropdown toggle
  profileArea.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('show');

    // Update aria-expanded
    let expanded = profileDropdown.classList.contains('show');
    profileArea.setAttribute('aria-expanded', expanded);
  });

  // Close profile dropdown on outside click
  document.addEventListener('click', () => {
    if (profileDropdown.classList.contains('show')) {
      profileDropdown.classList.remove('show');
      profileArea.setAttribute('aria-expanded', false);
    }
  });

  // Sidebar submenu toggle
  document.querySelectorAll('.menu-item.has-submenu').forEach((toggleItem) => {
    toggleItem.addEventListener('click', () => {
      const submenu = toggleItem.nextElementSibling;
      const isOpen = submenu.classList.contains('open');

      // Tutup semua submenu & hapus class open
      document.querySelectorAll('.menu-item.has-submenu').forEach(item => item.classList.remove('open'));
      document.querySelectorAll('.submenu').forEach(sub => sub.classList.remove('open'));

      // Jika submenu sebelumnya tidak terbuka, buka submenu yang diklik
      if (!isOpen) {
        toggleItem.classList.add('open');
        submenu.classList.add('open');
      }
      // Jika submenu sudah terbuka, maka setelah baris di atas di-skip, otomatis tertutup
    });
  });

  // Hide automatic alert
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert => {
      alert.style.display = 'none';
    });
  }, 2500); // hilang setelah 2.5 detik


  // Tabs switching
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => {
        t.classList.remove('active');
        t.setAttribute('aria-selected', false);
        t.setAttribute('tabindex', '-1');
      });
      tab.classList.add('active');
      tab.setAttribute('aria-selected', true);
      tab.setAttribute('tabindex', '0');

      if (tab.dataset.tab === 'dosen') {
        dosenContent.style.display = 'block';
        mahasiswaContent.style.display = 'none';
      } else {
        dosenContent.style.display = 'none';
        mahasiswaContent.style.display = 'block';
      }

      // If mobile, close sidebar after tab click
      if (window.innerWidth <= 1024) {
        sidebar.classList.add('hide');
        document.querySelector('.container').style.marginLeft = '0';
      }
    });
  });

  // Accessibility: keyboard navigation for tabs
  tabs.forEach(tab => {
    tab.addEventListener('keydown', e => {
      let index = [...tabs].indexOf(tab);
      if (e.key === 'ArrowRight') {
        e.preventDefault();
        let nextIndex = (index + 1) % tabs.length;
        tabs[nextIndex].focus();
        tabs[nextIndex].click();
      } else if (e.key === 'ArrowLeft') {
        e.preventDefault();
        let prevIndex = (index - 1 + tabs.length) % tabs.length;
        tabs[prevIndex].focus();
        tabs[prevIndex].click();
      }
    });
  });

  // Handle window resize to reset container margin if needed
  window.addEventListener('resize', () => {
    if (window.innerWidth > 1024) {
      if (!sidebar.classList.contains('hide')) {
        document.querySelector('.container').style.marginLeft = '240px';
      }
      sidebar.classList.remove('show'); // pastikan class show dihapus di desktop
    } else {
      document.querySelector('.container').style.marginLeft = '0';
      sidebar.classList.remove('hide'); // pastikan class hide dihapus di mobile
    }
  });
</script>