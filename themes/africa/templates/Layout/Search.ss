<div class="content-container typography">	
	<h2> Search Query: $Query</h2>
	<!--<div id="bibliography-results"><label>Search bibliographic references only </label><input type="checkbox" id="bibliography-checkbox" name="Search Bibliography" /></div>-->
	<section class="search-results">
	<ul id="searchResults">	
		<!--$searchedClasses = array('subtopics', 'people', 'essays', 'countries', 'audio pieces', 'video pieces', 'art photos', 'field photos'-->



		


		<% if Subtopic %>
		<li><h3>Subtopics</h3></li>
			<div class="search">
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>Subtopic Name</th>
		    		<th>Dummy field</th>
		    		<th>Dummy field 2</th>
				</tr>
					<% loop Subtopic %>
						<tr>
							<% if Name %>
								<td><a href="{$Link}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link}">$Title</a></td>
							<% end_if %>
								<td>Insert dummy field</td>
								<td>Dummy field 2</td>
						</tr>					
					<% end_loop %>
			
				</tbody>
			</table>
		  </div>
	    <% end_if %> 
		  
		  
		    
    <% if Image %>
    <li><h3> Images </h3></li>
    	<div class="search">
    	<% loop Image.Limit(25) %>
    	<img src="{$SetSize(200,200).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="Tap or click for more info." data-mfp-href="{$ShowLink}" />	
    	<% end_loop %>
    	
       	</div>		  
    <% end_if %>
  
		  
	  
		  
		<% if People %>
		<li><h3>People</h3></li>
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
		<li><h3>Essays</h3></li>
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
						
								<td>$Author</td>
								<td>$University</td>
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>
    <% end_if %>
	    
	<% if Country %>
		<li><h3>Countries</h3></li>
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
    
    
    <% if not People && if not Country && if not Essay && if not Image %>
		<h3> Sorry, no results matched </h3>
		<% end_if %>
    
<!-- Commented out audio and video because there are currently no results for these searches, and if they are added later, they will need to be styled, which can't be done until there is more infomration available about them 
    
    <% if AudioPiece %>
		<li>Audio Pieces</li>
			<div class="padded">
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>Audio Piece Name</th>
		    		<th>Dummy name</th>
		    		<th>Dummy name 2</th>
				</tr>
					<% loop AudioPiece %>
						<tr>
							<% if Name %>
								<td><a href="{$Link}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link}">$Title</a></td>
							<% end_if %>
								<td>Insert dummy field</td>
								<td>Dummy field 2</td>
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>
    <% end_if %>   
    
        
    <% if VideoPiece %>
		<li>Video Pieces</li>
			<div class="padded">
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>Video Piece Name</th>
		    		<th>Dummy name</th>
		    		<th>Dummy name 2</th>
				</tr>
					<% loop VideoPiece %>
						<tr>
							<% if Name %>
								<td><a href="{$Link}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link}">$Title</a></td>
							<% end_if %>
								<td>Insert dummy field</td>
								<td>Dummy field 2</td>
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>
    <% end_if %>        
    
   	         
	-->    
	 
			
	</ul>		
	</section>
</div>
<% include SideBar %>