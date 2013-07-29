/*	var container = document.querySelector('#media-container');
	var msnry = new Masonry( container, {
	  // options...
	  itemSelector: '.item',
	  columnWidth: 200
	});*/
	
jQuery.ias({
	    container : '#media-container',
	    item: '.item',
	    pagination: '#pagination',
	    next: '.pager-item .next',
	    loader: '<img src="themes/africa/images/loader.gif"/>',
	    onLoadItems: function(items) {
	        // hide new items while they are loading
	        var $newElems = $(items).show().css({ opacity: 0 });
	        // ensure that images load before adding to masonry layout
	        $newElems.imagesLoaded(function(){
	          // show elems now they're ready
	        $newElems.animate({ opacity: 1 });
	        $container.masonry( 'appended', $newElems, true );
	        });
	        return true;
	    }
	});