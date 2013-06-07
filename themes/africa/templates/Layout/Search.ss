<div class="content-container typography">	
	<h2> Search Query: $Query</h2>
	
	<section class="search-results">
		
		<!--$searchedClasses = array('subtopics', 'people', 'essays', 'countries', 'audio pieces', 'video pieces', 'art photos', 'field photos'-->

		<% if Subtopic %>
		<br>Subtopics<br>
		<ul>
			<% loop Subtopic %>
					<% if Name %>
						<li><a href="{$Link}">$Name</a></li>
					<% else_if Title %>
						<li><a href="{$Link}">$Title</a></li>
					<% end_if %>
			<% end_loop %>
		<% end_if %>
		</ul>
		<% if People %>
		<br>People<br>
			<ul>
				<% loop People %>
						<% if Name %>
							<li><a href="peoples/show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="peoples/show/{$ID}">$Title</a></li>
						<% end_if %>
	
				<% end_loop %>
			</ul>	
		<% end_if %>
		<% if Essay %>
		<br>Essays<br>
		<ul>
				<% loop Essay %>
						<% if Name %>
							<li><a href="essays/show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="essays/show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>	
	    <% end_if %>
	    <% if Country %>
		<br>Countries<br>
			<ul>
				<% loop Country %>
						<% if Name %>
							<li><a href="countries/show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="countries/show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>	
		<% end_if %>
	    <% if AudioPiece %>
		<br>Audio Pieces<br>
			<ul>
				<% loop AudioPiece %>
						<% if Name %>
							<li><a href="audio/show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="audio/show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>	
		<% end_if %>
		<% if VideoPiece %>
		<br>Video Pieces<br>
			<ul>
				<% loop VideoPiece %>
						<% if Name %>
							<li><a href="video/show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="video/show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>
		<% end_if %>
		<% if ArtPhoto %>	
		<br>Art Photos<br>
			<ul>
				<% loop ArtPhoto %>
						<% if Name %>
							<li><a href="art-photos/show{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="art-photos/show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>
		<% end_if %>
		<% if FieldPhoto %>	
		<br>Field Photos<br>
			<ul>
				<% loop FieldPhoto %>
						<% if Name %>
							<li><a href="field-photos/show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="field-photos/show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>	
		<% end_if %>
		
			
			
	</section>
</div>
<% include SideBar %>