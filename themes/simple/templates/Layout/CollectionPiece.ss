<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<h2>Images:</h2>
			$Image
		<h2>Keywords:</h2>
			<% loop $SplitKeywords %><a href="{$Link}">$Keyword</a><% if Last %> <% else %>,<% end_if %> <% end_loop %>
	</article>
		$Form
		$PageComments
</div>
<% include SideBar %>