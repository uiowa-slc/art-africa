<div class="content-container typography">	
	<h1> Search Results for '$Query'</h1>
	<div class="visible-phone">
<% if $ResultsFound %><p>Jump to: <% if Subtopic %><a href="#subtopics">Subtopics</a> <% end_if %><% if People %><a href="#people">People</a> <% end_if %><% if Essay %><a href="#essays">Essays</a> <% end_if %><% if Country %><a href="#countries">Countries</a> <% end_if %> </p><% end_if %>
	</div>
	<!--<div id="bibliography-results"><label>Search bibliographic references only </label><input type="checkbox" id="bibliography-checkbox" name="Search Bibliography" /></div>-->
	<section class="search-results">
	<ul id="searchResults">	
		<%-- $searchedClasses = array('subtopics', 'people', 'essays', 'countries', 'audio pieces', 'video pieces', 'art photos', 'field photos'--%>
    <% if Image %>
    	<h2 id="images">Images</h2>
    	<div class="media-container">
    	<% loop Image.Limit(25) %>
	    	<div class="item">
	    	 <% include MediaGridImage %>
	    	</div>
    	<% end_loop %>
   	
       	</div>		  
    <% end_if %>
      <% if VideoPiece %>
    	<h2 id="videos">Video</h2>
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
		<li><h2 id="people">People</h2></li>
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
							<% if TypesOfArt %>
								<td>$Population</td>
							<% end_if %>
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
								<td><a href="{$Link}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link}">$Title</a></td>
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
								<td><a href="{$Link}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link}">$Title</a></td>
							<% end_if %>
								<td>$CapitalCity</td>
								<td>$Population</td>
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
</div>
<% include SideBar %>