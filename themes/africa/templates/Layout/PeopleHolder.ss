<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		$Content
		<% loop getObjects('People') %>
			<% if Title %>
				<li><a href="$Link">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>