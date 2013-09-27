<div class="content-container typography essay">	
	<article>
		<h1>$Object.Title</h1>
		<h3>by $Object.Author</h3>
		<h3>$Object.University</h3>
		<div class="content">$Object.Content

			 
			  <div class="content columns">
			       <% loop $getPaginatedPages %>
			        $Content

			      <% end_loop %>
			   </div>
			   
			  <% if $getPaginatedPages.MoreThanOnePage %>
			    <div class="pagination">
			    <% if $getPaginatedPages.NotFirstPage %>
			        <a class="prev" href="$getPaginatedPages.PrevLink">Prev</a>
			    <% end_if %>
			    <% loop $getPaginatedPages.PaginationSummary(7) %>
			        <% if $CurrentBool %>
			            <span>$PageNum</span>
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
					</div>
				<% end_if %>
				
			<% include EssayImages %>
			<br />	
			<br />	
			
			<!--People
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
			Images
			<% loop Images %>
				$Title<br>
			<% end_loop %>
			
			Essay Pages-->
			
	
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
