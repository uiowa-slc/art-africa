<script src="{$ThemeDir}/javascript/masonry.pkgd.min.js"></script>
<script src="{$ThemeDir}/javascript/jquery.lazyload.js"></script>

<style>

</style>
<div class="content-container typography">
	<h1>Art Photos</h1>
 	<div id="media-container" class="fluid">
 		<div class="js-masonry" data-masonry-options='{ "itemSelector": ".item", "columnWidth": 200, "gutter": 10 }'>
 		<% loop $getArtPhotos %>
 			<div class="item">

	 			$Picture.SetWidth(200)

 			</div>
 		<% end_loop %>
 		</div>
 	</div>
</div>

<script type="text/javascript">
  $('.open-glossary-popup').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });
</script>

<%# include SideBar %>

<script type="text/javascript">

	var container = document.querySelector('#media-container');
	var msnry = new Masonry( container, {
	  // options...
	  itemSelector: '.item',
	  columnWidth: 200
	});
	/*var $container = $('#media-container');
	$container.imagesLoaded(function(){
	    $container.masonry({
	        itemSelector: '.item',
	        columnWidth: function(containerWidth){
	            return containerWidth / 12;
	        }
	    });
	    $('.item img').lazyload({
	        effect: 'fadeIn'
	    });
	    $('.item img').trigger('scroll');
	});	*/
</script>