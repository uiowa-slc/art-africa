<div class="content-container typography">
	<article>
		<h1>$Title</h1>
		<% if $CoverImage %>
		<img src="$CoverImage.URL" class="full-width" alt="">
		<% end_if %>
		<h2>Introduction</h2>
		<% include EssayPages %>
		<div>
			Name: $Name<br><br>
			Description: $Description<br><br>
			Tags: $Tags<br><br>
		</div>
	</article>
	Subtopics:<br><br>
	<% loop Children %>
		<a href="{$Link}">$Title<br></a>
	<% end_loop %>
	<br><br>
	
</div>

<%# include SideBar %>
