<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		<% loop getEssays %>
			<% if Name %>
				<li><a href="essays/show/{$ID}">$Name</a></li>
			<% else_if Title %>
				<li><a href="essays/show/{$ID}">$Title</a></li>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>