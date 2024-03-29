<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content

		
			Author: $Author<br><br>
			DateWritten: $DateWritten<br><br>
			University: $University<br><br>
			Consultant: $Consultant<br><br>
			Title: $Title<br><br>
			Source: $Source<br><br>
			Bibliography: $Bibliography<br><br>
			Tags: $Tags<br><br>
			
			
			People
			<% loop People %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
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