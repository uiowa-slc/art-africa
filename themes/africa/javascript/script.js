// rems(1) => 16
// takes the font-size of the <html> element (root element/rem) and multiplies
// it by n and returns an integer
function rems (n) {
  var htmlElement = document.getElementsByTagName('html')[0];
  return parseInt(getComputedStyle(htmlElement, null).getPropertyValue('font-size')) * n;
}



// <span data-toggle="#nav">Toggle nav</span>
//
// By giving an HTML element a `data-toggle` value,
// clicking it will toggle elements matching the selector
$(document).on('click', '[data-toggle]', function () {
  var $el = $(this);
  var toggleSelector = $el.attr('data-toggle');
  var $toggleEls = $(toggleSelector);
  $toggleEls.toggleClass('toggle');
});



// make certain images take up the entire width of their container
// even if it has padding. Don't let the width exceed the image's
// natural width
function sizeFullWidthImages () {
  var $mc = $('#main_content');
  $mc.find('img.full-width').css('width', ($mc.outerWidth()+2).toString() + 'px')
                            .css('position', 'relative')
                            .css('left', '-' + $mc.css('padding-left'));
}
$(document).ready(sizeFullWidthImages);
$(window).on('resize', sizeFullWidthImages);

function setFullWidthImagesMaxWidth () {
  $('#main_content img.full-width').each(function () {
    $(this).on('load', function () {
      var nw = this.naturalWidth;
      $(this).css('max-width', nw.toString() + 'px');
    });
  });
}
$(document).ready(setFullWidthImagesMaxWidth);



$(document).ready(function () {
  // $('.gal').magnificPopup({
  //   delegate: '.gal-link',
  //   type: 'image',
  //   gallery: {
  //     enabled: true
  //   }
  // });
    var poppingUp = false;

   $('.artPhoto').magnificPopup({
    type: 'image',
    alignTop: true,
    fixedBgPos: false,
    gallery: {
      enabled: true,
      navigateByImgClick: false
    },
    callbacks: {
      open: function() {
        $('.top-link').hide();
        poppingUp = true;
      },
      close: function(){
        poppingUp = false;
      }
    }

  }); 
  
 /*  $('#main_content').magnificPopup({
    delegate: '.open-glossary-link',
    type: 'inline'
    
  });*/
  
  $('#main_content').magnificPopup({
    delegate: '.avContent',
    type: 'iframe',
    gallery: {
      enabled: true,
      navigateByImgClick: false
    },
    iframe: {
      markup: '<div class="mfp-iframe-scaler">'+
                '<div class="mfp-close"></div>'+
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
              '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

      patterns: {
        youtube: {
          index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

          id: 'v=', // String that splits URL in a two parts, second part should be %id%
          // Or null - full URL will be returned
          // Or a function that should return %id%, for example:
          // id: function(url) { return 'parsed id'; } 

          src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0' // URL that will be set as a source for iframe. 
        },
        vimeo: {
          index: 'vimeo.com/',
          id: '/',
          src: '//player.vimeo.com/video/%id%?autoplay=1'
        },
        gmaps: {
          index: '//maps.google.',
          src: '%id%&output=embed'
        }

        // you may add here more sources

      },

      srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
    }
  }); 
  
  
    
 // $('video').mediaelementplayer(); //Replaces video tags with media element player
  
  


  $(".nav2.interior-page").sticky({topSpacing:0});

    /* back to top link */
    var topOffset = 220;
    var topDuration = 500;
    jQuery(window).scroll(function() {
        if ((jQuery(this).scrollTop() > topOffset) && (poppingUp == false)) {
            jQuery('.top-link').fadeIn(topDuration);
        } else {
            jQuery('.top-link').fadeOut(topDuration);
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
// var country = new google.maps.LatLng(7.6219, 6.9743);

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
  if (! /\/countries(\/)?/.test(window.location.pathname)) { return; }

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
        { "visibility": "on" }
      ]
    },{
      "featureType": "poi.park",
      "stylers": [
        { "visibility": "on" }
      ]
    }
  ];

  var geocoder;
  var marker;
  geocoder = new google.maps.Geocoder();
  var countryNameToStartMapOn;
  var zoomLevel;

  // if the url ends in /countries/ (trailing slash optional)
  if (/countries(\/)?$/.test(window.location.pathname)) {
    countryNameToStartMapOn = 'Central African Republic';
    zoomLevel = 3;
  } else {
    // countryNameToStartMapOn = [$('.capital_city').text(), $('#main_content h1:first').text()].join(', ');


    countryNameToStartMapOn = $('#main_content h1:first').data("googlename");
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
        mapTypeIds: [
          google.maps.MapTypeId.ROADMAP,
          MY_MAPTYPE_ID
        ]
      },
      mapTypeId: MY_MAPTYPE_ID,
      draggableCursor: 'pointer'
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var styledMapOptions = { name: 'Custom Style' };

    var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

    map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
 
 
 

    
    var coordinates = new Array();
    
    //If a country shows up incorrectly, the coordinates are probably flipped
    
    //Entry for Cameroon
     coordinates.push(['1', [3.866667, 11.516667]]);
    
    //Entry for Angola
     coordinates.push(['2', [-8.838333, 13.234444]]);
    
    //Entry for Benin
     coordinates.push(['3', [6.497222, 2.605]]);
    
    //Entry for Burkina Faso
     coordinates.push(['4', [12.357222, -1.535278]])
    
    //Entry for Chad
     coordinates.push(['5', [12.113056, 15.049167]]);
    
    // Entry for Congo
     coordinates.push(['6', [-4.267778, 15.291944]]);

     
     //Entry for Democratic Republic Of Congo
     coordinates.push(['7', [-4.325, 15.322222]]);
    
     //Entry for Cote D'Ivoire
	 coordinates.push(['8', [6.816667, -5.283333]]);
    
     //Entry for Gabon
     coordinates.push(['9', [0.39, 9.45]]);
    
     //Entry for Ghana
     coordinates.push(['10', [5.55, -0.2]]);
        
     //Entry for Guinea-Bissau
     coordinates.push(['11', [11.85, -15.566667]]);
     
     //Entry for Guinea-Conakry
     coordinates.push(['12', [9.516667, -13.7]]);
      
     //Entry for Kenya
     coordinates.push(['13', [-1.283333, 36.816667]]);
     
     //Entry for Liberia
     coordinates.push(['14', [6.313333, -10.801389]]);
     
     //Entry for Mali
     coordinates.push(['15', [12.65, -8]]);
     
     //Entry for Niger
     coordinates.push(['16', [13.521389, 2.105278]]);
     
     //Entry for Nigeria
     coordinates.push(['17', [9.066667, 7.483333]]);
     
     //Entry for Senegal
     coordinates.push(['18', [14.6667, -17.4167]]);
     
     //Entry for Sierra Leone
     coordinates.push(['19', [8.483069, -13.228598]]); 
     
     //Entry for South Africa
     coordinates.push(['20', [-25.736818, 28.220386]]);
     
     //Entry for Tanzania
     coordinates.push(['21', [-6.8, 39.283333]]);
     
     //Entry for Togo
     coordinates.push(['22', [6.135589, 1.238257]]); 
     
     //Entry for Zambia
     coordinates.push(['23', [-15.408837, 28.280153]]);
          
      //Entry for Zimbabwe
     coordinates.push(['24', [-17.863889, 31.029722]]);
     
     //Entry for Botswana
     coordinates.push(['25', [-24.658056, 25.912222]]);

     var markers = new Array();
     

     for (var i = 0; i < coordinates.length; i++){

	     marker = new google.maps.Marker({
    		 position: new google.maps.LatLng(coordinates[i][1][0], coordinates[i][1][1]),
    		 map: map,
    		 draggable: false,
    		 clickable: true,
			 animation: google.maps.Animation.DROP,
    		 title: coordinates[i][0] 
	       	 
		  }); 

        markers.push(marker);

    google.maps.event.addListener(markers[i], 'click', function (mouseEvent) {
      window.location.href = '/countries/show/'+this.title;
    });   
     
}     
   
    //http://gmaps-samples-v3.googlecode.com/svn/trunk/country_explorer/country_explorer.html
    google.maps.event.addListener(map, 'click', function (mouseEvent) {
      geocoder.geocode(
        {'latLng': mouseEvent.latLng},
        function (results, status) {
          // var headingP = document.getElementById('country');
          if (status == google.maps.GeocoderStatus.OK) {
            var country = getCountry(results);
            var matchingCountryLink = $('.nav2 a').filter(function () {
            var countryName = $(this).data('googlename');
            return countryName === country.long_name;
            });
            if (matchingCountryLink.length === 1) {
              window.location.href = matchingCountryLink.attr('href');
            } else {
              console.log(country.long_name + ' not found in Countries list.');
            }
          }
        }
      );
    });


    setDraggable(map);

    $(window).on('resize', function () {
      setDraggable(map);
    });
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

$(document).on('click', '#map-canvas-notice button', function () {
  $('#map-canvas-notice > div').fadeOut({ duration: 100 });
  $('#map-canvas-notice').fadeOut({ duration: 200 });
});

$(document).on('click', '.grid-item', function () {
  window.location.href = $(this).find('a').attr('href');
});

$(document).on('click', 'marker', function () {
  window.location.href = $(this).find('a').attr('href');
});


$(document).on('mouseover', '.grid-item', function () {
  $(this).find('a').addClass('hover');
});

$(document).on('mouseout', '.grid-item', function () {
  $(this).find('a').removeClass('hover');
});

$(document).ready(function () {
  if ((/\/countries(\/)?/).test( window.location.pathname )) {
    $('#footer').css('margin-left', 0)
                .css('margin-right', 0)
                .addClass('padded');
  }
});



function setDraggable (map) {
  var draggable = window.outerWidth > 768;

  var options = {
    draggable: draggable,
    panControl: draggable,
    scrollwheel: draggable
  };

  map.setOptions(options);
}
