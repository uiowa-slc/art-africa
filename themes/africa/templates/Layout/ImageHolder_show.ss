
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<p><a href="$Source.Link">Return to $Source.Title</a></p>
			<div class="artPic">

			<div class="zoom-container">
				<a id="zoom-target" href="$Object.URL">
					<img src="{$Object.SingleDisplay.URL}" height="$Object.Height" width="$Object.Width">
				</a>
			</div>
				
				<span id="caption">$Object.parsedCaption</p>
				
			</div>
		</div>
		<div class="content columns">
			<h2>Description</h2>
			$Object.Description		
			
			<!--
			People:
			<% loop People %>
				$Title<br>
			<% end_loop %>
			<br>
			
			Essays:
			<% loop Essays %>
				$Title<br>
			<% end_loop %>
			
			
			Subtopics:
			<% loop Subtopics %>
				$Title<br>
			<% end_loop %>
			
			
			VideoPieces:
			<% loop VideoPieces %>
				$Title<br>
			<% end_loop %>
			
			
			AudioPieces:
			<% loop AudioPieces %>
				$Title<br>
			<% end_loop %>
			
			
			
			FieldPhotos:
			<% loop FieldPhotos %>
				$Title<br>
			<% end_loop %>-->
			
			
			
			
	
		</div>
	</article>
		
</div>
<% include SideBar %>
