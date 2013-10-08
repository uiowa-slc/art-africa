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
    	
 		<% loop $getResults %>
 			<div class="item">
 				<% if $ClassName == "Image" %>
 					<% include MediaGridImage %>
 				<% else_if $ClassName == "AudioPiece" %>
 					<% include AudioPiece %>
 				<% else_if $ClassName == "VideoPiece" %>
 					<% include VideoPiece %>

 				<% end_if %>
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


