<div class="content-container typography">
	<article>
		<h1>$Title</h1>
		<% if Author %><h3>By $Author</h3><% end_if %>
		<% if University %><h3>$University</h3><% end_if %>
		<% include EssayPages %>
	</article>

	<% if Images %> 
		<% include SmallImageScroller %>
	<% end_if %>
	<div>
		Subtopics:<br><br>
		<% loop Children %>
			<a href="{$Link}">$Title<br></a>
		<% end_loop %>
	</div>
</div>

<% include SideBar %>
