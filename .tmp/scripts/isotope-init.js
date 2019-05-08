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
         observer.observe();

		});
    }
    );

});
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJpc290b3BlLWluaXQuanMiXSwic291cmNlc0NvbnRlbnQiOlsiJCggZG9jdW1lbnQgKS5yZWFkeShmdW5jdGlvbigpIHtcblxuICAgdmFyICRjb250YWluZXIgPSAkKCcubWVkaWEtY29udGFpbmVyJyk7XG5cbiAgICAkY29udGFpbmVyLmltYWdlc0xvYWRlZChmdW5jdGlvbigpe1xuICAgICAgJGNvbnRhaW5lci5pc290b3BlKHtcbiAgICAgICAgaXRlbVNlbGVjdG9yOiAnLml0ZW0nLFxuXG4gICAgICAgIG1hc29ucnk6IHtcbiAgICAgICAgXHRjb2x1bW5XaWR0aDogMjk1LFxuICAgIFx0XHRndXR0ZXJXaWR0aDogMFxuICBcdFx0fVxuICAgICAgfSk7XG4gICAgICBcbiAgICB9KTtcblxuJGNvbnRhaW5lci5pbmZpbml0ZXNjcm9sbCh7XG4gICAgICBuYXZTZWxlY3RvciAgOiAnI3BhZ2luYXRpb24nLCAgICAvLyBzZWxlY3RvciBmb3IgdGhlIHBhZ2VkIG5hdmlnYXRpb25cbiAgICAgIG5leHRTZWxlY3RvciA6ICcubmV4dCcsICAvLyBzZWxlY3RvciBmb3IgdGhlIE5FWFQgbGluayAodG8gcGFnZSAyKVxuICAgICAgaXRlbVNlbGVjdG9yIDogJy5pdGVtJywgICAgIC8vIHNlbGVjdG9yIGZvciBhbGwgaXRlbXMgeW91J2xsIHJldHJpZXZlXG4gICAgICBidWZmZXJQeDogMzAwLFxuXHQgZGVidWcgICAgICAgIDogZmFsc2UsXG4gICAgICBsb2FkaW5nOiB7XG4gICAgICAgICAgZmluaXNoZWRNc2c6ICdObyBtb3JlIHBhZ2VzIHRvIGxvYWQuJyxcbiAgICAgICAgICBpbWc6ICdodHRwOi8vaS5pbWd1ci5jb20vNlJNaHguZ2lmJ1xuICAgICAgICB9XG4gICAgICB9LFxuICAgICAgLy8gdHJpZ2dlciBJc290b3BlIGFzIGEgY2FsbGJhY2tcbiAgICAgIGZ1bmN0aW9uKCBuZXdFbGVtZW50cyApIHtcbiAgICAgICAgdmFyICRuZXdFbGVtcyA9ICQoIG5ld0VsZW1lbnRzICkuY3NzKHsgb3BhY2l0eTogMCB9KTtcbiAgICAgICAgICAgJCgnLmFydFBob3RvJykubWFnbmlmaWNQb3B1cCh7XG4gICAgICAgICAgICAgIHR5cGU6ICdpbWFnZScsXG4gICAgICAgICAgICAgIGdhbGxlcnk6IHtcbiAgICAgICAgICAgICAgICBlbmFibGVkOiB0cnVlLFxuICAgICAgICAgICAgICAgIG5hdmlnYXRlQnlJbWdDbGljazogZmFsc2VcbiAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgY2FsbGJhY2tzOiB7XG4gICAgICAgICAgICAgICAgb3BlbjogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgICAkKCcudG9wLWxpbmsnKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgICBwb3BwaW5nVXAgPSB0cnVlO1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgY2xvc2U6IGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgICBwb3BwaW5nVXAgPSBmYWxzZTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICAvLyBlbnN1cmUgdGhhdCBpbWFnZXMgbG9hZCBiZWZvcmUgYWRkaW5nIHRvIG1hc29ucnkgbGF5b3V0XG4gICAgICAgICRuZXdFbGVtcy5pbWFnZXNMb2FkZWQoZnVuY3Rpb24oKXtcbiAgICAgIFx0ICRjb250YWluZXIuaXNvdG9wZSggJ2FwcGVuZGVkJywgJCggbmV3RWxlbWVudHMgKSApOyBcbiAgICAgICAgIG9ic2VydmVyLm9ic2VydmUoKTtcblxuXHRcdH0pO1xuICAgIH1cbiAgICApO1xuXG59KTsiXSwiZmlsZSI6Imlzb3RvcGUtaW5pdC5qcyJ9
