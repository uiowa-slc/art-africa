<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		Art Photos <br><br>
		<% loop getArtPhotos %>
			<% if Name %>
				<li><a href="photos/show/{$ID}">$Name</a></li><br>
			<% else_if Title %>
				<li><a href="photos/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		Field Photos <br><br>
		<% loop getFieldPhotos %>
			<% if Name %>
				<li><a href="photos/show/{$ID}">$Name</a></li><br>
			<% else_if Title %>
				<li><a href="photos/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>