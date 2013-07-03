<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		

		<div class="content">$Content

			<h2>Facts about $Title</h2>
			<h3>Location</h3>
			<p>$Location</p>
			<h3>Countries Associated With $Title</h3>
			<ul>
				<% loop Countries %>
					<li><a href="$Link">$Title</a></li>
				<% end_loop %>
			</ul>
			<h3>Languages</h3>
			<p>$filteredField("Languages", $ID, "People")</p>
			<h3>Population</h3>
			<p>$Population</p>
			<h3>Types of Art</h3>
			<p>$TypesOfArt</p>
			<h3>History</h3>
			<p>$History</p>
			<h3>Economy</h3>
			<p>$Economy</p>
			<h3>Political Systems</h3>
			<p>$PoliticalSystems</p>
			<h3>Religion</h3>
			<p>$Religion</p>
			<h3>Tags</h3>
			<p>$Tags</p>

						
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
			
		</div>
	</article>
		
</div>
<% include SideBar %>

