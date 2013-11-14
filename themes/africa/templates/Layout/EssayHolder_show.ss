<div class="content-container typography essay padded">	
	<article>
			<h1>$Object.Title</h1>
			<h3>by $Object.AuthorFirstName $Object.AuthorLastName</h3>
			<h3>$Object.University</h3>
		<div class="content essayPage">$Object.Content

			 
		       <% loop $getPaginatedPages %>
		        $Content
		      <% end_loop %>
			   
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
