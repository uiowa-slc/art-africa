<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content

		   
			Name: $Name<br><br>
			Photo: $PhotoID<br><br>
			Photographer: $Photographer<br><br>
			Description: $Description<br><br>
			Date: $Date<br><br>
			Location: $Location<br><br>
			CreditLine: $CreditLine<br><br>
			TraditionalName: $TraditionalName<br><br>
			Material: $Material<br><br>
			Size: $Size<br><br>
			Function: $Function<br><br>
			Style: $Style<br><br>
			Substyle: $Substyle<br><br>
			Collection: $Collection<br><br>
			Source: $Source<br><br>
			Tags: $Tags<br><br>
			
			<br>
			
			People:
			<% loop People %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			
			Essays:
			<% loop Essays %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			Subtopics:
			<% loop Subtopics %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			VideoPieces:
			<% loop VideoPieces %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			AudioPieces:
			<% loop AudioPieces %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			
			FieldPhotos:
			<% loop FieldPhotos %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			Image<br><br> 
			$Picture
			
			
			
	
		</div>
	</article>
		
</div>
<% include SideBar %>