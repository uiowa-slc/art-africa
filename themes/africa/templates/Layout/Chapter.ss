<div class="content-container typography">
	<article class="padded">
		<h1>$Title</h1>


		<h2>Introduction</h2>

		<% if Author %><h3>$Author</h3><% end_if %>
		<% if University %><h3>$University</h3><% end_if %>
		<% include EssayPages %>

	</article>

	<% if Images %> 
		<% include SmallImageScroller %>
	<% end_if %>
	<div class="padded">
		Subtopics:<br><br>
		<% loop Children %>
			<a href="{$Link}">$Title<br></a>
		<% end_loop %>
	</div>
</div>

<% include SideBar %>
