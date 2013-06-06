<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content

					
			Name: $Name<br><br>
			Location: $Location<br><br>
			Languages: $Languages<br><br>
			Population: $Population<br><br>
			TypesOfArt: $TypesOfArt<br><br>
			History: $History<br><br>
			Economy: $Economy<br><br>
			Political Systems: $PoliticalSystems<br><br>
			Religion: $Religion<br><br>
			Tags: $Tags<br><br>
			
						
			Audio Pieces
			<% loop AudioPieces %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Subtopics
			<% loop Subtopics %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Video Pieces
			<% loop VideoPieces %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Countries
			<% loop Countries %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			ArtPhotos
			<% loop ArtPhotos %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			FieldPhotos
			<% loop FieldPhotos %>
				$Title<br>
			<% end_loop %>
			
			<br><br><br>
			
	
		</div>
	</article>
		
</div>
<% include SideBar %>