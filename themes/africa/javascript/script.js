/*
 * Functions
 * =========
 */
function rems (n) {
  var htmlElement = document.getElementsByTagName('html')[0];
  return parseInt(getComputedStyle(htmlElement, null).getPropertyValue('font-size')) * n;
}

/*
 * toggle
 * ======
 */
$(document).on('click', '[data-toggle]', function () {
  var $el = $(this);
  var toggleSelector = $el.attr('data-toggle');
  var $toggleEls = $(toggleSelector);
  $toggleEls.toggleClass('toggle');
});

/*
 * #main_content img
 * =================
 */
function sizeMainContentImages () {
  // var $mc = $('#main_content');
  // $mc.find('img:not([width])').css('width', ($mc.outerWidth()+2).toString() + 'px')
  //                             .css('position', 'relative')
  //                             .css('left', '-' + $mc.css('padding-left'));
}
function setMainContentImgMaxWidth () {
  // $('#main_content img:not([width])').each(function () {
  //   $(this).on('load', function () {
  //     var nw = this.naturalWidth;
  //     $(this).css('max-width', nw.toString() + 'px')
  //   });
  // });
}
$(document).ready(setMainContentImgMaxWidth);
$(document).ready(sizeMainContentImages);
$(window).on('resize', sizeMainContentImages);

/*
 * #main_content min-height
 * ========================
 */
// $(document).ready(function () {
//   setMainContentMinHeight();
// });
// $(window).on('resize', function () {
//   setMainContentMinHeight();
// });
// function setMainContentMinHeight () {
//   if (window.outerWidth <= 768) {
//     $('#main_content').css('min-height', '0px');
//   } else {
//     $('#main_content').css('min-height', $('#middle .nav2').outerHeight().toString() + 'px');
//   }
// }

window.addEventListener('load', function() {
  setTimeout(function () {
    window.scrollTo(0, 1); // Hide the address bar on iOS
  }, 0);
});

$(document).ready(function () {
  // $('.gal').magnificPopup({
  //   delegate: '.gal-link',
  //   type: 'image',
  //   gallery: {
  //     enabled: true
  //   }
  // });
  $('#main_content').magnificPopup({
    delegate: '.artPhoto',
    type: 'image',
    gallery: {
      enabled: true,
      navigateByImgClick: false
    }
  });
});

$(document).on('click', '.mfp-img', function (event) {
  event.preventDefault();
  var src = $(this).attr('src'),
      ap  = $('.artPhoto[data-mfp-src="' + src + '"]:first');

  console.log(ap.length);
  window.location.href = ap.attr('data-mfp-href');
});


var map;
var country = new google.maps.LatLng(7.6219, 6.9743);

var MY_MAPTYPE_ID = 'custom_style';

function getCountry(results) {
  var geocoderAddressComponent,addressComponentTypes,address;
  for (var i in results) {
    geocoderAddressComponent = results[i].address_components;
    for (var j in geocoderAddressComponent) {
      address = geocoderAddressComponent[j];
      addressComponentTypes = geocoderAddressComponent[j].types;
      for (var k in addressComponentTypes) {
        if (addressComponentTypes[k] == 'country') {
          return address;
        }
      }
    }
  }
  return 'Unknown';
}

function initialize() {
  if (! /\/countries\//.test(window.location.pathname)) { return; }

  var featureOpts = [
    {
      "featureType": "water",
      "stylers": [
        { "visibility": "on" },
        { "color": "#0b0be6" },
        { "lightness": 88 },
        { "saturation": -45 }
      ]
    },{
      "featureType": "landscape.natural",
      "stylers": [
        { "color": "#828080" },
        { "lightness": 100 }
      ]
    },{
      "featureType": "administrative.country",
      "elementType": "geometry",
      "stylers": [
        { "color": "#e62033" },
        { "visibility": "on" },
        { "weight": 1.3 }
      ]
    },{
      "featureType": "road",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "poi.park",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "poi.park",
      "stylers": [
        { "visibility": "off" }
      ]
    }
  ];

  var geocoder;
  var marker;
  geocoder = new google.maps.Geocoder();
  var countryNameToStartMapOn;
  var zoomLevel;

  if (/countries(\/)?$/.test(window.location.pathname)) {
    countryNameToStartMapOn = 'Central African Republic';
    zoomLevel = 3;
  } else {
    // countryNameToStartMapOn = [$('.capital_city').text(), $('#main_content h1:first').text()].join(', ');
    countryNameToStartMapOn = $('#main_content h1:first').text();
    zoomLevel = 5;
  }

  geocoder.geocode({ 'address': countryNameToStartMapOn }, function (results, status) {
    // if (status == google.maps.GeocoderStatus.OK) {
    //   map.setCenter(results[0].geometry.location);
    // }

    var mapOptions = {
      zoom: zoomLevel,
      center: results[0].geometry.location,
      mapTypeControlOptions: {
        mapTypeIds: [ google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID ]
      },
      mapTypeId: MY_MAPTYPE_ID,
      draggableCursor: 'pointer'
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var styledMapOptions = { name: 'Custom Style' };

    var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

    map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

    $('.nav2 a').each(function (i) {
      var nav2a = $(this);
      var countryName = nav2a.data('gmaps');
      var countryHref = nav2a.attr('href');
      geocoder.geocode({ 'address': countryName }, function (results, status) {
        setTimeout(function () {
          var countryMarker = new google.maps.Marker({
            position:  results[0].geometry.location,
            map:       map,
            title:     'Example Country',
            url:       'https://www.google.com/',
            animation: google.maps.Animation.DROP
            // icon:      'http://cdn.iphoneincanada.ca/wp-content/uploads/2012/09/Google-Maps-icon.png'
          });
          google.maps.event.addListener(countryMarker, 'click', function (mouseEvent) {
            // countryMarker.setAnimation(google.maps.Animation.DROP);
            window.location.href = countryHref;
          });
        }, i * 100);
      });
    });

    //http://gmaps-samples-v3.googlecode.com/svn/trunk/country_explorer/country_explorer.html
    google.maps.event.addListener(map, 'click', function (mouseEvent) {
      geocoder.geocode(
        {'latLng': mouseEvent.latLng},
        function (results, status) {
          // var headingP = document.getElementById('country');
          if (status == google.maps.GeocoderStatus.OK) {
            var country = getCountry(results);
            var matchingCountryLink = $('.nav2 a').filter(function () {
              var countryName = $(this).text();
              return countryName === country.long_name;
            });
            if (matchingCountryLink.length === 1) {
              window.location.href = matchingCountryLink.attr('href');
            } else {
              console.log(country.long_name + ' not found in Countries list.');
            }
            // marker.setPosition(mouseEvent.latLng);
            // marker.setIcon(getCountryIcon(country));
            // headingP.innerHTML = country.long_name+ ' <br> ';
          }
          // if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
          //   marker.setPosition(mouseEvent.latLng);
          //   marker.setIcon(
          //       getMsgIcon('Oups, I have no idea, are you on water?'));
          //   headingP.innerHTML = 'Oups, ' +
          //       'I have no idea, are you on water?';
          // }
          // if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
          //   marker.setPosition(mouseEvent.latLng);
          //   marker.setIcon(
          //       getMsgIcon('Whoa! Hold your horses :) You are quick! ' +
          //           'too quick!')
          //       );
          //   headingP.innerHTML = 'Whoa! You are just too quick!';
          // }
        }
      );
    });
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

$(document).on('click', '#map-canvas-notice button', function () {
  $('#map-canvas-notice > div').fadeOut({ duration: 100 });
  $('#map-canvas-notice').fadeOut({ duration: 200 });
});
