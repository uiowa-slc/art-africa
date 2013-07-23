<div class="content-container typography">	
	<article>
	<article>
		<div class="content container-fluid">
			<h1 class="title">$Title</h1>
			<div class="artPic">
				<img src="{$Picture.Filename}">
				<p>$CreditLine</p>
			</div>
		</div>
		<div class="row-fluid">
			<section class="artPhoto-info-container span4">
				<% if Name %>
					<h3>Name:</h3>
					<p>$Name</p>
				<% end_if %>
				<% if Photographer %>
					<h3>Photographer:</h3>
					<p>$Photographer</p>
				<% end_if %>
			
			</section>
			<section class="artPhoto-info-container span4">
			  	<% if Description %>
					<h3>Description: </h3>
					<p>$Description </p>
				<% end_if %>
				<% if Date %>
					<h3>Date: </h3>
					<p>$Date</p>
				<% end_if %>		
			</section>
			<section class="artPhoto-info-container span4">
				<% if Location %>
					<h3>Location: </h3>
					<p>$Location </p>
				<% end_if %>
				<% if CreditLine %>
					<h3>CreditLine: </h3>
					<p> $CreditLine </p>
				<% end_if %>
				<% if Tags %>
					<h3>Tags:</h3> 
					<p>$Tags</p>
				<% end_if %>
			</section>
			
			<!--
			
			People
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
			
			
			FieldPhotos
			<% loop FieldPhotos %>
				$Title<br>
			<% end_loop %>
			<br><br> -->
			
		
			
	
		
			
	
		</div>
	</article>
		
</div>
<% include SideBar %>