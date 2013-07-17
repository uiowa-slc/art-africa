<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		$Content
		<% loop getObjects('Essay') %>
			<% if Title %>
				<li><a href="$Link(false)">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>