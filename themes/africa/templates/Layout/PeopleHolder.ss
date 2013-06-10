<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		<% loop getPeople %>
			<% if Name %>
				<li><a href="peoples/show/{$ID}">$Name</a></li>
			<% else_if Title %>
				<li><a href="peoples/show/{$ID}">$Title</a></li>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>