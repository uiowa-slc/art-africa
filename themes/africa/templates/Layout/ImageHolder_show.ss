
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<p><a href="$Source.Link">Return to $Source.Title</a>
				<% if $Object.NeedsZoom %>
				<br />Hover or touch the image to zoom
				<% end_if %>
			</p>
			<div class="artPic <% if not $Object.NeedsZoom %>noZoom <% else %>zoom-container<% end_if %>">
				<a id="zoom-target" href="$Object.URL" data-easyzoom-source="$Object.URL">
					<img class="zoom-image" src="{$Object.SingleDisplay.URL}" height="$Object.SingleDisplay.Height" width="$Object.SingleDisplay.Width">
				</a>
			</div>
				
				<span id="caption">$Object.parsedCaption</p>
				
			
		</div>
		<div class="content columns">
			<h2>Description</h2>
			$Object.Description	
		</div>
	</article>
		
</div>
<% include SideBar %>
