<style>
.lazy {
  display: none;
}
.item {
	margin-bottom: 10px;
}
</style>


<div class="content-container typography" style="/*min-height: 3000px*/" >
 	
 		<% if not $getResults %>
 		<h3> Sorry, no results matched that filter! </h3>
 		<% end_if %>

 	<div id="media-container">
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


