<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<h1 class="title">$Title</h1>
			<div class="mediaItem">
				<iframe id="ytplayer" type="text/html" width="640" height="390"
  src="http://www.youtube.com/embed/{$formattedIFrameURL}"
  frameborder="0"></iframe>
				<span class="credit-line">$CreditLine</span>
			</div>
		</div>
		<div class="row-fluid">
			<section class="artPhoto-info-container span6">
				<% if Description %>
					<h3>Description</h3>
					<p>$Description</p>
				<% end_if %>
			</section>
			<section class="artPhoto-info-container span6">
				<% if Tags %>
					<h3>Tags</h3>
					<p>$Tags</p>
				<% end_if %>
			</section>
			
		    
				
			<br>
			
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
