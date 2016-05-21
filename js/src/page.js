jQuery( document ).ready(function( $ ) {
  if($('.home-features').get(0) && $(window).width() > 1000) {
    $('.home-features article').hover(
      function() {
        $(this).width('50%');
        $(this).siblings('article').width('25%');
      },
      function() {
        $('.home-features article').width('33.333%');
      }
    );
  }

  $('a.close-search').click(function(){
    $('div.holds-search').hide();
  });
  $('a.show-search').click(function(){
    $('div.holds-search').show();
  });
});
