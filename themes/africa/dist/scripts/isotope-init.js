$( document ).ready(function() {

   var $container = $('.media-container');

    $container.imagesLoaded(function(){
      $container.isotope({
        itemSelector: '.item',

        masonry: {
        	columnWidth: 295,
    		gutterWidth: 0
  		}
      });
      
    });

$container.infinitescroll({
      navSelector  : '#pagination',    // selector for the paged navigation
      nextSelector : '.next',  // selector for the NEXT link (to page 2)
      itemSelector : '.item',     // selector for all items you'll retrieve
      bufferPx: 300,
	 debug        : false,
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Isotope as a callback
      function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
           $('.artPhoto').magnificPopup({
              type: 'image',
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
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
      	 $container.isotope( 'appended', $( newElements ) ); 

		});
    }
    );

});