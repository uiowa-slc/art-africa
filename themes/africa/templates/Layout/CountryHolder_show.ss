<% with $Object %>
<div class="content-container typography map-page">	
	<article>
		<h1 class="padded" data-googlename="<% if $GoogleName %>$GoogleName<% else %>$Title<% end_if %>">$Title</h1>
		<div id="map-canvas"></div>
		<% include SmallImageScroller %>
		<div class="content container-fluid padded" style="padding-top:0">
			<!-- $Content -->
			<!--$Picture -->
			<div class="row-fluid">
				<section class="country-info-container span6">
					<h2>Basic Info</h2>
					<% if CapitalCity %>
						<h3>Capital</h3>
						<p>$CapitalCity</p>
					<% end_if %>
					<% if Population %>
						<h3>Population</h3>
						<p>$Population</p>
					<% end_if %>
					<% if Climate %>
						<h3>Climate</h3>
						<p>$Climate</p>
					<% end_if %>
					<% if Currency %>
						<h3>Currency</h3>
						<p>$Currency</p>
					<% end_if %>
					<% if ImportantCities %>
						<h3>Important Cities</h3>
						<p>$ImportantCities</p>
					<% end_if %>
					<% if Area %>
						<h3>Area</h3>
						<p>$Area</p>
					<% end_if %>
				</section>

				<section class="country-info-container span6">
					<h2>People</h2>
					<% if Nationality %>
						<h3>Nationality</h3>
						<p>$Nationality</p>
					<% end_if %>

					<% if People %>
					<h3>Major Peoples</h3>
					<p>
						<% loop People %>
						<a href="$Link">$Title</a><% if not $Last %>, <% end_if %>
						<% end_loop %>
					</p>
					<% end_if %>
					<% if Religion %>
						<h3>Religion</h3>
						<p>$Religion</p>
					<% end_if %>
					<% if Literacy %>
						<h3>Literacy</h3>
						<p>$Literacy</p>
					<% end_if %>
					<% if PrincipalLanguage %>
						<h3>Principal Language</h3>
						<p>$PrincipalLanguage</p>
					<% end_if %>
					<% if OfficialLanguage %>
						<h3>Official Language</h3>
						<p>$OfficialLanguage</p>
					<% end_if %>
				</section>
			</div>
			<div class="row-fluid">
				<div class="span12"><h2>Politics</h2></div>
			</div>
			<div class="row-fluid">
				<section class="country-info-container span8">
					
					<% if HeadOfState %>
						<h3>Head Of State</h3>
						<p>$HeadOfState</p>
					<% end_if %>
					<% if TypeOfGovernment %>
						<h3>Type of Government</h3>
						<p>$TypeOfGovernment</p>
					<% end_if %>
					<% if DateOfIndependence %>
						<h3>Date of Independence</h3>
						<p>$DateOfIndependence</p>
					<% end_if %>
					<% if MajorExports %>
						<h3>Major Exports</h3>
						<p>$MajorExports</p>
					<% end_if %>

					<% if PrecolonialHistory %>
						<h3>Precolonial History</h3>
						<p>$PrecolonialHistory</p>
					<% end_if %>

					<% if $PostcolonialHistory %>
						<h3>Postcolonial History</h3>
						<p>$PostcolonialHistory</p>
					<% end_if %>		
				</section>
			</div>
		</div>
		<div class="padded" style="padding-top:0">
			<% if $AudioPieces || $VideoPieces %>
			<h2>More...</h2>
			<% end_if %> 
			

			<% include VideoScroller %>
			<% include AudioScroller %>
		</div>
	</article>
</div>
<% end_with %>
