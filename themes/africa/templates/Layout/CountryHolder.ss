<div class="content-container typography">	
	<article>
		<!-- <h1>$Title</h1> -->
		<div class="content">
			<div id="map-canvas"></div>
			<div id="map-canvas-notice">
				<div>
					$Content
					<button>Take Safari</button>
				</div>
			</div>
			<div class="padded">
				<ul>
					<% loop getObjects('Country') %>
						<% if Title %>
							<li><a href="$Link">$Title</a></li>
						<% end_if %>
					<% end_loop %>
				</ul>
			</div>
		</div>
	</article>
</div>

<% include SideBar %>
