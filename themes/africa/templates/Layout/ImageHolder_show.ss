
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<% if not isPopup %>
			<p><a href="$Source.Link">Return to $Source.Title</a>
				<% if $Object.NeedsZoom %>
				<br />Hover or touch the image to zoom
				<% end_if %>
			</p>
			<% end_if %>
			<div class="artPic <% if not $Object.NeedsZoom %>noZoom <% else %>zoom-container<% end_if %>">
				<a id="zoom-target" href="$Object.URL" data-easyzoom-source="$Object.URL">
					<img class="zoom-image" src="{$Object.SingleDisplay.URL}" height="$Object.SingleDisplay.Height" width="$Object.SingleDisplay.Width">
				</a>
				<span id="caption">$Object.parsedCaption</p>
			</div>
			<% if $Object.NeedsZoom %>
			<div class="zoom-instructions">	
				<p>Hover or touch the image to zoom</p>		
			</div>
			<% end_if %>
			<div class="clearfix"></div>
			
		</div>
		<div class="content columns">
			<h2>Description</h2>
			$Object.Description	
			<p><a href="$Object.ShowLink" target="_blank">Permanent link to this page.</a></p>
		</div>
	</article>
		
</div>
<% include SideBar %>
