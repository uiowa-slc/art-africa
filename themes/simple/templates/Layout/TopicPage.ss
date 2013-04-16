<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<% control Children %>
			<h2><a href="$Link">$Title</a></h2>
			<p>Collection Pieces: <a href="$Link">$CollectionPieces.Count</a></p>
		<% end_control %>
	</article>
		$Form
		$PageComments
</div>
<% include SideBar %>