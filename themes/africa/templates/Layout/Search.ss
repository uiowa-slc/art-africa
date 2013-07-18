<div class="content-container typography">	
	<h2> Search Query: $Query</h2>
	<div id="bibliography-results"><label>Search bibliographic references only </label><input type="checkbox" id="bibliography-checkbox" name="Search Bibliography" /></div>
	
	<section class="search-results">
	<ul id="searchResults">	
		<!--$searchedClasses = array('subtopics', 'people', 'essays', 'countries', 'audio pieces', 'video pieces', 'art photos', 'field photos'-->

		<% if Subtopic %>
		<li>Subtopics</li>
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
		<li>People</li>
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
		<li>Essays</li>
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
		<li>Countries</li>
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
		<li>Audio Pieces</li>
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
		<li>Video Pieces</li>
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
		<li>Art Photos</li>
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
		<li>Field Photos</li>
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
		
			
	</ul>		
	</section>
</div>
<% include SideBar %>