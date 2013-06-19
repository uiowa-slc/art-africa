<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">$Content

			
			
		
			Author: $Author<br><br>
			DateWritten: $DateWritten<br><br>
			University: $University<br><br>
			Consultant: $Consultant<br><br>
			Title: $Title<br><br>
			Source: $Source<br><br>
			Bibliography: $Bibliography<br><br>
			Tags: $Tags<br><br>
			<br><br><br>   
			 
			  <div class="content columns">
			       <% loop $getPaginatedPages %>
			        $Content</a></li>
			      <% end_loop %>
			   </div>
			    <% if $getPaginatedPages.MoreThanOnePage %>
				    <% if $getPaginatedPages.NotFirstPage %>
				        <a class="prev" href="$getPaginatedPages.PrevLink">Prev</a>
				    <% end_if %>
				    <% loop $getPaginatedPages.Pages %>
				        <% if $CurrentBool %>
				            $PageNum
				        <% else %>
				            <% if $Link %>
				                <a href="$Link">$PageNum</a>
				            <% else %>
				                ...
				            <% end_if %>
				        <% end_if %>
				        <% end_loop %>
				    <% if $getPaginatedPages.NotLastPage %>
				        <a class="next" href="$getPaginatedPages.NextLink">Next</a>
				    <% end_if %>
				<% end_if %>
			
			People
			<% loop People %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Audio Pieces
			<% loop AudioPieces %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Subtopics
			<% loop Subtopics %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Video Pieces
			<% loop VideoPieces %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Countries
			<% loop Countries %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			ArtPhotos
			<% loop ArtPhotos %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			FieldPhotos
			<% loop FieldPhotos %>
				$Title<br>
			<% end_loop %>
			<br><br><br>
			Essay Pages
			
	
		</div>
	</article>
		
</div>
<% include SideBar %>

<script type="text/javascript">

	$('.open-glossary-popup').magnificPopup({
	  
	  type:'inline',
	  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
	 });

</script>