<% if getImages.MoreThanOnePage %>
	
		<div class="item-list" id="pagination">
		<ul class="pager">	
		
	    <% if getImages.PrevLink %>
	        <li class="pager-item"><a class="prev" href="$getImages.PrevLink">Previous</a></li>
	    <% end_if %>	
	
		<% loop getImages.PaginationSummary(7) %>
			<% if CurrentBool %>
		         <span><li class="pager-current">$PageNum</li></span>
		    <% else %>
		     	<% if Link %>
		            <a href="$Link"><li class="pager-item">$PageNum</li></a>
		        <% else %>
		            <li class="pager-item">...</li>
		        <% end_if %>
		    <% end_if %>
		 <% end_loop %>  
		 <% if getImages.NextLink %>
		 	<li class="pager-item"><a class="next" href="$getImages.NextLink">Next</a></li></a>
		 <% end_if %>
		 
		 </ul> 
		</div>
		 
	<% end_if %>  
