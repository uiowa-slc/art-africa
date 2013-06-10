<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content

		
			Name: $Name<br><br>
			Location: $Location<br><br>
			DateOfIndependence: $DateOfIndependence<br><br>
			Nationality: $Nationality<br><br>
			CapitalCity: $CapitalCity<br><br>
			Population: $Population<br><br>
			ImportantCities: $ImportantCities<br><br>
			HeadOfState: $HeadOfState<br><br>
			Area: $Area<br><br>
			TypeOfGovernment: $TypeOfGovernment<br><br>
			Currency: $Currency<br><br>
			MajorPeoples: $MajorPeoples<br><br>
			Religion: $Religion<br><br>
			Climate: $Climate<br><br>
			Literacy: $Literacy<br><br>
			OfficialLanguage: $OfficialLanguage<br><br>
			PrincipalLanguage: $PrincipalLanguage<br><br>
			MajorExports: $MajorExports<br><br>
			PrecolonialHistory: $PrecolonialHistory<br><br>
			PostcolonialHistory: $PostcolonialHistory<br><br>
			<br>
			
			People
			<% loop People %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			
			Essays
			<% loop Essays %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			Subtopics
			<% loop Subtopics %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			VideoPieces
			<% loop VideoPieces %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			AudioPieces
			<% loop AudioPieces %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			ArtPhotos
			<% loop ArtPhotos %>
				$Title<br>
			<% end_loop %>
			<br><br>
			
			FieldPhotos
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