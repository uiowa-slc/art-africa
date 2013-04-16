<div class="content-container typography">	
	<h2> Search Query: $Query</h2>
	
	<section class="search-results">
		<ul>
			<% loop Pages %>
				<li><a href="$Link">$Title</a></li>
			<% end_loop %>
		</ul>	
	</section>
</div>
<% include SideBar %>