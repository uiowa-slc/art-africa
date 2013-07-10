<div class="content-container typography">
	<article>
		<h1>$Title</h1>
		<img src="{$ThemeDir}/images/homepage-pic.jpg" class="full-width" alt="">
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
