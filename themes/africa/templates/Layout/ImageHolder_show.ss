<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<h1 class="title">$Title</h1>
			<div class="artPic">
				<img src="{$URL}">
				<p>$CreditLine</p>
			</div>
		</div>
		<div class="row-fluid">
			<section class="artPhoto-info-container span4">
				<% if Name %>
					<h3>Name</h3>
					<p>$Name</p>
				<% end_if %>
				<% if Photographer %>
					<h3>Photographer</h3>
					<p>$Photographer</p>
				<% end_if %>
				<% if Description %>
					<h3>Description</h3>
					<p>$Description</p>
				<% end_if %>
				<% if Date %>
					<h3>Date</h3>
					<p>$Date</p>
				<% end_if %>
				<% if Location %>
					<h3>Location</h3>
					<p>$Location</p>
				<% end_if %>
				<% if CreditLine %>
					<h3>CreditLine</h3>
					<p>$CreditLine</p>
				<% end_if %>
			</section>
			<section class="artPhoto-info-container span4">
				<% if TraditionalName %>
					<h3>Traditional Name</h3>
					<p>$TraditionalName</p>
				<% end_if %>
				<% if Material %>
					<h3>Material</h3>
					<p>$Material</p>
				<% end_if %>
				<% if Size %>
					<h3>Size</h3>
					<p>$Size</p>
				<% end_if %>
				<% if Function %>
					<h3>Function</h3>
					<p>$Function</p>
				<% end_if %>
			</section>
			<section class="artPhoto-info-container span4">
				<% if Style %>
					<h3>Style</h3>
					<p>$Style</p>
				<% end_if %>
				<% if Substyle %>
					<h3>Substyle</h3>
					<p>$Substyle</p>
				<% end_if %>
				<% if Collection %>
					<h3>Collection</h3>
					<p>$Collection</p>
				<% end_if %>
				<% if Source %>
					<h3>Source</h3>
					<p>$Source</p>
				<% end_if %>
				<% if Tags %>
					<% include Tags %>
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
