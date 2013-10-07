<style>
.lazy {
  display: none;
}
.item {
	margin-bottom: 10px;
}
</style>


<div class="content-container typography" style="/*min-height: 3000px*/" >
 	
 		<% if not $getImages %>
 		<h3> Sorry, no results matched that filter! </h3>
 		<% end_if %>

 	<div id="media-container">
<!--<div class="row-fluid media-row" data-columns> -->

 		<% loop $getImages %>
 			<div class="item">
<img src="{$SetWidth(200).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="Tap or click for more info." data-mfp-href="{$ShowLink}" />
 			</div>
 		<% end_loop %>	


 	

<!--	</div>	-->
 		</div>
 	<% include LargeImageGridPagination %>
</div>

<script type="text/javascript">
  $('.open-glossary-popup').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });
</script>

<% include SideBar %>


