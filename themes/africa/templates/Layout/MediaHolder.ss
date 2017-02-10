<style>.lazy {
  display: none;
}
.item {
	margin-bottom: 10px;
}</style><div class="content-container typography"> <% if not $getResults %> <p>Sorry, no results matched that filter. Please modify or <a href="media/">clear all filters</a> and try again.</p> <% end_if %> <div class="media-container"> <% loop $getResults %> <div class="item $ID"> <% if $ClassName == "Image" %> <% include MediaGridImage %> <% else_if $ClassName == "AudioPiece" %> <% include AudioPiece %> <% else_if $ClassName == "VideoPiece" %> <% include VideoPiece %> <% end_if %> </div> <% end_loop %> </div> <% include LargeImageGridPagination %> </div>