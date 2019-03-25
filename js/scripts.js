$ = jQuery.noConflict();

$(document).ready(() => {
  $('.mobile-menu a').on('click', () => {
    $('.site-menu').toggle('slow');
  });

  $(window).resize(() => {
    if($(document).width() >= 768) $('.site-menu').show();
    else $('site-menu').hide();
  });

  //Fluidbox
  $('.wp-block-gallery .blocks-gallery-item').each(() => $('a').fluidbox());
});
