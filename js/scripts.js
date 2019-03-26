//Inicializar Google Maps
var map;
function initMap() {
  console.log(options);
  var coords = { lat: parseFloat(options.latitude), lng: parseFloat(options.longitude) };
  map = new google.maps.Map(document.getElementById('map'), {
    center: coords,
    zoom: parseInt(options.zoom)
  });
  var marker = new google.maps.Marker({
    position: coords,
    map: map,
    title: 'La Pizzeria'
  });
}

$ = jQuery.noConflict();

$(document).ready(() => {
  $('.mobile-menu a').on('click', () => {
    $('.site-menu').toggle('slow');
  });

  var breakpoint = 768;
  $(window).resize(() => {
    if($(document).width() >= breakpoint) $('.site-menu').show();
    else $('site-menu').hide();
  });

  //Ajustar mapa
  if($('#map')) {
    if($(document).width() >= breakpoint) mapAdjust();
    else mapAdjust(300);
  }
  $(window).resize(() => {
    if($('#map')) {
      if($(document).width() >= breakpoint) mapAdjust();
      else mapAdjust(300);
    }
  });

  //Fluidbox
  $('.wp-block-gallery .blocks-gallery-item').each(() => $('a').fluidbox());
});

function mapAdjust(height) {
  if(!height) $('#map').css({'height': $('.reservation-location').height()});
  else $('#map').css({'height': height});
}
