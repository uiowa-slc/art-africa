<div class="media-grid-container">
	<ul>
		<% loop ArtPhotos %>
		<li><a href="#"><img src={$Picture.CroppedImage(125,125).Filename} /></a></li>
		<% end_loop %>
	</ul>
</div>