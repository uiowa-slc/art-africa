$(function(){

   var $container = $('#media-container');

    $container.imagesLoaded(function(){
      $container.isotope({
        itemSelector: '.item',

        masonry: {
        	columnWidth: 210,
    		gutterWidth: 5
  		}
      });
      
    });

$container.infinitescroll({
      navSelector  : '#pagination',    // selector for the paged navigation
      nextSelector : '.next',  // selector for the NEXT link (to page 2)
      itemSelector : '.item',     // selector for all items you'll retrieve
      bufferPx: 100,
	 debug        : true,
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){

      	 $container.isotope( 'appended', $( newElements ) ); 
		});
    }
    );

});