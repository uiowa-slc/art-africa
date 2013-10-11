<div class="content-container typography">
	<article>
		<h1>$Title</h1>

		<% if Author %><h3>by $Author</h3><% end_if %>
		<% if University %><h3>$University</h3><% end_if %>
		

		<!--
		<% if $CoverImage %>
		<img src="$CoverImage.URL" class="full-width" alt="">
		<% end_if %>-->
		<% if Images %> 
		<% include LargeImageScroller %>
		<% end_if %>
		<h2>Introduction</h2>
		<h3>Written by: $Author</h3>
		<h3>Institution:  $University</h3>
		<% include EssayPages %>
		<div>
		<!--
			Name: $Name<br><br>
			Description: $Description<br><br>
			Tags: $Tags<br><br>-->
		</div>
	</article>
	Subtopics:<br><br>
	<% loop Children %>
		<a href="{$Link}">$Title<br></a>
	<% end_loop %>
	
	<br><br>
	
</div>

<% include SideBar %>
