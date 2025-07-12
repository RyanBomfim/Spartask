// ../js/sidebar-toggle.js
$(function() {
  const $sidebar = $('nav.sidebar');
  $('#btn-toggle-sidebar').click(function() {
    $sidebar.toggleClass('active');
  });
  // Fechar sidebar ao clicar em link (mobile)
  $('nav.sidebar .nav-link').click(function() {
    if ($(window).width() < 992) {
      $sidebar.removeClass('active');
    }
  });
});
