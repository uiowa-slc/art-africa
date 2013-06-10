<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		Videos <br><br>
		<% loop getVideos %>
			<% if Name %>
				<li><a href="art-photos/show/{$ID}">$Name</a></li><br>
			<% else_if Title %>
				<li><a href="art-photos/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		Audio <br><br>
		<% loop getAudio %>
			<% if Name %>
				<li><a href="field-photo-holder/show/{$ID}">$Name</a></li><br>
			<% else_if Title %>
				<li><a href="field-photo-holder/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>