<div class="content-container typography map-page">	
	<article>
		<h1>$Title</h1>
		<div id="map-canvas"></div>
		<h2>Art</h2>
				<% include ArtPhotoGrid %>
		<div class="content container-fluid">
			$Content
			<!--$Picture -->
			<div class="row-fluid">
				<section class="country-info-container span6">
					<h2>Basic Info</h2>
					<h3>Capital</h3>
					<p>$CapitalCity</p>
					<h3>Population</h3>
					<p>$Population</p>
					<h3>Climate</h3>
					<p>$Climate</p>
					<h3>Currency</h3>
					<p>$Currency</p>
					<h3>Important Cities</h3>
					<p>$ImportantCities</p>
					<h3>Area</h3>
					<p>$Area</p>
				</section>

				<section class="country-info-container span6">
					<h2>People</h2>
					<h3>Nationality</h3>
					<p>$Nationality</p>
					<h3>Major Peoples</h3>
					<p>$MajorPeoples</p>
					<h3>Religion</h3>
					<p>$Religion</p>
					<h3>Literacy</h3>
					<p>$Literacy</p>
					<h3>Principal Language</h3>
					<p>$PrincipalLanguage</p>
					<h3>Official Language</h3>
					<p>$OfficialLanguage</p>
				</section>
			</div>
			<div class="row-fluid">
				<section class="country-info-container span12">
					<h2>Politics</h2>
					<h3>Head Of State</h3>
					<p>$HeadOfState</p>
					<h3>Type of Government</h3>
					<p>$TypeOfGovernment</p>
					<h3>Date of Independence</h3>
					<p>$DateOfIndependence</p>
					<h3>Major Exports</h3>
					<p>$MajorExports</p>
					<h3>Precolonial History</h3>
					<p>$PrecolonialHistory</p>
					<h3>Postcolonial History</h3>
					<p>$PostcolonialHistory</p>			
				</section>
			</div>
		</div>
		<div>
			<h2>Other Media Related to $Title</h2>
	
			
			<!--People
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
			-->
		</div>
	</article>
</div>
<% include SideBar %>
