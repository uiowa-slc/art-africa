<style>
.lazy {
  display: none;
}
.item {
	margin-bottom: 10px;
}
</style>


<div class="content-container typography" style="/*min-height: 3000px*/" >
 	<div id="media-container">
    <!--<div class="row-fluid media-row" data-columns> -->
 		<% loop $getImages %>
 			<div class="item">
<a href="{$PopupLink}" class="artPhoto mfp-iframe" title="hello"><img src="{$SetWidth(200).URL}" /></a>
 			</div>
 		<% end_loop %>
   <!-- </div> -->
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


