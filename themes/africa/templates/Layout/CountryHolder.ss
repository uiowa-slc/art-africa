<div class="content-container typography">	
	<article>
		<!-- <h1>$Title</h1> -->
		<div class="content">
			<div id="map-canvas"></div>
			<div id="map-canvas-notice">
				<div>
					<p>Tap a country's marker or choose one below.</p>
					<button>Begin</button>
				</div>
			</div>
			<div>
 <table class="table table-hover">
			    <tbody id="country-list">
			    	<tr>
			    		<th>Country Name</th>
			    		<th>Capital</th>
			    		<th>Population</th>

			    	</tr>
			    <% loop getObjects("Country") %>

					<% if Title %>
					<tr id="$ID" data-link="$Link" data-title="$Title.LimitCharacters(40)" >
			    		<td><a href="$Link(false)">$Title</a></td>
			    		<td>$CapitalCity</td>
						<td>$Population</td>
			    	</tr>
					<% end_if %>

				<% end_loop %>
			    </tbody>
			  </table>
			</div>
		</div>
	</article>
</div>




<% include SideBar %>
