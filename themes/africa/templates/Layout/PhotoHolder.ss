<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		Art Photos <br><br>
		<% loop getObjects('ArtPhoto') %>
			<% if Title %>
				<li><a href="{$Up.getHolderLink('AudioHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		Field Photos <br><br>
		<% loop getObjects('FieldPhoto') %>
			<% if Title %>
				<li><a href="{$Up.getHolderLink('AudioHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>