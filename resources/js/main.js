$('.navtop-toggler').click( function () {
  // $('.static-navtop-list').toggle();
  $('.navtop-container').toggleClass('active');
} );
$('.navbar-center-toggler').click( function () {
  $('.navbar-center').toggleClass('active');
  $('body').toggleClass('overflow-hidden');
} );
