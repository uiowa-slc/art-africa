<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		<% loop getArtPhotos %>
			<% if Name %>
				<li><a href="photos/show/{$ID}">$Name</a></li>
			<% else_if Title %>
				<li><a href="photos/show/{$ID}">$Title</a></li>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>