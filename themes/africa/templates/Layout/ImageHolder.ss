<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		Art Photos <br><br>
		<% loop getArtPhotos %>
			<% if Title %>
				<li><a href="images/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		Field Photos <br><br>
		<% loop getFieldPhotos %>
			<% if Title %>
				<li><a href="images/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		HI!
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>
