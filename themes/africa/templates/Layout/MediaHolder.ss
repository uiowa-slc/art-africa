<style>
.lazy {
  display: none;
}
.item {
	margin-bottom: 10px;
}
</style>


<div class="content-container typography">
 	<div id="media-container" class="fluid">
 		<div class="js-masonry">
 		<% loop $getImages %>
 			<div class="item">
<img src="{$SetWidth(200).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="Tap or click the image for more info. {$CreditLine}" data-mfp-href="{$ShowLink}" />
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

<%# include SideBar %>


