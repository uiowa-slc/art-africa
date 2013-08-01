
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
 		<div class="js-masonry">
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
 	<% include SmallImageScroller %>
</div>

<script type="text/javascript">
  $('.open-glossary-popup').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });
</script>

<script src="{$ThemeDir}/javascript/masonry.pkgd.min.js"></script>
<script src="{$ThemeDir}/javascript/imagesloaded.js"></script>
<!--<script src="{$ThemeDir}/javascript/jquery-ias.js"></script>
<script src="{$ThemeDir}/javascript/ias-init.js"></script>-->

<script src="{$ThemeDir}/javascript/jquery.infinitescroll.min.js"></script>
<script src="{$ThemeDir}/javascript/infinite-init.js"></script>


<%# include SideBar %>


