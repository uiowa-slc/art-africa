<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
			$Content

			<ul>
				<% loop getPeople %>
					<% if Title %>
						<li><a href="$Link(false)">$Title</a></li>
					<% end_if %>
				<% end_loop %>
			</ul>
		</div>
	</article>
</div>

<% include SideBar %>
