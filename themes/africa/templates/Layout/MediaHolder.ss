<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		Videos <br><br>
		<% loop getObjects('VideoPiece') %>
			<% if Title %>
				<li><a href="{$Up.getHolderLink('VideoPieceHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		Audio <br><br>
		<% loop getObjects('AudioPiece') %>
			<% if Title %>
				<li><a href="{$Up.getHolderLink('AudioPieceHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		Art Photos <br><br>
		<% loop getObjects('ArtPhoto') %>
			<% if Title %>
				<li><a href="{$Up.getHolderLink('ArtPhotoHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		Field Photos <br><br>
		<% loop getObjects('FieldPhoto') %>
			<% if Title %>
				<li><a href="{$Up.getHolderLink('FieldPhotoHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>

<% include SideBar %>