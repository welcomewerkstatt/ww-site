<script defer>
  let sidebarCollapsed = false;
  let isMobile = false;

  function checkWindowSize() {
    if (window.innerWidth <= 600) {
      isMobile = true;
      sidebarCollapsed = true;
    } else {
      isMobile = false;
      sidebarCollapsed = false;
    }
  }
  window.addEventListener("resize", checkWindowSize);


  const toggleSidebar = () => {
    document.querySelector('.navigation').classList.toggle('collapsed-navigation');
    document.querySelector('.navigation').classList.toggle('height-transition');
    document.querySelector('.content').classList.toggle('uncollapsed-content');
    document.querySelector('.content').classList.toggle('h-0-mobile');
    document.querySelector('.content').classList.toggle('w-full');
    document.querySelector('.content').classList.toggle('height-transition-delay-0');
    document.querySelector('#floating-button').classList.toggle('hidden');
    document.querySelector('#sidebar-button').classList.toggle('hidden');
  }

  checkWindowSize();

  // Clicking on a menu link on mobile will hide sidebar
  if (isMobile) {
    toggleSidebar();
  }
</script>
</body>
</html>