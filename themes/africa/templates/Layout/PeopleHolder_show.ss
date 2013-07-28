<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		

		<div class="content container-fluid">
		
			$Content
			
			<div class="row-fluid">
				<div class="span8">
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
				</div>
				
				<div class="span4 sticky">
					<h2>Facts about $Title</h2>
					<h3>Location</h3>
					<p>$Location</p>
					<h3>Countries</h3>
					<ul>
						<% loop Countries %>
							<li><a href="$Link">$Title</a></li>
						<% end_loop %>
					</ul>
					<h3>Languages</h3>
					<p>$filteredField("Languages", $ID, "People")</p>
					<h3>Population</h3>
					<p>$Population</p>
					<h3>Tags</h3>
					<p>$Tags</p>	
					<h3>Media</h3>
					<p><a href="#media">View All $Title Media</a></p>		
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12 art-photo-grid" id="media">
			
				<h2>Art</h2>
				<% include ImageGrid %>
				<!--
				<h3>Audio Pieces</h3>
				<ul>
				<% loop AudioPieces %>
					<li>$Name</li>
				<% end_loop %>
				</ul>
				<h3>Video Pieces</h3>
				<ul>
				<% loop VideoPieces %>
					<li>$Name</li>
				<% end_loop %>
				</ul>
								
				</div>
				
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
				<% end_loop %>-->
			
		</div>
	</article>
		
</div>
<% include SideBar %>

