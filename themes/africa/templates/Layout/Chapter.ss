<div class="content-container typography">
	<article>
		<h1>$Title</h1>
		<% if Author %>
			<h2>By $Author
				<% if University %><br />$University<% end_if %>
			</h2>
		<% end_if %>
		<% include EssayPages %>
	</article>

	<% if Images %> 
		<% include SmallImageScroller %>
	<% end_if %>
	<% with Children.First %><p><a href="$Link">Start with $Title</a></p><% end_with %>
	<div class="visible-phone">
		Subtopics:<br><br>
		<% loop Children %>
			<a href="{$Link}">$Title<br></a>
		<% end_loop %>
	</div>
</div>

<% include SideBar %>
