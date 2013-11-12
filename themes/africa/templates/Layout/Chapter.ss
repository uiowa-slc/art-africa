<div class="content-container typography">
	<article>
		<h1 class="padded">$Title</h1>


		<div class="padded">
		<h2>Introduction</h2>

		<% if Author %><h3>$Author</h3><% end_if %>
		<% if University %><h3>$University</h3><% end_if %>
		<% include EssayPages %>
		</div>

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
