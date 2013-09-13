<div class="content-container typography">	
	<h2> Search Query: $Query</h2>
	<!--<div id="bibliography-results"><label>Search bibliographic references only </label><input type="checkbox" id="bibliography-checkbox" name="Search Bibliography" /></div>-->
	Link : $Link
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
							<li><a href="{$Top.getPeopleHolder}show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="{$Top.getPeopleHolder}show/{$ID}">$Title</a></li>
						<% end_if %>
	
				<% end_loop %>
			</ul>	
		<% end_if %>
		<% if Essay %>
		<li>Essays</li>
		<ul>
				<% loop Essay %>
						<% if Name %>
							<li><a href="{$Top.getEssayHolder}show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="{$Top.getEssayHolder}show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>	
	    <% end_if %>
	    <% if Country %>
		<li>Countries</li>
			<ul>
				<% loop Country %>
						<% if Name %>
							<li><a href="{$Top.getCountryHolder}show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="{$Top.getCountryHolder}show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>	
		<% end_if %>
	    <% if AudioPiece %>
		<li>Audio Pieces</li>
			<ul>
				<% loop AudioPiece %>
						<% if Name %>
							<li><a href="{$Top.getAudioPieceHolder}show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="{$Top.getAudioPieceHolder}show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>	
		<% end_if %>
		<% if VideoPiece %>
		<li>Video Pieces</li>
			<ul>
				<% loop VideoPiece %>
						<% if Name %>
							<li><a href="{$Top.getVideoPieceHolder}show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="{$Top.getVideoPieceHolder}show/{$ID}">$Title</a></li>
						<% end_if %>
				<% end_loop %>
			</ul>
		<% end_if %>
		<% if Image %>	
		<li>Images</li>
			<ul>
				<% loop Image %>
					
						<% if Name %>
							<li><a href="{$Top.getImageHolder}show/{$ID}">$Name</a></li>
						<% else_if Title %>
							<li><a href="{$Top.getImageHolder}show/{$ID}">$Title</a></li>
						<% end_if %> 
				<% end_loop %>
			</ul>
		<% end_if %>
			
		
			
	</ul>		
	</section>
</div>
<% include SideBar %>