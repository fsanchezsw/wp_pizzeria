jQuery(($) => {
  $('#login h1, #login form').wrapAll('<div class="group"></div>');

  $('body').vegas({
    slides: [
      { src: login_images.path + '/img/01.jpg' },
      { src: login_images.path + '/img/02.jpg' },
      { src: login_images.path + '/img/03.jpg' },
      { src: login_images.path + '/img/04.jpg' },
      { src: login_images.path + '/img/05.jpg' },
      { src: login_images.path + '/img/06.jpg' },
      { src: login_images.path + '/img/07.jpg' },
      { src: login_images.path + '/img/08.jpg' }
    ]
  });
});
