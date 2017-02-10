<div class="content-container typography essay">	
	<article>
			<h1>$Object.Title</h1>
			<h2>by $Object.AuthorFirstName $Object.AuthorLastName <br />
				$Object.University
			</h2>
			<h3></h3>
		<div class="content essayPage">$Object.Content

			 
		      <% loop $getPaginatedPages %>
		        $Content
		      <% end_loop %>
			   
			  <% if $getPaginatedPages.MoreThanOnePage %>
			    <div class="pagination">
			    <% if $getPaginatedPages.NotFirstPage %>
			        <a class="prev" href="$getPaginatedPages.PrevLink"><i class="fa fa-caret-left" aria-hidden="true"></i> Prev</a>
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
			        <a class="next" href="$getPaginatedPages.NextLink">Next <i class="fa fa-caret-right" aria-hidden="true"></i></a>
			    <% end_if %>
					</div>
				<% end_if %>
				
			<% include EssayImages %>
			
	
		</div>
	</article>
		
</div>
<% include SideBar %>