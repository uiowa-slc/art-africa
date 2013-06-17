
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
var country = new google.maps.LatLng(7.6219, 6.9743);

var MY_MAPTYPE_ID = 'custom_style';

function initialize() {

  var featureOpts = [
  {
    "featureType": "water",
    "stylers": [
      { "visibility": "on" },
      { "color": "#0b0be6" },
      { "lightness": 88 },
      { "saturation": -45 }
    ]
  },{
    "featureType": "landscape.natural",
    "stylers": [
      { "color": "#828080" },
      { "lightness": 100 }
    ]
  },{
    "featureType": "administrative.country",
    "elementType": "geometry",
    "stylers": [
      { "color": "#e62033" },
      { "visibility": "on" },
      { "weight": 1.3 }
    ]
  },{
    "featureType": "road",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi.park",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi.park",
    "stylers": [
      { "visibility": "off" }
    ]
  }
];

  var mapOptions = {
    zoom: 6,
    center: country,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
    },
    mapTypeId: MY_MAPTYPE_ID
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var styledMapOptions = {
    name: 'Custom Style'
  };

  var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

  map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<style>
#map-canvas, #map_canvas {
  height: 500px;
}

.map-page .content {
	/*-webkit-column-width: 500px;
	column-width:500px;
	-moz-column-width:500px; */
}

#main_content .map-page p {
	margin: 0.3em 0;
}
#main_content .map-page h2 {
	font-size: 3em;
}

.country-info-container{
	padding: 1em 0;
	border-bottom: 1px solid #ccc;
}
</style>
<div class="content-container typography map-page">	
	<article>
		<h1>$Title</h1>
		<div id="map-canvas"></div>
		<div class="content">$Content
		<!--$Picture -->
		<div class="row-fluid">
			<section class="country-info-container span4">
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
			
			<section class="country-info-container span4">
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
			
			<section class="country-info-container span4">
				<h2>People</h2>
				<h3>Nationality</h3>
				<p>$Nationality</p>
				<h3>Major Peoples</h3>
				<p>$MajorPeoples</p>
				<h3>Religion</h3>
				<p>$Religion</p>
				<h3>Literacy</h3>
				<p>$Literacy</p>
				<h3>Principle Language</h3>
				<p>$PrincipalLanguage</p>
				<h3>Official Language</h3>
				<p>$OfficialLanguage</p>
			</section>			

		</div>
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