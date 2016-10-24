<div class="content-container typography">
	$SearchForm
	<% if $Query %>
	<h1> Search Results for '$Query'</h1>
	<div class="visible-phone">
<% if $ResultsFound %><p>Jump to: <% if Subtopic %><a href="#subtopics">Subtopics ({$Subtopic.Count})</a> <% end_if %><% if People %><a href="#people">People ({$People.Count})</a> <% end_if %><% if Essay %><a href="#essays">Essays ({$Essay.Count})</a> <% end_if %><% if Country %><a href="#countries">Countries ({$Country.Count})</a> <% end_if %> </p><% end_if %><% if BibliographyPage %><a href="#bibliographic">Bibiographic Entries ({$BibliographyPage.Count})</a> <% end_if %>
	</div>
	<section class="search-results">
	
	<ul id="searchResults">	
		<%-- $searchedClasses = array('subtopics', 'people', 'essays', 'countries', 'audio pieces', 'video pieces', 'art photos', 'field photos'--%>
    <% if Image %>
    	<h2 id="images">Images</h2>

		<div class="image-scroller-container">
		  <ul class="large-image-grid">
		    <% loop Image.Limit(150) %>
		    <li>
		     <% if $AltImage %>
		      		<img src="{$AltImage.CroppedFocusedImage(650,650).URL}" data-mfp-src="{$AltImage.URL}" class="artPhoto" title="Tap or click for more info." data-mfp-href="{$ShowLink}">
		     <% else %>
			  		<img src="{$CroppedFocusedImage(650,650).URL}" data-mfp-src="{$URL}" class="artPhoto" title="Tap or click for more info." data-mfp-href="{$ShowLink}">  
		     <% end_if %>
		      <!-- <% if $CurrentMember %><span><a href="#">Edit this image</a></span><% end_if %> -->
		    </li>
		    <% end_loop %>
		  </ul>
		</div>

    <% end_if %>
      <% if VideoPiece %>
    	<h2 id="videos">Videos</h2>
    	<div class="media-container">
	    	<% loop VideoPiece %>
				<div class="item">
					<% include VideoPiece %>
				</div>			
			<% end_loop %>
    	</div>
    <% end_if %>
    <% if AudioPiece %>
    	<h2 id="audio">Audio</h2>
    	<div class="media-container">
	    	<% loop AudioPiece %>
				<div class="item">
					<% include AudioPiece %>
				</div>			
			<% end_loop %>
    	</div>
    <% end_if %>
        <% if Subtopic %>
                <li><h2 id="subtopics">Subtopics</h2></li>
                        <div class="search">
                         <table class="table table-hover">
                                <tbody>
                                <tr>
                                 <th>Subtopic Name</th>
                                </tr>
                                        <% loop Subtopic %>
                                                <tr>
                                                        <% if Name %>
                                                                <td><a href="{$Link}">$Name</a></td>
                                                        <% else_if Title %>
                                                                <td><a href="{$Link}">$Title</a></td>
                                                        <% end_if %>
                                          
                                                </tr>                                        
                                        <% end_loop %>
                        
                                </tbody>
                        </table>
                  </div>
            <% end_if %> 		  
	  
		  
		<% if People %>
		<li><h2 id="people">Peoples</h2></li>
			<div class="search">
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>People Name</th>
		    		<th>Countries</th>
		    		<th>Population</th>
				</tr>
					<% loop People %>
						<a href="{$Link}">
						<tr>
							<% if Name %>
								<td><a href="{$Link}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link}">$Title</a></td>
							<% end_if %>
							<% if Location %>
								<td>$Location</td>
								<% else %>
								<td>n/a</td>
							<% end_if %>
								<td><% if $Population %>$Population<% end_if %></td>
						</tr>
						</a>
										
					<% end_loop %>
				</tbody>
			</table>
		  </div>
		<% end_if %>
		
		
		
	<% if Essay %>
		<li><h2 id="essays">Essays</h2></li>
			<div class="search">
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>Essay Name</th>
		    		<th>Author</th>
		    		<th>Institution</th>
				</tr>
					<% loop Essay %>
						<tr>
							<% if Name %>
								<td><a href="{$Link(false)}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link(false)}">$Title</a></td>
							<% end_if %>
						
								<td>$AuthorFirstName $AuthorLastName</td>
								<td>$University</td>
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>
    <% end_if %>
	    
	<% if Country %>
		<li><h2 id="countries">Countries</h2></li>
			<div class="search">
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>Country Name</th>
		    		<th>Capital</th>
		    		<th>Population</th>
				</tr>
					<% loop Country %>
						<tr>
							<% if Name %>
								<td><a href="{$Link(false)}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link(false)}">$Title</a></td>
							<% end_if %>
								<td>$CapitalCity</td>
								<td>$Population</td>
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>
    <% end_if %>

    <% if BibliographyPage %>
    	<li><h2 id="bibliographic">Bibliographic Entries</h2>
    		<p>Entries for '$Query' can be found in the page(s) below:</p>
    	</li>

			<div class="search">
			 <table class="table table-hover">
				<tbody>
					<% loop BibliographyPage %>
						<tr>
							<td><a href="{$Link}">$Title</a></td>
			
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>

    <% end_if %>
    
    
    <% if $ResultsFound == false %>
		<p> Sorry, no results were found.</p>
		<% end_if %>
	</ul>		
	</section>
	<% else %>
		<p>Please enter a search term above.</p>
	<% end_if %>
</div>
<% include SideBar %>