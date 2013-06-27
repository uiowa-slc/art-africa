<div class="content-container typography">	
	<article>
		<!-- <h1>$Title</h1> -->
		<div class="content">
			<div id="map-canvas"></div>
			<div id="map-canvas-notice">
				<div>
					<h1>Welcome to Africa!</h1>
					<p>
						Click on a country for information on its geography, politics, and people.
					</p>
					<p>
						<button>Take Safari</button>
					</p>
				</div>
			</div>
		<% loop getObjects('Country') %>
 
			<% if Title %>
				<li><a href="{$Up.getHolderLink('CountryHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>
