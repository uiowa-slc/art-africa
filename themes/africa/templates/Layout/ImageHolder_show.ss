
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<% if not isPopup %>
			<p><a href="$Source.Link">Return to $Source.Title</a>
				<% if $Object.NeedsZoom %>
				<br />Hover over or touch the image to zoom
				<% end_if %>
			</p>
			<% end_if %>
			<div class="artPic <% if not $Object.NeedsZoom %>noZoom <% else %>zoom-container<% end_if %>">
				<a id="zoom-target" href="$Object.URL" data-easyzoom-source="$Object.URL">

					<% if $Object.NeedsZoom %>
					<img class="zoom-image" src="{$Object.SingleDisplay.URL}" height="$Object.SingleDisplay.Height" width="$Object.SingleDisplay.Width">
					<% else %>
						<img src="{$Object.URL}">
					<% end_if %>
				</a>
				<span id="caption">$Object.parsedCaption
									<p><a href="$Object.ShowLink" target="_blank">Permanent link </a></p>

				</span>

			</div>
			<% if $Object.NeedsZoom %>
			<div class="zoom-instructions">	
				<p>Hover over or touch the image to zoom</p>		
			</div>
			<% end_if %>
			<div class="clearfix"></div>
			
		</div>
		<% if $Object.Description %>
		<div class="content columns description">
			<h2>Description</h2>
			$Object.Description	
		</div>
		<% end_if %>
	</article>
		
</div>
<% include SideBar %>
