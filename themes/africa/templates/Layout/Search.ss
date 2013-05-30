<div class="content-container typography">	
	<h2> Search Query: $Query</h2>
	
	<section class="search-results">
		<ul>
			<% loop Pages %>
				<li><a href="$Link">$Title</a></li>
		
			<% end_loop %>
		</ul>
		<br>Data Objects<br>
		<ul>
			<% loop DataObjects %>
					<% if Name %>
						<li><a href="$Link">$Name</a></li>
					<% else_if Title %>
						<li><a href="$Link">$Title</a></li>
					<% end_if %>

			<% end_loop %>
		</ul>		
	</section>
</div>
<% include SideBar %>