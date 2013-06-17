<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content columns">
			$Content
		</div>
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
		$testDescription
</div> 
<% include SideBar %>
