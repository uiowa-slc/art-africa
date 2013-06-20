<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content

					
			Name: $Name<br><br>
			Location: $Location<br><br>
			Languages: $filteredField("Languages", $ID, "People")<br><br>
			Population: $Population<br><br>
			TypesOfArt: $TypesOfArt<br><br>
			History: $History<br><br>
			Economy: $Economy<br><br>
			Political Systems: $PoliticalSystems<br><br>
			Religion: $Religion<br><br>
			Tags: $Tags<br><br>
			
						
			Audio Pieces
			<% loop AudioPieces %>
				$Name<br>
			<% end_loop %>
			<br><br><br>
			Subtopics
			<% loop Subtopics %>
				$Name<br>
			<% end_loop %>
			<br><br><br>
			Video Pieces
			<% loop VideoPieces %>
				$Name<br>
			<% end_loop %>
			<br><br><br>
			Countries
			<% loop Countries %>
				$Name<br>
			<% end_loop %>
			<br><br><br>
			ArtPhotos
			<% loop ArtPhotos %>
				$Name<br>
			<% end_loop %>
			<br><br><br>
			FieldPhotos
			<% loop FieldPhotos %>
				$Name<br>
			<% end_loop %>
			
			<br><br><br>
			
	
		</div>
	</article>
		
</div>
<% include SideBar %>

