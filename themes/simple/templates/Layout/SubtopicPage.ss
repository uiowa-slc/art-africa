<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<h2>Collection Items associated with this topic:</h2>
		<% loop CollectionPieces %>
			<h3><a href="$Link">$Title</a></h3>
		<% end_loop %>
	</article>
		$Form
		$PageComments
</div>
<% include SideBar %>