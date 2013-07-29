
<style>
.lazy {
  display: none;
}
.item {
	margin-bottom: 10px;
}
</style>


<div class="content-container typography">
	<h1>Imagery</h1>
 	<div id="media-container" class="fluid">
 		<div class="js-masonry" data-masonry-options='{ "itemSelector": ".item", "columnWidth": 200, "gutter": 10 }'>
 		<% loop $getImages %>
 			<div class="item">
 				<% with $SetWidth(200) %>
	 			<img class="lazy" data-original="$URL" src="{$ThemeDir}/images/blank.gif" width=$Width height=$Height />
	 			<% end_with %>
	 			$SetWidth(200)

 			</div>
 		<% end_loop %>
 		</div>
 	</div>
 	<% include LargeImageGridPagination %>
</div>

<script type="text/javascript">
  $('.open-glossary-popup').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });
</script>
<!--<script src="{$ThemeDir}/javascript/masonry.pkgd.min.js"></script>-->
<script src="{$ThemeDir}/javascript/jquery.lazyload.js"></script>
<script src="{$ThemeDir}/javascript/jquery-ias.js"></script>


<link rel="stylesheet" type="text/css" href="{$ThemeDir}/css/jquery.ias.css" />
<script type="text/javascript">

	var container = document.querySelector('#media-container');
	/*var msnry = new Masonry( container, {
	  // options...
	  itemSelector: '.item',
	  columnWidth: 200
	});*/
	

	//$("img.lazy").lazyload();
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
<script src="{$ThemeDir}/javascript/ias-init.js"></script>

<%# include SideBar %>


