<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<h2>Images:</h2>
			$Image.SetWidth(300)
		<h2>Keywords:</h2>
			<% loop $SplitKeywords %><a href="{$Link}">$Keyword</a><% if Last %> <% else %>,<% end_if %> <% end_loop %>
		<h2>Subtopics:</h2>
			<% loop Subtopics %>
				<p><a href="$Link">$Title</a> | <% with Parent %><a href="$Link">$Title</a><% end_with %></p>
			<% end_loop %>
	</article>
		$Form
		$PageComments
</div>
<% include SideBar %>