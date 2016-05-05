jQuery( document ).ready(function( $ ) {
  if($('.home-features').get(0) && $(window).width() > 1000) {
    $('.home-features article').hover(
      function() {
        $(this).width('49%');
        $(this).siblings('article').width('25%');
      },
      function() {
        $('.home-features article').width('33%');
      }
    );
  }
});
