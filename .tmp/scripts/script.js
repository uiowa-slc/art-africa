// rems(1) => 16
// takes the font-size of the <html> element (root element/rem) and multiplies
// it by n and returns an integer
function rems (n) {
  var htmlElement = document.getElementsByTagName('html')[0];
  return parseInt(getComputedStyle(htmlElement, null).getPropertyValue('font-size')) * n;
}

const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();


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

 // console.log( ap.attr('data-mfp-href'));
  //window.event.returnValue = false;
  //window.location.assign(ap.attr('data-mfp-href'));
  window.location.href = ap.attr('data-mfp-href');
});


/*  
*	
*
*
*	COUTNRY MAP JS 
*
*
*
*/


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
    zoomLevel = 4;
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

  	$('.countries').children("li").each(function(index, element) {
		var venue = this;
		//console.log(this);
		var venueID = venue.id;
		//var title = $(this).data("title");
		var lat = $(this).data("lat");
		var lng = $(this).data("lng");
		//var address = $(this).data("address");
		//var venueLatLng;
		
		coordinates.push([venueID, [lat, lng]]);
	});	

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
			window.location.href = 'countries/show/'+this.title;
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
              //console.log(country.long_name + ' not found in Countries list.');
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
    scrollwheel: false
  };

  map.setOptions(options);
}

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJzY3JpcHQuanMiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gcmVtcygxKSA9PiAxNlxuLy8gdGFrZXMgdGhlIGZvbnQtc2l6ZSBvZiB0aGUgPGh0bWw+IGVsZW1lbnQgKHJvb3QgZWxlbWVudC9yZW0pIGFuZCBtdWx0aXBsaWVzXG4vLyBpdCBieSBuIGFuZCByZXR1cm5zIGFuIGludGVnZXJcbmZ1bmN0aW9uIHJlbXMgKG4pIHtcbiAgdmFyIGh0bWxFbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ2h0bWwnKVswXTtcbiAgcmV0dXJuIHBhcnNlSW50KGdldENvbXB1dGVkU3R5bGUoaHRtbEVsZW1lbnQsIG51bGwpLmdldFByb3BlcnR5VmFsdWUoJ2ZvbnQtc2l6ZScpKSAqIG47XG59XG5cbmNvbnN0IG9ic2VydmVyID0gbG96YWQoKTsgLy8gbGF6eSBsb2FkcyBlbGVtZW50cyB3aXRoIGRlZmF1bHQgc2VsZWN0b3IgYXMgJy5sb3phZCdcbm9ic2VydmVyLm9ic2VydmUoKTtcblxuXG4vLyA8c3BhbiBkYXRhLXRvZ2dsZT1cIiNuYXZcIj5Ub2dnbGUgbmF2PC9zcGFuPlxuLy9cbi8vIEJ5IGdpdmluZyBhbiBIVE1MIGVsZW1lbnQgYSBgZGF0YS10b2dnbGVgIHZhbHVlLFxuLy8gY2xpY2tpbmcgaXQgd2lsbCB0b2dnbGUgZWxlbWVudHMgbWF0Y2hpbmcgdGhlIHNlbGVjdG9yXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCAnW2RhdGEtdG9nZ2xlXScsIGZ1bmN0aW9uICgpIHtcbiAgdmFyICRlbCA9ICQodGhpcyk7XG4gIHZhciB0b2dnbGVTZWxlY3RvciA9ICRlbC5hdHRyKCdkYXRhLXRvZ2dsZScpO1xuICB2YXIgJHRvZ2dsZUVscyA9ICQodG9nZ2xlU2VsZWN0b3IpO1xuICAkdG9nZ2xlRWxzLnRvZ2dsZUNsYXNzKCd0b2dnbGUnKTtcbn0pO1xuXG5cblxuLy8gbWFrZSBjZXJ0YWluIGltYWdlcyB0YWtlIHVwIHRoZSBlbnRpcmUgd2lkdGggb2YgdGhlaXIgY29udGFpbmVyXG4vLyBldmVuIGlmIGl0IGhhcyBwYWRkaW5nLiBEb24ndCBsZXQgdGhlIHdpZHRoIGV4Y2VlZCB0aGUgaW1hZ2Unc1xuLy8gbmF0dXJhbCB3aWR0aFxuZnVuY3Rpb24gc2l6ZUZ1bGxXaWR0aEltYWdlcyAoKSB7XG4gIHZhciAkbWMgPSAkKCcjbWFpbl9jb250ZW50Jyk7XG4gICRtYy5maW5kKCdpbWcuZnVsbC13aWR0aCcpLmNzcygnd2lkdGgnLCAoJG1jLm91dGVyV2lkdGgoKSsyKS50b1N0cmluZygpICsgJ3B4JylcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAuY3NzKCdwb3NpdGlvbicsICdyZWxhdGl2ZScpXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgLmNzcygnbGVmdCcsICctJyArICRtYy5jc3MoJ3BhZGRpbmctbGVmdCcpKTtcbn1cbiQoZG9jdW1lbnQpLnJlYWR5KHNpemVGdWxsV2lkdGhJbWFnZXMpO1xuJCh3aW5kb3cpLm9uKCdyZXNpemUnLCBzaXplRnVsbFdpZHRoSW1hZ2VzKTtcblxuZnVuY3Rpb24gc2V0RnVsbFdpZHRoSW1hZ2VzTWF4V2lkdGggKCkge1xuICAkKCcjbWFpbl9jb250ZW50IGltZy5mdWxsLXdpZHRoJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgJCh0aGlzKS5vbignbG9hZCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgIHZhciBudyA9IHRoaXMubmF0dXJhbFdpZHRoO1xuICAgICAgJCh0aGlzKS5jc3MoJ21heC13aWR0aCcsIG53LnRvU3RyaW5nKCkgKyAncHgnKTtcbiAgICB9KTtcbiAgfSk7XG59XG4kKGRvY3VtZW50KS5yZWFkeShzZXRGdWxsV2lkdGhJbWFnZXNNYXhXaWR0aCk7XG5cblxuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG4gICAgdmFyIHBvcHBpbmdVcCA9IGZhbHNlO1xuXG4gICAkKCcuYXJ0UGhvdG8nKS5tYWduaWZpY1BvcHVwKHtcbiAgICB0eXBlOiAnaW1hZ2UnLFxuICAgIGFsaWduVG9wOiB0cnVlLFxuICAgIGZpeGVkQmdQb3M6IGZhbHNlLFxuICAgIGdhbGxlcnk6IHtcbiAgICAgIGVuYWJsZWQ6IHRydWUsXG4gICAgICBuYXZpZ2F0ZUJ5SW1nQ2xpY2s6IGZhbHNlXG4gICAgfSxcbiAgICBjYWxsYmFja3M6IHtcbiAgICAgIG9wZW46IGZ1bmN0aW9uKCkge1xuICAgICAgICAkKCcudG9wLWxpbmsnKS5oaWRlKCk7XG4gICAgICAgIHBvcHBpbmdVcCA9IHRydWU7XG4gICAgICB9LFxuICAgICAgY2xvc2U6IGZ1bmN0aW9uKCl7XG4gICAgICAgIHBvcHBpbmdVcCA9IGZhbHNlO1xuICAgICAgfVxuICAgIH1cblxuICB9KTsgXG4gIFxuICAkKCcjbWFpbl9jb250ZW50JykubWFnbmlmaWNQb3B1cCh7XG4gICAgZGVsZWdhdGU6ICcuYXZDb250ZW50JyxcbiAgICB0eXBlOiAnaWZyYW1lJyxcbiAgICBnYWxsZXJ5OiB7XG4gICAgICBlbmFibGVkOiB0cnVlLFxuICAgICAgbmF2aWdhdGVCeUltZ0NsaWNrOiBmYWxzZVxuICAgIH0sXG4gICAgaWZyYW1lOiB7XG4gICAgICBtYXJrdXA6ICc8ZGl2IGNsYXNzPVwibWZwLWlmcmFtZS1zY2FsZXJcIj4nK1xuICAgICAgICAgICAgICAgICc8ZGl2IGNsYXNzPVwibWZwLWNsb3NlXCI+PC9kaXY+JytcbiAgICAgICAgICAgICAgICAnPGlmcmFtZSBjbGFzcz1cIm1mcC1pZnJhbWVcIiBmcmFtZWJvcmRlcj1cIjBcIiBhbGxvd2Z1bGxzY3JlZW4+PC9pZnJhbWU+JytcbiAgICAgICAgICAgICAgJzwvZGl2PicsIC8vIEhUTUwgbWFya3VwIG9mIHBvcHVwLCBgbWZwLWNsb3NlYCB3aWxsIGJlIHJlcGxhY2VkIGJ5IHRoZSBjbG9zZSBidXR0b25cblxuICAgICAgcGF0dGVybnM6IHtcbiAgICAgICAgeW91dHViZToge1xuICAgICAgICAgIGluZGV4OiAneW91dHViZS5jb20vJywgLy8gU3RyaW5nIHRoYXQgZGV0ZWN0cyB0eXBlIG9mIHZpZGVvIChpbiB0aGlzIGNhc2UgWW91VHViZSkuIFNpbXBseSB2aWEgdXJsLmluZGV4T2YoaW5kZXgpLlxuXG4gICAgICAgICAgaWQ6ICd2PScsIC8vIFN0cmluZyB0aGF0IHNwbGl0cyBVUkwgaW4gYSB0d28gcGFydHMsIHNlY29uZCBwYXJ0IHNob3VsZCBiZSAlaWQlXG4gICAgICAgICAgLy8gT3IgbnVsbCAtIGZ1bGwgVVJMIHdpbGwgYmUgcmV0dXJuZWRcbiAgICAgICAgICAvLyBPciBhIGZ1bmN0aW9uIHRoYXQgc2hvdWxkIHJldHVybiAlaWQlLCBmb3IgZXhhbXBsZTpcbiAgICAgICAgICAvLyBpZDogZnVuY3Rpb24odXJsKSB7IHJldHVybiAncGFyc2VkIGlkJzsgfSBcblxuICAgICAgICAgIHNyYzogJy8vd3d3LnlvdXR1YmUuY29tL2VtYmVkLyVpZCU/YXV0b3BsYXk9MSZyZWw9MCcgLy8gVVJMIHRoYXQgd2lsbCBiZSBzZXQgYXMgYSBzb3VyY2UgZm9yIGlmcmFtZS4gXG4gICAgICAgIH0sXG4gICAgICAgIHZpbWVvOiB7XG4gICAgICAgICAgaW5kZXg6ICd2aW1lby5jb20vJyxcbiAgICAgICAgICBpZDogJy8nLFxuICAgICAgICAgIHNyYzogJy8vcGxheWVyLnZpbWVvLmNvbS92aWRlby8laWQlP2F1dG9wbGF5PTEnXG4gICAgICAgIH0sXG4gICAgICAgIGdtYXBzOiB7XG4gICAgICAgICAgaW5kZXg6ICcvL21hcHMuZ29vZ2xlLicsXG4gICAgICAgICAgc3JjOiAnJWlkJSZvdXRwdXQ9ZW1iZWQnXG4gICAgICAgIH1cblxuICAgICAgICAvLyB5b3UgbWF5IGFkZCBoZXJlIG1vcmUgc291cmNlc1xuXG4gICAgICB9LFxuXG4gICAgICBzcmNBY3Rpb246ICdpZnJhbWVfc3JjJywgLy8gVGVtcGxhdGluZyBvYmplY3Qga2V5LiBGaXJzdCBwYXJ0IGRlZmluZXMgQ1NTIHNlbGVjdG9yLCBzZWNvbmQgYXR0cmlidXRlLiBcImlmcmFtZV9zcmNcIiBtZWFuczogZmluZCBcImlmcmFtZVwiIGFuZCBzZXQgYXR0cmlidXRlIFwic3JjXCIuXG4gICAgfVxuICB9KTsgXG5cbiAgJChcIi5uYXYyLmludGVyaW9yLXBhZ2VcIikuc3RpY2t5KHt0b3BTcGFjaW5nOjB9KTtcblxuICAgIC8qIGJhY2sgdG8gdG9wIGxpbmsgKi9cbiAgICB2YXIgdG9wT2Zmc2V0ID0gMjIwO1xuICAgIHZhciB0b3BEdXJhdGlvbiA9IDUwMDtcbiAgICBqUXVlcnkod2luZG93KS5zY3JvbGwoZnVuY3Rpb24oKSB7XG4gICAgICAgIGlmICgoalF1ZXJ5KHRoaXMpLnNjcm9sbFRvcCgpID4gdG9wT2Zmc2V0KSAmJiAocG9wcGluZ1VwID09IGZhbHNlKSkge1xuICAgICAgICAgICAgalF1ZXJ5KCcudG9wLWxpbmsnKS5mYWRlSW4odG9wRHVyYXRpb24pO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgalF1ZXJ5KCcudG9wLWxpbmsnKS5mYWRlT3V0KHRvcER1cmF0aW9uKTtcbiAgICAgICAgfVxuICAgIH0pO1xuXG59KTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5tZnAtaW1nJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gIHZhciBzcmMgPSAkKHRoaXMpLmF0dHIoJ3NyYycpLFxuICAgICAgYXAgID0gJCgnLmFydFBob3RvW2RhdGEtbWZwLXNyYz1cIicgKyBzcmMgKyAnXCJdOmZpcnN0Jyk7XG5cbiAvLyBjb25zb2xlLmxvZyggYXAuYXR0cignZGF0YS1tZnAtaHJlZicpKTtcbiAgLy93aW5kb3cuZXZlbnQucmV0dXJuVmFsdWUgPSBmYWxzZTtcbiAgLy93aW5kb3cubG9jYXRpb24uYXNzaWduKGFwLmF0dHIoJ2RhdGEtbWZwLWhyZWYnKSk7XG4gIHdpbmRvdy5sb2NhdGlvbi5ocmVmID0gYXAuYXR0cignZGF0YS1tZnAtaHJlZicpO1xufSk7XG5cblxuLyogIFxuKlx0XG4qXG4qXG4qXHRDT1VUTlJZIE1BUCBKUyBcbipcbipcbipcbiovXG5cblxudmFyIG1hcDtcbi8vIHZhciBjb3VudHJ5ID0gbmV3IGdvb2dsZS5tYXBzLkxhdExuZyg3LjYyMTksIDYuOTc0Myk7XG5cbnZhciBNWV9NQVBUWVBFX0lEID0gJ2N1c3RvbV9zdHlsZSc7XG5cbmZ1bmN0aW9uIGdldENvdW50cnkocmVzdWx0cykge1xuICB2YXIgZ2VvY29kZXJBZGRyZXNzQ29tcG9uZW50LGFkZHJlc3NDb21wb25lbnRUeXBlcyxhZGRyZXNzO1xuICBmb3IgKHZhciBpIGluIHJlc3VsdHMpIHtcbiAgICBnZW9jb2RlckFkZHJlc3NDb21wb25lbnQgPSByZXN1bHRzW2ldLmFkZHJlc3NfY29tcG9uZW50cztcbiAgICBmb3IgKHZhciBqIGluIGdlb2NvZGVyQWRkcmVzc0NvbXBvbmVudCkge1xuICAgICAgYWRkcmVzcyA9IGdlb2NvZGVyQWRkcmVzc0NvbXBvbmVudFtqXTtcbiAgICAgIGFkZHJlc3NDb21wb25lbnRUeXBlcyA9IGdlb2NvZGVyQWRkcmVzc0NvbXBvbmVudFtqXS50eXBlcztcbiAgICAgIGZvciAodmFyIGsgaW4gYWRkcmVzc0NvbXBvbmVudFR5cGVzKSB7XG4gICAgICAgIGlmIChhZGRyZXNzQ29tcG9uZW50VHlwZXNba10gPT0gJ2NvdW50cnknKSB7XG4gICAgICAgICAgcmV0dXJuIGFkZHJlc3M7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9XG4gIH1cbiAgcmV0dXJuICdVbmtub3duJztcbn1cblxuZnVuY3Rpb24gaW5pdGlhbGl6ZSgpIHtcbiAgaWYgKCEgL1xcL2NvdW50cmllcyhcXC8pPy8udGVzdCh3aW5kb3cubG9jYXRpb24ucGF0aG5hbWUpKSB7IHJldHVybjsgfVxuXG4gIHZhciBmZWF0dXJlT3B0cyA9IFtcbiAgICB7XG4gICAgICBcImZlYXR1cmVUeXBlXCI6IFwid2F0ZXJcIixcbiAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgIHsgXCJ2aXNpYmlsaXR5XCI6IFwib25cIiB9LFxuICAgICAgICB7IFwiY29sb3JcIjogXCIjMGIwYmU2XCIgfSxcbiAgICAgICAgeyBcImxpZ2h0bmVzc1wiOiA4OCB9LFxuICAgICAgICB7IFwic2F0dXJhdGlvblwiOiAtNDUgfVxuICAgICAgXVxuICAgIH0se1xuICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcImxhbmRzY2FwZS5uYXR1cmFsXCIsXG4gICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICB7IFwiY29sb3JcIjogXCIjODI4MDgwXCIgfSxcbiAgICAgICAgeyBcImxpZ2h0bmVzc1wiOiAxMDAgfVxuICAgICAgXVxuICAgIH0se1xuICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcImFkbWluaXN0cmF0aXZlLmNvdW50cnlcIixcbiAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJnZW9tZXRyeVwiLFxuICAgICAgXCJzdHlsZXJzXCI6IFtcbiAgICAgICAgeyBcImNvbG9yXCI6IFwiI2U2MjAzM1wiIH0sXG4gICAgICAgIHsgXCJ2aXNpYmlsaXR5XCI6IFwib25cIiB9LFxuICAgICAgICB7IFwid2VpZ2h0XCI6IDEuMyB9XG4gICAgICBdXG4gICAgfSx7XG4gICAgICBcImZlYXR1cmVUeXBlXCI6IFwicm9hZFwiLFxuICAgICAgXCJzdHlsZXJzXCI6IFtcbiAgICAgICAgeyBcInZpc2liaWxpdHlcIjogXCJvZmZcIiB9XG4gICAgICBdXG4gICAgfSx7XG4gICAgICBcImZlYXR1cmVUeXBlXCI6IFwicG9pLnBhcmtcIixcbiAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgIHsgXCJ2aXNpYmlsaXR5XCI6IFwib25cIiB9XG4gICAgICBdXG4gICAgfSx7XG4gICAgICBcImZlYXR1cmVUeXBlXCI6IFwicG9pLnBhcmtcIixcbiAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgIHsgXCJ2aXNpYmlsaXR5XCI6IFwib25cIiB9XG4gICAgICBdXG4gICAgfVxuICBdO1xuXG4gIHZhciBnZW9jb2RlcjtcbiAgdmFyIG1hcmtlcjtcbiAgZ2VvY29kZXIgPSBuZXcgZ29vZ2xlLm1hcHMuR2VvY29kZXIoKTtcbiAgdmFyIGNvdW50cnlOYW1lVG9TdGFydE1hcE9uO1xuICB2YXIgem9vbUxldmVsO1xuXG4gIC8vIGlmIHRoZSB1cmwgZW5kcyBpbiAvY291bnRyaWVzLyAodHJhaWxpbmcgc2xhc2ggb3B0aW9uYWwpXG4gIGlmICgvY291bnRyaWVzKFxcLyk/JC8udGVzdCh3aW5kb3cubG9jYXRpb24ucGF0aG5hbWUpKSB7XG4gICAgY291bnRyeU5hbWVUb1N0YXJ0TWFwT24gPSAnQ2VudHJhbCBBZnJpY2FuIFJlcHVibGljJztcbiAgICB6b29tTGV2ZWwgPSA0O1xuICB9IGVsc2Uge1xuICAgIC8vIGNvdW50cnlOYW1lVG9TdGFydE1hcE9uID0gWyQoJy5jYXBpdGFsX2NpdHknKS50ZXh0KCksICQoJyNtYWluX2NvbnRlbnQgaDE6Zmlyc3QnKS50ZXh0KCldLmpvaW4oJywgJyk7XG5cblxuICAgIGNvdW50cnlOYW1lVG9TdGFydE1hcE9uID0gJCgnI21haW5fY29udGVudCBoMTpmaXJzdCcpLmRhdGEoXCJnb29nbGVuYW1lXCIpO1xuICAgIHpvb21MZXZlbCA9IDU7XG4gIH1cblxuICBnZW9jb2Rlci5nZW9jb2RlKHsgJ2FkZHJlc3MnOiBjb3VudHJ5TmFtZVRvU3RhcnRNYXBPbiB9LCBmdW5jdGlvbiAocmVzdWx0cywgc3RhdHVzKSB7XG4gICAgLy8gaWYgKHN0YXR1cyA9PSBnb29nbGUubWFwcy5HZW9jb2RlclN0YXR1cy5PSykge1xuICAgIC8vICAgbWFwLnNldENlbnRlcihyZXN1bHRzWzBdLmdlb21ldHJ5LmxvY2F0aW9uKTtcbiAgICAvLyB9XG5cbiAgICB2YXIgbWFwT3B0aW9ucyA9IHtcbiAgICAgIHpvb206IHpvb21MZXZlbCxcbiAgICAgIGNlbnRlcjogcmVzdWx0c1swXS5nZW9tZXRyeS5sb2NhdGlvbixcbiAgICAgIG1hcFR5cGVDb250cm9sT3B0aW9uczoge1xuICAgICAgICBtYXBUeXBlSWRzOiBbXG4gICAgICAgICAgZ29vZ2xlLm1hcHMuTWFwVHlwZUlkLlJPQURNQVAsXG4gICAgICAgICAgTVlfTUFQVFlQRV9JRFxuICAgICAgICBdXG4gICAgICB9LFxuICAgICAgbWFwVHlwZUlkOiBNWV9NQVBUWVBFX0lELFxuICAgICAgZHJhZ2dhYmxlQ3Vyc29yOiAncG9pbnRlcidcbiAgICB9O1xuXG4gICAgbWFwID0gbmV3IGdvb2dsZS5tYXBzLk1hcChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbWFwLWNhbnZhcycpLCBtYXBPcHRpb25zKTtcblxuICAgIHZhciBzdHlsZWRNYXBPcHRpb25zID0geyBuYW1lOiAnQ3VzdG9tIFN0eWxlJyB9O1xuXG4gICAgdmFyIGN1c3RvbU1hcFR5cGUgPSBuZXcgZ29vZ2xlLm1hcHMuU3R5bGVkTWFwVHlwZShmZWF0dXJlT3B0cywgc3R5bGVkTWFwT3B0aW9ucyk7XG5cbiAgICBtYXAubWFwVHlwZXMuc2V0KE1ZX01BUFRZUEVfSUQsIGN1c3RvbU1hcFR5cGUpO1xuICAgIFxuICAgIHZhciBjb29yZGluYXRlcyA9IG5ldyBBcnJheSgpO1xuXG4gIFx0JCgnLmNvdW50cmllcycpLmNoaWxkcmVuKFwibGlcIikuZWFjaChmdW5jdGlvbihpbmRleCwgZWxlbWVudCkge1xuXHRcdHZhciB2ZW51ZSA9IHRoaXM7XG5cdFx0Ly9jb25zb2xlLmxvZyh0aGlzKTtcblx0XHR2YXIgdmVudWVJRCA9IHZlbnVlLmlkO1xuXHRcdC8vdmFyIHRpdGxlID0gJCh0aGlzKS5kYXRhKFwidGl0bGVcIik7XG5cdFx0dmFyIGxhdCA9ICQodGhpcykuZGF0YShcImxhdFwiKTtcblx0XHR2YXIgbG5nID0gJCh0aGlzKS5kYXRhKFwibG5nXCIpO1xuXHRcdC8vdmFyIGFkZHJlc3MgPSAkKHRoaXMpLmRhdGEoXCJhZGRyZXNzXCIpO1xuXHRcdC8vdmFyIHZlbnVlTGF0TG5nO1xuXHRcdFxuXHRcdGNvb3JkaW5hdGVzLnB1c2goW3ZlbnVlSUQsIFtsYXQsIGxuZ11dKTtcblx0fSk7XHRcblxuICAgIHZhciBtYXJrZXJzID0gbmV3IEFycmF5KCk7XG4gICAgIFxuXG5cdCBmb3IgKHZhciBpID0gMDsgaSA8IGNvb3JkaW5hdGVzLmxlbmd0aDsgaSsrKXtcbiAgICAgXHRtYXJrZXIgPSBuZXcgZ29vZ2xlLm1hcHMuTWFya2VyKHtcblx0XHRcdHBvc2l0aW9uOiBuZXcgZ29vZ2xlLm1hcHMuTGF0TG5nKGNvb3JkaW5hdGVzW2ldWzFdWzBdLCBjb29yZGluYXRlc1tpXVsxXVsxXSksXG5cdCAgICBcdG1hcDogbWFwLFxuXHQgICAgXHRkcmFnZ2FibGU6IGZhbHNlLFxuXHQgICAgXHRjbGlja2FibGU6IHRydWUsXG5cdFx0XHRhbmltYXRpb246IGdvb2dsZS5tYXBzLkFuaW1hdGlvbi5EUk9QLFxuXHQgICAgXHR0aXRsZTogY29vcmRpbmF0ZXNbaV1bMF0gXHQgXG5cdFx0fSk7IFxuXG4gICAgICAgIG1hcmtlcnMucHVzaChtYXJrZXIpOyBcblxuXHRcdGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcmtlcnNbaV0sICdjbGljaycsIGZ1bmN0aW9uIChtb3VzZUV2ZW50KSB7XG5cdFx0XHR3aW5kb3cubG9jYXRpb24uaHJlZiA9ICdjb3VudHJpZXMvc2hvdy8nK3RoaXMudGl0bGU7XG5cdFx0fSk7ICAgICAgICAgIFxuXHR9ICAgICBcblx0XHRcbiAgICAvL2h0dHA6Ly9nbWFwcy1zYW1wbGVzLXYzLmdvb2dsZWNvZGUuY29tL3N2bi90cnVuay9jb3VudHJ5X2V4cGxvcmVyL2NvdW50cnlfZXhwbG9yZXIuaHRtbFxuICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcCwgJ2NsaWNrJywgZnVuY3Rpb24gKG1vdXNlRXZlbnQpIHtcbiAgICAgIGdlb2NvZGVyLmdlb2NvZGUoXG4gICAgICAgIHsnbGF0TG5nJzogbW91c2VFdmVudC5sYXRMbmd9LFxuICAgICAgICBmdW5jdGlvbiAocmVzdWx0cywgc3RhdHVzKSB7XG4gICAgICAgICAgLy8gdmFyIGhlYWRpbmdQID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvdW50cnknKTtcbiAgICAgICAgICBpZiAoc3RhdHVzID09IGdvb2dsZS5tYXBzLkdlb2NvZGVyU3RhdHVzLk9LKSB7XG4gICAgICAgICAgICB2YXIgY291bnRyeSA9IGdldENvdW50cnkocmVzdWx0cyk7XG4gICAgICAgICAgICB2YXIgbWF0Y2hpbmdDb3VudHJ5TGluayA9ICQoJy5uYXYyIGEnKS5maWx0ZXIoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgdmFyIGNvdW50cnlOYW1lID0gJCh0aGlzKS5kYXRhKCdnb29nbGVuYW1lJyk7XG4gICAgICAgICAgICByZXR1cm4gY291bnRyeU5hbWUgPT09IGNvdW50cnkubG9uZ19uYW1lO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICBpZiAobWF0Y2hpbmdDb3VudHJ5TGluay5sZW5ndGggPT09IDEpIHtcbiAgICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSBtYXRjaGluZ0NvdW50cnlMaW5rLmF0dHIoJ2hyZWYnKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIC8vY29uc29sZS5sb2coY291bnRyeS5sb25nX25hbWUgKyAnIG5vdCBmb3VuZCBpbiBDb3VudHJpZXMgbGlzdC4nKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgICk7XG4gICAgfSk7XG5cblxuICAgIHNldERyYWdnYWJsZShtYXApO1xuXG4gICAgJCh3aW5kb3cpLm9uKCdyZXNpemUnLCBmdW5jdGlvbiAoKSB7XG4gICAgICBzZXREcmFnZ2FibGUobWFwKTtcbiAgICB9KTtcbiAgfSk7XG59XG5cbmdvb2dsZS5tYXBzLmV2ZW50LmFkZERvbUxpc3RlbmVyKHdpbmRvdywgJ2xvYWQnLCBpbml0aWFsaXplKTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJyNtYXAtY2FudmFzLW5vdGljZSBidXR0b24nLCBmdW5jdGlvbiAoKSB7XG4gICQoJyNtYXAtY2FudmFzLW5vdGljZSA+IGRpdicpLmZhZGVPdXQoeyBkdXJhdGlvbjogMTAwIH0pO1xuICAkKCcjbWFwLWNhbnZhcy1ub3RpY2UnKS5mYWRlT3V0KHsgZHVyYXRpb246IDIwMCB9KTtcbn0pO1xuXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCAnLmdyaWQtaXRlbScsIGZ1bmN0aW9uICgpIHtcbiAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSAkKHRoaXMpLmZpbmQoJ2EnKS5hdHRyKCdocmVmJyk7XG59KTtcblxuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJ21hcmtlcicsIGZ1bmN0aW9uICgpIHtcbiAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSAkKHRoaXMpLmZpbmQoJ2EnKS5hdHRyKCdocmVmJyk7XG59KTtcblxuXG4kKGRvY3VtZW50KS5vbignbW91c2VvdmVyJywgJy5ncmlkLWl0ZW0nLCBmdW5jdGlvbiAoKSB7XG4gICQodGhpcykuZmluZCgnYScpLmFkZENsYXNzKCdob3ZlcicpO1xufSk7XG5cbiQoZG9jdW1lbnQpLm9uKCdtb3VzZW91dCcsICcuZ3JpZC1pdGVtJywgZnVuY3Rpb24gKCkge1xuICAkKHRoaXMpLmZpbmQoJ2EnKS5yZW1vdmVDbGFzcygnaG92ZXInKTtcbn0pO1xuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG4gIGlmICgoL1xcL2NvdW50cmllcyhcXC8pPy8pLnRlc3QoIHdpbmRvdy5sb2NhdGlvbi5wYXRobmFtZSApKSB7XG4gICAgJCgnI2Zvb3RlcicpLmNzcygnbWFyZ2luLWxlZnQnLCAwKVxuICAgICAgICAgICAgICAgIC5jc3MoJ21hcmdpbi1yaWdodCcsIDApXG4gICAgICAgICAgICAgICAgLmFkZENsYXNzKCdwYWRkZWQnKTtcbiAgfVxufSk7XG5cblxuXG5mdW5jdGlvbiBzZXREcmFnZ2FibGUgKG1hcCkge1xuICB2YXIgZHJhZ2dhYmxlID0gd2luZG93Lm91dGVyV2lkdGggPiA3Njg7XG5cbiAgdmFyIG9wdGlvbnMgPSB7XG4gICAgZHJhZ2dhYmxlOiBkcmFnZ2FibGUsXG4gICAgcGFuQ29udHJvbDogZHJhZ2dhYmxlLFxuICAgIHNjcm9sbHdoZWVsOiBmYWxzZVxuICB9O1xuXG4gIG1hcC5zZXRPcHRpb25zKG9wdGlvbnMpO1xufVxuIl0sImZpbGUiOiJzY3JpcHQuanMifQ==
