<div class="content-container typography">	
	<article>
		<h1 class="hidden-tablet hidden-phone">$Title</h1>
		<div class="content">
			$Content
			<div class="table-responsive ">
			  <table class="table table-hover table-condensed peoples-table">
			    <tbody>
			    	<tr>
			    		<th>Name</th>
			    		<th>Countries</th>
			    		<th>Population</th>
			    	</tr>
			    <% loop getPeople %>
					<% if Title %>
					<tr>
			    		<td><a href="$Link(false)">$Title</a></td>
			    		<td><% loop Countries %>
						<a href="$Link(false)">$Title</a><% if not $Last %>, <% end_if %>
					<% end_loop %></td>
						<td>$Population</td>
			    	</tr>
					
					<% end_if %>
				<% end_loop %>

			    </tbody>

			  </table>
			</div>
		</div>
	</article>
</div>

<% include SideBar %>
